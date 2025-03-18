<?php

/**
 * alias.config.php
 * Configuración de alias para rutas en la aplicación MVC
 * 
 * Define constantes y funciones para la resolución de rutas mediante aliases,
 * facilitando el acceso a recursos y componentes de la aplicación.
 */

// Definición de rutas base
define('URL_BASE', 'http://localhost/mvc-optisala-reuniones/');
define('PATH_BASE', __DIR__ . '/..');

/**
 * Definición de aliases para las rutas del sistema
 * 
 * Facilita el acceso centralizado a diferentes secciones y recursos
 * mediante prefijos intuitivos que abstraen las rutas físicas
 */
define('ALIASES', [
    // Rutas de recursos (URLs)
    '@Img' => URL_BASE . 'assets/img/',
    '@Js' => URL_BASE . 'assets/js/',
    '@Js_ES6' => URL_BASE . 'assets/js/modules/',
    '@Js_utils' => URL_BASE . 'assets/js/utils/',
    '@AppJs' => URL_BASE . 'assets/js/modules/app.modulo.js',
    '@Css' => URL_BASE . 'assets/css/',

    // Rutas de archivos (filesystem paths)
    '@Meta_datos' => PATH_BASE . '/app/views/components/meta_datos.php',
    '@Meta_datos_error' => PATH_BASE . '/app/views/components/meta_datos_error.php',
    '@Menu' => PATH_BASE . '/app/views/components/menu.php',
    '@Pie_pagina' => PATH_BASE . '/app/views/components/pie_pagina.php'
]);

/**
 * Resuelve una ruta utilizando el sistema de aliases
 * 
 * @param string $ruta Ruta con alias a resolver
 * @param bool $verificar_existencia Si debe verificar que el archivo existe (solo para rutas de archivos)
 * @param bool $usar_cache Si debe usar el caché de resoluciones
 * @return string Ruta completa resuelta
 */
function alias($ruta, $verificar_existencia = true, $usar_cache = true)
{
    // Sistema de caché para evitar recalcular rutas ya resueltas
    static $cache = [];

    // Si está habilitado el caché y la ruta ya está en caché, devolverla
    if ($usar_cache && isset($cache[$ruta])) {
        return $cache[$ruta];
    }

    // Obtener todos los aliases definidos
    $aliases = ALIASES;

    // Ordenar aliases por longitud (del más largo al más corto)
    // para evitar problemas cuando un alias es prefijo de otro
    uksort($aliases, function ($a, $b) {
        return strlen($b) - strlen($a);
    });

    $ruta_resuelta = $ruta;
    $ruta_modificada = false;

    // Iterar sobre los aliases ordenados y resolver la ruta
    foreach ($aliases as $alias => $valor) {
        // Verificar si la ruta comienza con el alias
        if (strpos($ruta_resuelta, $alias) === 0) {
            // Reemplazar el alias con su valor correspondiente
            $ruta_resuelta = str_replace($alias, $valor, $ruta_resuelta);
            $ruta_modificada = true;
            break;
        }
    }

    // Verificar si el archivo existe (solo para rutas de archivos físicos)
    if ($verificar_existencia && $ruta_modificada && strpos($ruta_resuelta, PATH_BASE) === 0) {
        if (!file_exists($ruta_resuelta)) {
            $mensaje = "El archivo '$ruta_resuelta' no existe";
            trigger_error($mensaje, E_USER_WARNING);

            // Registrar error en log
            error_log("Error de alias: $mensaje");
        }
    }

    // Guardar en caché si está habilitado
    if ($usar_cache) {
        $cache[$ruta] = $ruta_resuelta;
    }

    return $ruta_resuelta;
}

/**
 * Limpia el caché de resoluciones de alias
 * 
 * Útil después de modificar la configuración de aliases en tiempo de ejecución
 * o cuando se requiere forzar la resolución fresca de todos los aliases
 * 
 * @return void
 */
function limpiar_cache_alias()
{
    // Usamos Reflection para acceder a la variable estática $cache dentro de alias
    $refl_func = new ReflectionFunction('alias');
    $vars = $refl_func->getStaticVariables();

    if (isset($vars['cache'])) {
        // Creamos una closure que puede acceder a la variable estática
        $limpiar_cache = function () {
            static $cache = [];
        };

        // Vinculamos la closure al namespace global y la ejecutamos
        $limpiar_cache = $limpiar_cache->bindTo(null, null);
        $limpiar_cache();
    }
}
