<?php

/**
 * PrincipalController.php
 * Controlador principal que maneja las interacciones entre modelos y vistas
 * 
 */
namespace App\Controllers;

use App\Models\EnlaceModel;
use App\Controllers\ErrorController;
use App\Controllers\DocsController;

/**
 * Clase que gestiona la interacción principal entre modelos y vistas
 */
class PrincipalController
{
    /**
     * Carga la plantilla principal de la aplicación
     *
     * @return void
     */
    static public function plantillaBase()
    {
        // Solo cargar la plantilla base si no estamos en una página de error
        if (!defined('ES_PAGINA_ERROR')) {
            include "app/views/templates/plantilla_base.php";
        }
    }

    /**
     * Maneja la navegación entre las diferentes secciones
     * Carga los módulos correspondientes según la opción seleccionada
     * 
     * @return void
     */
    static public function cargaModulos()
    {
        // Si ya estamos en una página de error, no hacer nada
        if (defined('ES_PAGINA_ERROR')) {
            return;
        }

        if (isset($_GET["option"])) {
            $enlace = $_GET["option"];
        } else {
            $enlace = "principal";
        }
        
        // Acciones especiales según el módulo
        $accion = $_GET["action"] ?? null;
        
        // Manejo de módulos con controladores específicos
        switch ($enlace) {
            case 'documentacion':
                self::cargarModuloDocumentacion($accion);
                return;
            default:
                // Continuar con el flujo normal para otros módulos
                break;
        }

        $respuesta = EnlaceModel::rutaModulo($enlace);

        // Si la respuesta es null, significa que ya se ha manejado el error
        if ($respuesta !== null) {
            include $respuesta;
        }
    }
    
    /**
     * Maneja la carga del módulo de documentación
     * 
     * @param string|null $accion Acción a ejecutar
     * @return void
     */
    private static function cargarModuloDocumentacion($accion)
    {
        // Verificar que existe el controlador de documentación
        if (!class_exists(DocsController::class)) {
            ErrorController::error404("El módulo de documentación no está disponible");
            return;
        }
        
        // Ejecutar la acción correspondiente
        switch ($accion) {
            case 'ver':
                DocsController::ver();
                break;
            default:
                DocsController::index();
                break;
        }
    }
}
