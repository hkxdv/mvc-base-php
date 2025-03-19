<?php

/**
 * Principal.controlador.php
 * Controlador principal que maneja las interacciones entre modelos y vistas
 * 
 */
class PrincipalControlador
{
    /**
     * Carga la plantilla principal de la aplicación
     */
    static public function plantilla_base()
    {
        // Solo cargar la plantilla base si no estamos en una página de error
        if (!defined('ES_PAGINA_ERROR')) {
            include "app/views/templates/plantilla_base.php";
        }
    }

    /**
     * Maneja la navegación entre las diferentes secciones
     * Carga los módulos correspondientes según la opción seleccionada
     */
    static public function carga_modulos()
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
                self::cargar_modulo_documentacion($accion);
                return;
            default:
                // Continuar con el flujo normal para otros módulos
                break;
        }

        $respuesta = EnlacesModelo::ruta_modulo($enlace);

        // Si la respuesta es null, significa que ya se ha manejado el error
        if ($respuesta !== null) {
            include $respuesta;
        }
    }
    
    /**
     * Maneja la carga del módulo de documentación
     * 
     * @param string|null $accion Acción a ejecutar
     */
    private static function cargar_modulo_documentacion($accion)
    {
        // Verificar que existe el controlador de documentación
        if (!class_exists('DocumentacionControlador')) {
            ErrorControlador::error_404("El módulo de documentación no está disponible");
            return;
        }
        
        // Ejecutar la acción correspondiente
        switch ($accion) {
            case 'ver':
                DocumentacionControlador::ver();
                break;
            default:
                DocumentacionControlador::index();
                break;
        }
    }

    // ---- MÉTODOS ---- //

}
