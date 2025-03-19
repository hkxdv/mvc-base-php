<?php

/**
 * index.php
 * Punto de entrada principal de la aplicación
 * 
 * Este archivo inicia la aplicación MVC cargando la configuración
 * y ejecutando el flujo de control principal.
 */

// Cargar el bootstrap de la aplicación
require_once "config/bootstrap.config.php";

// Verificar si es un error HTTP redirigido
manejar_errores_http();

// Iniciar la aplicación web normal
iniciar_aplicacion();
