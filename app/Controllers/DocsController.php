<?php

/**
 * DocsController.php
 * Controlador para gestionar la visualización de la documentación
 * 
 * Este controlador proporciona métodos para listar y mostrar 
 * los archivos de documentación del proyecto.
 * 
 * NOTA: Este controlador es OPCIONAL y solo sirve para mostrar
 * la documentación de la estructura base MVC. Puedes eliminarlo
 * en tus proyectos si no lo necesitas.
 */
namespace App\Controllers;

use App\Controllers\ErrorController;

/**
 * Clase para gestionar la visualización de la documentación del sistema
 */
class DocsController
{
    /**
     * Método principal para mostrar la lista de documentación
     * 
     * @return void
     */
    public static function index()
    {
        // Obtener la lista de archivos de documentación
        $archivos = self::obtenerListaDocumentos();

        // Incluir la vista de listado de documentación
        include "app/views/docs/listado.php";
    }

    /**
     * Método para mostrar un documento específico
     * 
     * @return void
     */
    public static function ver()
    {
        // Verificar que se haya especificado un documento
        if (!isset($_GET['doc']) || empty($_GET['doc'])) {
            header('Location: index.php?option=documentacion');
            exit;
        }

        $documento = $_GET['doc'];
        $ruta_archivo = "docs/{$documento}.md";

        // Verificar que el archivo exista
        if (!file_exists($ruta_archivo)) {
            ErrorController::error404("El documento solicitado no existe");
            return;
        }

        // Leer el contenido del documento
        $contenido = file_get_contents($ruta_archivo);

        // Convertir contenido Markdown a HTML usando Parsedown
        $contenido_html = self::markdownAHtml($contenido);

        // Incluir la vista de visualización del documento
        include "app/views/docs/ver.php";
    }

    /**
     * Obtiene la lista de archivos de documentación
     * 
     * @return array Listado de documentos con nombre y descripción
     */
    private static function obtenerListaDocumentos()
    {
        $directorio = 'docs';
        $archivos = [];

        // Verificar que el directorio exista
        if (!is_dir($directorio)) {
            return $archivos;
        }

        // Leer archivos .md del directorio
        $archivos_dir = scandir($directorio);

        foreach ($archivos_dir as $archivo) {
            if (pathinfo($archivo, PATHINFO_EXTENSION) === 'md') {
                $nombre = pathinfo($archivo, PATHINFO_FILENAME);
                $descripcion = self::obtenerDescripcionDocumento("{$directorio}/{$archivo}");

                $archivos[] = [
                    'nombre' => $nombre,
                    'archivo' => $archivo,
                    'descripcion' => $descripcion
                ];
            }
        }

        return $archivos;
    }

    /**
     * Extrae la descripción de un documento (primera línea)
     * 
     * @param string $rutaArchivo Ruta del archivo
     * @return string Descripción del documento
     */
    private static function obtenerDescripcionDocumento($rutaArchivo)
    {
        if (!file_exists($rutaArchivo)) {
            return "Sin descripción";
        }

        $contenido = file_get_contents($rutaArchivo);
        $lineas = explode("\n", $contenido);

        // Buscar la primera línea que no sea un encabezado
        foreach ($lineas as $linea) {
            $linea = trim($linea);
            if (!empty($linea) && $linea[0] !== '#') {
                return substr($linea, 0, 100) . (strlen($linea) > 100 ? '...' : '');
            }
        }

        // Si no se encuentra descripción, usar el título
        foreach ($lineas as $linea) {
            $linea = trim($linea);
            if (!empty($linea) && $linea[0] === '#') {
                return trim(str_replace('#', '', $linea));
            }
        }

        return "Sin descripción";
    }

    /**
     * Convierte texto Markdown a HTML utilizando Parsedown
     * 
     * @param string $texto Texto en formato Markdown
     * @return string HTML generado
     */
    private static function markdownAHtml($texto)
    {
        // Utilizar Parsedown para la conversión de Markdown a HTML
        require_once 'vendor/autoload.php';
        $parsedown = new \Parsedown();
        
        // Configuración opcional para mayor seguridad
        // Descomentar si se necesita (requiere Parsedown Extra)
        // $parsedown->setSafeMode(true);
        
        return $parsedown->text($texto);
    }
}
