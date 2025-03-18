# Guía de Autoloading para la Estructura Base MVC

Este documento explica cómo funciona el sistema de autoloading implementado en la estructura base MVC y cómo utilizarlo correctamente tanto con clases tradicionales como con namespaces.

## Configuración Actual

El sistema utiliza dos mecanismos de autoloading complementarios:

1. **Autoloading PSR-4 de Composer**: Configurado en `composer.json` para el namespace base `App\`
2. **Autoloading personalizado**: Implementado en `config/autoloader.config.php` para respetar las convenciones de nombrado del proyecto (`.modelo.php`, `.controlador.php`)

## Uso de Clases Tradicionales (Sin Namespace)

Las clases tradicionales siguen las convenciones de nomenclatura especificadas en `ESPECIFICACIONES.md`:

### Modelos

```php
class EntidadModelo
{
    public function obtener_por_id($id)
    {
        // Implementación
    }
}
```

### Controladores

```php
class EntidadControlador
{
    static public function listar()
    {
        // Implementación
    }
}
```

Estas clases se ubican en:

- Modelos: `app/models/Entidad.modelo.php`
- Controladores: `app/controllers/Entidad.controlador.php`

## Uso de Clases con Namespace

Las clases con namespace siguen la estructura PSR-4 de Composer:

### Modelos

```php
namespace App\Models;

class EntidadModelo
{
    public static function obtener_todos()
    {
        // Implementación
    }
}
```

### Controladores

```php
namespace App\Controllers;

class EntidadControlador
{
    public static function index()
    {
        // Implementación
    }
}
```

Estas clases se ubican en:

- Modelos: `app/models/Entidad.modelo.php`
- Controladores: `app/controllers/Entidad.controlador.php`

## Compatibilidad entre Sistemas

El autoloader personalizado es compatible con ambos estilos:

1. Busca clases directamente por nombre: primero intenta encontrar un archivo con el nombre de la clase
2. Busca clases que terminan con `Modelo` o `Controlador` y carga el archivo correspondiente
3. Maneja namespaces que comienzan con `App\` y carga el archivo adecuado

### Estrategia de Resolución de Autoloader

El orden de búsqueda del autoloader es el siguiente:

1. Busca archivos directamente con el nombre de la clase (ej: `EnlacesModelo.modelo.php`)
2. Si la clase termina en "Modelo", busca el archivo con formato `{NombreSinModelo}.modelo.php`
3. Si la clase termina en "Controlador", busca el archivo con formato `{NombreSinControlador}.controlador.php`
4. Si la clase tiene namespace `App\`, intenta resolver la ruta usando PSR-4

## Prevención de Conflictos de Nombres

Para evitar conflictos como el que ocurrió entre `PaginasModelo` y `App\Models\PaginasModelo`, se implementaron las siguientes soluciones:

1. **Nombres únicos**: Cada clase debe tener un nombre único en el sistema, sin importar su namespace

   - Ejemplo: `EnlacesModelo` en `Enlaces.modelo.php` (sin namespace)
   - Ejemplo: `EjemploModelo` en `Ejemplo.modelo.php` (con namespace `App\Models`)

2. **Depuración de autoloading**: Se puede activar la depuración del autoloader estableciendo la constante `AUTOLOADER_DEBUG` a `true` en `config/autoloader.config.php`

```php
// Activar depuración para seguir los intentos de carga de clases
define('AUTOLOADER_DEBUG', true);
```

## Ejemplo de Carga de Vistas

La función `cargar_vista()` permite cargar vistas según su tipo:

```php
// Cargar un módulo
$ruta_modulo = cargar_vista('dashboard', 'module');

// Cargar un componente
$ruta_componente = cargar_vista('menu', 'component');

// Cargar una plantilla
$ruta_plantilla = cargar_vista('base', 'template');

// Cargar una vista de error
$ruta_error = cargar_vista('404', 'error');
```

## Ejemplos de Uso Práctico

### 1. Usando modelo tradicional (sin namespace)

```php
// En app/controllers/Principal.controlador.php
$respuesta = EnlacesModelo::enlaces_paginas($enlace);
```

### 2. Usando modelo con namespace

```php
// La clase está definida como:
namespace App\Models;
class EjemploModelo { /* ... */ }

// Para usarla, especificamos el namespace completo:
$mensaje = \App\Models\EjemploModelo::obtener_mensaje();
```

## Solución de Problemas

Si tienes problemas con el autoloading:

1. Activa la depuración estableciendo `AUTOLOADER_DEBUG` a `true` en `config/autoloader.config.php`
2. Verifica que la estructura de archivos y nomenclatura sea correcta
3. Ejecuta `composer dump-autoload` para refrescar el autoloader de Composer
4. Revisa el archivo de logs (`logs/errores.log`) para ver errores específicos
5. Prueba la carga explícita de la clase para identificar problemas:
   ```php
   require_once 'app/models/Entidad.modelo.php';
   ```

### Errores Comunes

| Error                                 | Solución                                                                                         |
| ------------------------------------- | ------------------------------------------------------------------------------------------------ |
| `Class X not found`                   | Verificar que el archivo exista en la ruta correcta y el nombre de la clase coincida exactamente |
| Conflicto de nombres entre namespaces | Usar nombres únicos para clases en diferentes namespaces                                         |
| Archivo no encontrado                 | Verificar que la convención de nombres se siga correctamente (`.modelo.php`, `.controlador.php`) |
