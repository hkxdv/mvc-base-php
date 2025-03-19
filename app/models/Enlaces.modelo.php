<?php

/**
 * Enlaces.modelo.php
 * Modelo para gestionar los enlaces y rutas de la aplicación
 * 
 * Esta clase proporciona métodos para obtener las rutas de los módulos
 * desde la base de datos, facilitando la navegación dinámica en la aplicación.
 */
class EnlacesModelo
{
    /**
     * Obtiene la ruta de un módulo desde la base de datos
     * 
     * Busca en la tabla 'enlaces' la ruta correspondiente al nombre
     * del enlace proporcionado. Si no existe o hay un error, devuelve
     * la pagina de error 404.
     * 
     * @param string $enlace Nombre del enlace a buscar
     * @return string Ruta del archivo del módulo o null si debe mostrarse página de error
     */
    static public function ruta_modulo($enlace)
    {
        // Primero verificar si es una ruta estática definida en config/routes.config.php
        require_once dirname(__DIR__, 2) . "/config/routes.config.php";
        $ruta_estatica = obtener_ruta_estatica($enlace);

        if ($ruta_estatica !== null) {
            return $ruta_estatica;
        }

        // Si no es estática, buscar en la base de datos
        try {
            // Obtener la conexión a la base de datos
            $conexion = ConexionModelo::conectar();

            // Preparar la consulta para obtener la ruta del módulo
            $stmt = $conexion->prepare("SELECT ruta FROM enlaces WHERE nombre = :nombre AND estado = 1");

            // Vinculamos el parámetro ":nombre" con el valor del enlace
            $stmt->bindParam(":nombre", $enlace, PDO::PARAM_STR);

            // Ejecutamos la consulta
            $stmt->execute();

            // Verificamos si se encontró un registro
            if ($renglon = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return $renglon["ruta"];
            } else {
                // Cargar el controlador de errores si aún no está cargado
                if (!class_exists('ErrorControlador')) {
                    require_once __DIR__ . '/../controllers/Error.controlador.php';
                }

                // Registrar en el log que no se encontró la página solicitada
                ErrorControlador::error_404("Lo sentimos, la página que buscas no existe.");
                return null;
            }
        } catch (PDOException $e) {
            // Cargar el controlador de errores si aún no está cargado
            if (!class_exists('ErrorControlador')) {
                require_once __DIR__ . '/../controllers/Error.controlador.php';
            }

            // Manejo de excepciones - registrar el error y mostrar página adecuada
            $mensaje = "Error al consultar la ruta para '$enlace': " . $e->getMessage();

            // Si es un error de conexión, mostrar error de BD, sino error 404
            if (strpos(strtolower($e->getMessage()), 'connect') !== false) {
                ErrorControlador::error_db($mensaje);
            } else {
                ErrorControlador::error_404($mensaje);
            }

            return null;
        }
    }
}
