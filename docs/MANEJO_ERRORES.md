# Sistema de Manejo de Errores

Este documento detalla el sistema de manejo de errores implementado en la estructura base MVC, explicando su arquitectura, configuración y uso.

## Arquitectura General

El sistema implementa un enfoque centralizado para el manejo de errores, siguiendo una estructura organizada:

```txt
/
├── app/
│   ├── controllers/
│   │   └── Error.controlador.php    # Controlador central de errores específicos
│   └── views/
│       └── errors/                  # Vistas específicas para cada tipo de error
│           ├── error_404.php        # Error de página no encontrada
│           ├── error_403.php        # Error de acceso prohibido
│           ├── error_db.php         # Error de conexión a base de datos
│           └── error_generico.php   # Plantilla para errores genéricos
├── config/
│   ├── bootstrap.config.php         # Inicialización de la aplicación
│   ├── error_handler.config.php     # Manejador global de errores y excepciones
│   ├── routes.config.php            # Configuración de rutas estáticas
│   └── alias.config.php             # Definición de alias y constantes
└── logs/
    └── errores.log                  # Archivo de registro de errores
```

## Niveles de Manejo de Errores

El sistema de errores funciona en múltiples niveles:

1. **Nivel Global**: Captura de errores y excepciones de PHP (`config/error_handler.config.php`)
2. **Nivel de Aplicación**: Manejo de errores específicos de la aplicación (`app/controllers/Error.controlador.php`)
3. **Nivel HTTP**: Manejo de errores HTTP mediante redirecciones en `.htaccess`

## Tipos de Errores Manejados

El sistema maneja de forma centralizada los siguientes tipos de errores:

| Código | Tipo                   | Descripción                                   | Vista              |
| ------ | ---------------------- | --------------------------------------------- | ------------------ |
| 404    | Página no encontrada   | La URL solicitada no existe en la aplicación  | error_404.php      |
| 403    | Acceso prohibido       | El usuario no tiene permisos para el recurso  | error_403.php      |
| 500    | Error de base de datos | Problemas con la conexión o consultas a la BD | error_db.php       |
| Varios | Error genérico         | Cualquier otro tipo de error en la aplicación | error_generico.php |

## Flujo de Trabajo del Sistema de Errores

### Manejador Global (config/error_handler.config.php)

1. **Funciones globales**:

   - `error_handler_global()`: Captura errores de PHP y los convierte en excepciones cuando son críticos
   - `exception_handler_global()`: Maneja excepciones no capturadas y las redirige al controlador de errores

2. **Registro automático**:
   - Se registran al inicio de la aplicación mediante `set_error_handler()` y `set_exception_handler()`
   - Se configuran en `bootstrap.config.php` para asegurar su disponibilidad desde el principio

### Controlador de Errores Específicos (Error.controlador.php)

Cuando ocurre un error específico de la aplicación, se sigue el siguiente flujo:

1. **Detección del error**: El error puede ser detectado en diferentes capas:

   - En el modelo (ej: `Enlaces.modelo.php` durante la navegación)
   - En el controlador (durante el procesamiento de datos)
   - En la vista (errores de presentación)

2. **Llamada al controlador de errores**: Desde el punto donde se detecta el error, se llama al método correspondiente del `ErrorControlador`

3. **Registro del error**: El controlador registra el error en:

   - El archivo de log personalizado (`/logs/errores.log`)
   - El log estándar de PHP mediante `error_log()`

4. **Captura del contenido específico del error**:

   - El método `renderizar_error()` captura la salida de la vista específica del error
   - Define la constante `ES_PAGINA_ERROR` para indicar que estamos en una página de error

5. **Presentación del error**:
   - Renderiza la plantilla de error especial (`plantilla_error.php`) que no incluye el menú de navegación
   - Establece el código HTTP apropiado mediante `http_response_code()`
   - Muestra la vista de error capturada previamente
   - Detiene el flujo normal de la aplicación con `exit()`

## Plantilla Específica para Errores

Para mejorar la experiencia de usuario durante los errores, el sistema utiliza una plantilla especial para mostrar los mensajes de error (`plantilla_error.php`):

1. **Características principales**:

   - No incluye menú de navegación ni otros elementos de la interfaz normal
   - Tiene un diseño centrado y simplificado enfocado solo en mostrar el error
   - Utiliza un conjunto optimizado de metadatos y estilos específicos para páginas de error
   - Proporciona una experiencia de usuario más limpia y menos confusa

2. **Ventajas**:

   - Evita que el usuario intente navegar por el menú durante un error
   - Enfoca la atención en el mensaje de error y las acciones disponibles
   - Mejora la percepción de estabilidad del sistema
   - Mejora el rendimiento al cargar solo los recursos necesarios

3. **Optimización de recursos**:
   - Utiliza una versión reducida de metadatos (`meta_datos_error.php`)
   - Solo incluye los estilos de Tailwind CSS y FontAwesome esenciales
   - No carga módulos JavaScript innecesarios (incluyendo el módulo de errores)
   - Elimina la carga de librerías como FullCalendar, jQuery, Bootstrap, etc.

## Sistema de Registro de Errores (Logging)

El sistema utiliza un mecanismo de doble registro:

1. **Log personalizado** (`/logs/errores.log`):

   - Formato estructurado: `[FECHA_HORA] [TIPO] MENSAJE | Detalles: DETALLES | IP: IP_CLIENTE | URI: RUTA`
   - Creación automática del directorio y archivo si no existen
   - Almacenamiento persistente para análisis posterior

2. **Log estándar de PHP**:
   - Como sistema de respaldo si falla el log personalizado
   - Integración con el sistema operativo

Ejemplo de entrada en el log personalizado:

```
[2025-03-17 14:30:45] [404] No se encontró la página 'recursos2' en la base de datos | IP: 192.168.1.10 | URI: /index.php?option=recursos2
```

## Controlador de Errores

El controlador (`Error.controlador.php`) implementa:

### Método privado para registro:

```php
private static function registrar_error($mensaje, $tipo, $detalles = '')
```

### Métodos públicos para diferentes tipos de error:

```php
static public function error_404($mensaje = "")
static public function error_403($mensaje = "")
static public function error_db($mensaje = "")
static public function error_generico($codigo, $titulo, $mensaje, $mensaje_detallado = "")
```

## Integración con el Sistema de Navegación

La integración con el sistema de navegación se realiza principalmente en:

1. **Enlaces.modelo.php**: Verifica primero las rutas estáticas y luego busca en la base de datos

```php
// Verificar si existe como ruta estática
require_once __DIR__ . "/../../config/routes.config.php";
$ruta_estatica = obtener_ruta_estatica($enlace);

if ($ruta_estatica !== null) {
    return $ruta_estatica;
}

// Si no es ruta estática, buscar en la base de datos
// Si no existe la página solicitada
if (!$renglon) {
    ErrorControlador::error_404("Lo sentimos, la página que buscas no existe.");
    return null;
}

// Si hay un error de base de datos
catch (PDOException $e) {
    // Determinar tipo de error y mostrar página adecuada
    if (strpos($e->getMessage(), 'connect') !== false) {
        ErrorControlador::error_db($mensaje);
    } else {
        ErrorControlador::error_404($mensaje);
    }
    return null;
}
```

2. **Principal.controlador.php**: Maneja el valor nulo devuelto por el modelo y verifica si estamos en una página de error

```php
// Verificar si es una página de error
if (!defined('ES_PAGINA_ERROR')) {
    $respuesta = PaginasModelo::enlaces_paginas($enlace);

    // Si la respuesta es null, el error ya ha sido manejado
    if ($respuesta !== null) {
        include $respuesta;
    }
}
```

## Configuración del Entorno

El sistema de errores responde a las siguientes variables de entorno:

- `APP_DEBUG`: Cuando es `true`, se muestran detalles técnicos en las vistas de error
- `LOG_LEVEL`: Determina qué nivel de errores se registran (si está configurado)
