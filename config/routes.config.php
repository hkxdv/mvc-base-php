<?php

/**
 * routes.config.php
 * Configuración de rutas para la aplicación
 * 
 * Este archivo define las rutas estáticas de la aplicación que no
 * necesitan ser consultadas en la base de datos.
 */

// Rutas estáticas predefinidas
$rutas_estaticas = [
    // Ruta => Archivo a cargar
    
    // Documentación
    'documentacion' => 'app/views/docs/listado.php',
];

/**
 * Obtiene la ruta estática para un enlace
 * 
 * @param string $enlace Nombre del enlace
 * @return string|null Ruta del archivo o null si no existe
 */
function obtener_ruta_estatica($enlace)
{
    global $rutas_estaticas;

    return isset($rutas_estaticas[$enlace]) ? $rutas_estaticas[$enlace] : null;
}
