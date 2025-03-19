<?php

/**
 * error_handler.config.php
 * Configuración de manejadores globales de errores y excepciones
 * 
 * Este archivo configura manejadores personalizados para capturar
 * errores de PHP y mostrarlos con nuestra plantilla personalizada.
 */

/**
 * Manejador de errores de PHP no capturados
 * 
 * @param int $level Nivel de error
 * @param string $message Mensaje de error
 * @param string $file Archivo donde ocurrió el error
 * @param int $line Línea donde ocurrió el error
 * @return bool Indica si el error fue manejado
 */
function error_handler_global($level, $message, $file, $line)
{
    // Para errores críticos, convertirlos en excepciones
    if (in_array($level, [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_PARSE, E_RECOVERABLE_ERROR, E_USER_ERROR])) {
        throw new ErrorException($message, 0, $level, $file, $line);
    }

    // Para advertencias y notificaciones en producción, solo registrarlas
    if ($_ENV['APP_DEBUG'] !== 'true') {
        // Registrar en logs pero no mostrar al usuario
        error_log("Error PHP ($level): $message en $file:$line");
        return true; // Evitar que PHP maneje el error
    }

    // Para modo de depuración, permitir que PHP muestre el error
    return false;
}

/**
 * Manejador de excepciones no capturadas
 * 
 * @param Throwable $e La excepción no capturada
 */
function exception_handler_global($e)
{
    // Verificar si ErrorControlador ya está cargado
    if (!class_exists('ErrorControlador')) {
        require_once __DIR__ . "/../app/controllers/Error.controlador.php";
    }

    $mensaje = $e->getMessage();
    $codigo = 500;
    $titulo = "Error interno";
    $detalles = "File: " . $e->getFile() . " on line " . $e->getLine() .
        "\nTrace: " . $e->getTraceAsString();

    // Usar nuestro sistema de errores personalizado
    ErrorControlador::error_generico($codigo, $titulo, $mensaje, $detalles);
}

// Registrar los manejadores
set_error_handler('error_handler_global');
set_exception_handler('exception_handler_global');

// Configurar el reporte de errores según el entorno
if (isset($_ENV['APP_DEBUG']) && $_ENV['APP_DEBUG'] === 'true') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);
    ini_set('display_errors', 0);
}
