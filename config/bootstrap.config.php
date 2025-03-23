<?php

/**
 * bootstrap.config.php
 * Inicialización y configuración de la aplicación
 * 
 * Este archivo maneja la carga de dependencias, configuración y prepara
 * el entorno para usar exclusivamente namespaces PSR-4.
 */

// Configuración inicial
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Cargar el autoloader de Composer (PSR-4)
require_once __DIR__ . "/../vendor/autoload.php";

// Cargar el manejador global de errores
require_once __DIR__ . "/error_handler.config.php";

// Iniciar el buffer de salida si no está activo
if (!ob_get_level()) {
    ob_start();
}

// Cargar variables de entorno con phpdotenv si existe .env
if (file_exists(__DIR__ . "/../.env")) {
    Dotenv\Dotenv::createImmutable(dirname(__DIR__))->load();
}

/**
 * Maneja errores HTTP redirigidos por Apache
 * 
 * @return void
 */
function manejarErroresHttp(): void
{
    // Usar el controlador de errores con namespace PSR-4
    $errorController = '\\App\\Controllers\\ErrorController';

    if (isset($_GET["option"]) && $_GET["option"] === "error" && isset($_GET["code"])) {
        $codigo = intval($_GET["code"]);

        switch ($codigo) {
            case 404:
                $errorController::error404("La URL solicitada no existe en el servidor.");
                exit;
            case 403:
                $errorController::error403("No tienes permiso para acceder a este recurso.");
                exit;
            case 500:
                $errorController::errorGenerico(500, "Error Interno del Servidor", "Ha ocurrido un error en el servidor al procesar tu solicitud.");
                exit;
            default:
                $errorController::errorGenerico($codigo, "Error $codigo", "Se ha producido un error con código $codigo.");
                exit;
        }
    }
}

/**
 * Inicia la aplicación principal
 * 
 * @return void
 */
function iniciarAplicacion(): void
{
    // Solo cargar la plantilla base si no estamos en una página de error
    if (!defined('ES_PAGINA_ERROR')) {
        // Limpiar cualquier buffer de salida existente
        while (ob_get_level()) {
            ob_end_clean();
        }
        // Iniciar un nuevo buffer
        ob_start();

        // Usar el controlador principal con namespace PSR-4
        \App\Controllers\PrincipalController::plantillaBase();
    }
}
