<?php

/**
 * autoloader.config.php
 * Configuración del autoloader personalizado para el proyecto
 * 
 * Este archivo implementa un autoloader personalizado que respeta las convenciones
 * del proyecto para nombrar y cargar archivos de clases MVC.
 */

// Información de depuración para seguimiento de problemas de autoloading
define('AUTOLOADER_DEBUG', false);

/**
 * Autoloader personalizado para cargar clases siguiendo las convenciones del proyecto
 *
 * @param string $nombre_clase Nombre de la clase a cargar
 * @return bool True si la clase se cargó correctamente
 */
function mvc_autoloader($nombre_clase) {
    if (AUTOLOADER_DEBUG) {
        error_log("Autoloader intentando cargar: {$nombre_clase}");
    }
    
    // Verificar si la clase tiene namespace
    $namespace = '';
    $nombre_clase_simple = $nombre_clase;
    
    if (strpos($nombre_clase, '\\') !== false) {
        $partes = explode('\\', $nombre_clase);
        $nombre_clase_simple = end($partes);
        
        // Verificar si el namespace empieza con App
        if (strpos($nombre_clase, 'App\\') === 0) {
            // Por ahora ignoramos la estructura de namespaces y solo usamos el nombre de la clase
            $namespace = 'App\\';
        }
    }
    
    // 1. Buscar archivo directamente por nombre de clase
    $rutas_directas = [
        // Modelo
        __DIR__ . "/../app/models/{$nombre_clase_simple}.modelo.php",
        // Controlador
        __DIR__ . "/../app/controllers/{$nombre_clase_simple}.controlador.php"
    ];
    
    foreach ($rutas_directas as $ruta) {
        if (file_exists($ruta)) {
            if (AUTOLOADER_DEBUG) {
                error_log("Autoloader encontró el archivo: {$ruta}");
            }
            require_once $ruta;
            return true;
        }
    }
    
    // 2. Verificar si la clase termina con Modelo o Controlador
    if (substr($nombre_clase_simple, -6) === 'Modelo') {
        $nombre_archivo = substr($nombre_clase_simple, 0, -6);
        $ruta_modelo = __DIR__ . "/../app/models/{$nombre_archivo}.modelo.php";
        
        if (file_exists($ruta_modelo)) {
            if (AUTOLOADER_DEBUG) {
                error_log("Autoloader encontró el archivo para modelo: {$ruta_modelo}");
            }
            require_once $ruta_modelo;
            return true;
        }
    } 
    elseif (substr($nombre_clase_simple, -11) === 'Controlador') {
        $nombre_archivo = substr($nombre_clase_simple, 0, -11);
        $ruta_controlador = __DIR__ . "/../app/controllers/{$nombre_archivo}.controlador.php";
        
        if (file_exists($ruta_controlador)) {
            if (AUTOLOADER_DEBUG) {
                error_log("Autoloader encontró el archivo para controlador: {$ruta_controlador}");
            }
            require_once $ruta_controlador;
            return true;
        }
    }
    
    // 3. Implementación del PSR-4 básica para namespaces
    if ($namespace === 'App\\') {
        // Convertir el nombre de clase a una ruta de archivo
        $namespace_path = str_replace('\\', '/', substr($nombre_clase, 4)); // 4 = longitud de "App\"
        $psr4_ruta = __DIR__ . "/../app/{$namespace_path}.php";
        
        if (file_exists($psr4_ruta)) {
            if (AUTOLOADER_DEBUG) {
                error_log("Autoloader encontró el archivo por PSR-4: {$psr4_ruta}");
            }
            require_once $psr4_ruta;
            return true;
        }
    }
    
    // Si el modo de depuración está activado, registrar las clases que no se encontraron
    if (AUTOLOADER_DEBUG) {
        error_log("Autoloader no pudo encontrar la clase: {$nombre_clase}");
    }
    
    return false;
}

// Registrar el autoloader personalizado
spl_autoload_register('mvc_autoloader');

/**
 * Carga automática de vistas según el tipo
 *
 * @param string $nombre Nombre de la vista
 * @param string $tipo Tipo de vista (component, module, template, error)
 * @return string Ruta completa del archivo
 */
function cargar_vista($nombre, $tipo = 'module') {
    $ruta_base = __DIR__ . "/../app/views/";
    
    switch ($tipo) {
        case 'component':
            $ruta = $ruta_base . "components/{$nombre}.php";
            break;
        case 'module':
            $ruta = $ruta_base . "modules/{$nombre}.php";
            break;
        case 'template':
            $ruta = $ruta_base . "templates/{$nombre}.php";
            break;
        case 'error':
            $ruta = $ruta_base . "errors/{$nombre}.php";
            break;
        default:
            $ruta = $ruta_base . $nombre;
    }
    
    return $ruta;
} 