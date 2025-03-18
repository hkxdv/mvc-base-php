<?php

/**
 * Error.controlador.php
 * Controlador dedicado para gestionar los errores del sistema
 * 
 * Este controlador centraliza la gestión de errores y muestra 
 * las vistas correspondientes según el tipo de error.
 */

class ErrorControlador
{

    /**
     * Registra un mensaje de error en el archivo de logs
     * 
     * @param string $mensaje Mensaje de error a registrar
     * @param string $tipo Tipo de error (404, 500, etc.)
     * @param string $detalles Detalles adicionales del error (opcional)
     * @return bool Retorna true si se registró correctamente, false en caso contrario
     */
    private static function registrar_error($mensaje, $tipo, $detalles = '')
    {
        try {
            // Definir la ruta del directorio de logs
            $directorio_logs = dirname(__DIR__, 2) . '/logs';

            // Verificar si el directorio existe, si no, crearlo
            if (!is_dir($directorio_logs)) {
                mkdir($directorio_logs, 0755, true);
            }

            // Definir el archivo de log
            $archivo_log = $directorio_logs . '/errores.log';

            // Formatear el mensaje de error con fecha y hora
            $fecha = date('Y-m-d H:i:s');
            $log_mensaje = "[{$fecha}] [{$tipo}] {$mensaje}";

            // Agregar detalles si están disponibles
            if (!empty($detalles)) {
                $log_mensaje .= " | Detalles: {$detalles}";
            }

            // Agregar IP del cliente y URI solicitada
            $ip = $_SERVER['REMOTE_ADDR'] ?? 'Desconocida';
            $uri = $_SERVER['REQUEST_URI'] ?? '/';
            $log_mensaje .= " | IP: {$ip} | URI: {$uri}\n";

            // Escribir en el archivo de log (modo append)
            return file_put_contents($archivo_log, $log_mensaje, FILE_APPEND);
        } catch (Exception $e) {
            // Si ocurre un error, usar el error_log estándar de PHP
            error_log("Error al registrar en log: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Renderiza la plantilla de error con contenido específico
     * 
     * @param string $vista Ruta a la vista específica de error
     * @param array $data Datos a pasar a la vista
     * @return void
     */
    private static function renderizar_error($vista, $data = [])
    {
        // Definir variable global para indicar que estamos en una página de error
        // IMPORTANTE: Debe ser lo primero que se define para evitar que se cargue la plantilla_base
        if (!defined('ES_PAGINA_ERROR')) {
            define('ES_PAGINA_ERROR', true);
        }

        // Limpiar cualquier buffer de salida existente
        while (ob_get_level()) {
            ob_end_clean();
        }

        // Iniciar un nuevo buffer
        ob_start();

        // Capturar la salida de la vista específica
        include_once $vista;
        $contenido_error = ob_get_clean();

        // Renderizar la plantilla de error con el contenido
        include_once "app/views/templates/plantilla_error.php";

        // Detener la ejecución para evitar que se siga procesando
        exit();
    }

    /**
     * Muestra la página de error 404 (página no encontrada)
     * 
     * @param string $mensaje Mensaje de error personalizado (opcional)
     * @return void
     */
    static public function error_404($mensaje = "")
    {
        // Establecer código de estado HTTP 404
        http_response_code(404);

        // Si no hay mensaje personalizado, usar el default
        if (empty($mensaje)) {
            $mensaje = "Lo sentimos, la página que buscas no existe.";
        }

        // Enviar variables a la vista
        $data = [
            "mensaje" => $mensaje,
            "codigo" => 404,
            "titulo" => "Página No Encontrada"
        ];

        // Registrar error en el log personalizado
        self::registrar_error($mensaje, "404");

        // Registrar error en el log del sistema
        error_log("Error 404: $mensaje");

        // Cargar y renderizar la vista de error 404
        self::renderizar_error("app/views/errors/error_404.php", $data);
    }

    /**
     * Muestra la página de error 403 (acceso prohibido)
     * 
     * @param string $mensaje Mensaje de error personalizado (opcional)
     * @return void
     */
    static public function error_403($mensaje = "")
    {
        // Establecer código de estado HTTP 403
        http_response_code(403);

        // Si no hay mensaje personalizado, usar el default
        if (empty($mensaje)) {
            $mensaje = "No tienes permisos para acceder a este recurso.";
        }

        // Enviar variables a la vista
        $data = [
            "mensaje" => $mensaje,
            "codigo" => 403,
            "titulo" => "Acceso Prohibido"
        ];

        // Registrar error en el log personalizado
        self::registrar_error($mensaje, "403");

        // Registrar error en el log del sistema
        error_log("Error 403: $mensaje");

        // Cargar y renderizar la vista de error 403
        self::renderizar_error("app/views/errors/error_403.php", $data);
    }

    /**
     * Muestra la página de error de conexión a base de datos
     * 
     * @param string $mensaje Mensaje detallado del error
     * @return void
     */
    static public function error_db($mensaje = "")
    {
        // Establecer código de estado HTTP 500
        http_response_code(500);

        // Si no hay mensaje personalizado, usar el default
        if (empty($mensaje)) {
            $mensaje = "Error de conexión a la base de datos. Por favor, intente más tarde.";
        }

        // Enviar variables a la vista
        $data = [
            "mensaje" => $mensaje,
            "codigo" => 500,
            "titulo" => "Error de Conexión"
        ];

        // Registrar error en el log personalizado
        self::registrar_error($mensaje, "DB", isset($data['mensaje_detallado']) ? $data['mensaje_detallado'] : '');

        // Registrar error en el log con información detallada
        error_log("Error de BD: $mensaje");

        // Cargar y renderizar la vista de error de base de datos
        self::renderizar_error("app/views/errors/error_db.php", $data);
    }

    /**
     * Muestra una página de error genérico
     * 
     * @param int $codigo Código de error HTTP
     * @param string $titulo Título del error
     * @param string $mensaje Mensaje detallado del error
     * @param string $mensaje_detallado Información técnica adicional (opcional)
     * @return void
     */
    static public function error_generico($codigo, $titulo, $mensaje, $mensaje_detallado = "")
    {
        // Establecer código de estado HTTP
        http_response_code($codigo);

        // Enviar variables a la vista
        $data = [
            "mensaje" => $mensaje,
            "codigo" => $codigo,
            "titulo" => $titulo
        ];

        // Añadir mensaje detallado si existe
        if (!empty($mensaje_detallado)) {
            $data["mensaje_detallado"] = $mensaje_detallado;
        }

        // Registrar error en el log personalizado
        self::registrar_error($mensaje, $codigo, $mensaje_detallado);

        // Registrar error en el log
        error_log("Error $codigo: $titulo - $mensaje");

        // Cargar y renderizar la vista de error genérico
        self::renderizar_error("app/views/errors/error_generico.php", $data);
    }
}
