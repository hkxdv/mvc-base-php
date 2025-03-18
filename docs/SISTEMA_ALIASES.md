# Sistema de Aliases para Rutas

Este documento explica la arquitectura y el funcionamiento del sistema de aliases para rutas implementado en la estructura base MVC.

## Arquitectura General

El sistema implementa un mecanismo de resolución de rutas basado en aliases, que facilita el acceso a recursos y componentes de la aplicación.


## Tipos de Aliases

El sistema maneja dos categorías principales de aliases:

| Categoría  | Prefijo                  | Descripción                                 | Ejemplo                                                        |
| ---------- | ------------------------ | ------------------------------------------- | -------------------------------------------------------------- |
| URLs       | @Img, @Js, @Css, etc.    | Rutas para recursos web accesibles vía HTTP | `@Js` → `http://localhost/mvc-optisala-reuniones/assets/js/`   |
| Filesystem | @Meta_datos, @Menu, etc. | Rutas de archivos físicos en el servidor    | `@Meta_datos` → `/path/to/app/views/components/meta_datos.php` |

## Flujo de Trabajo del Sistema de Aliases

Cuando se solicita resolver un alias, el sistema sigue el siguiente flujo:

1. **Verificación de caché**: Comprueba si la ruta ya ha sido resuelta previamente

   - Devuelve la ruta cacheada si está disponible
   - Continúa al siguiente paso si no está en caché

2. **Ordenamiento de aliases**:

   - Ordena los aliases por longitud (de más largo a más corto)
   - Evita problemas cuando un alias es prefijo de otro (ej: `@Meta_datos` vs `@Meta_datos_error`)

3. **Resolución de ruta**:

   - Busca coincidencias entre la ruta solicitada y los aliases disponibles
   - Reemplaza el alias encontrado con su valor completo

4. **Verificación de existencia** (opcional para archivos):

   - Para rutas de sistema de archivos, verifica que el archivo realmente existe
   - Genera una advertencia si el archivo no existe
   - Registra el error en el log del sistema

5. **Almacenamiento en caché**:

   - Guarda la resolución en caché para futuras solicitudes
   - Mejora el rendimiento en solicitudes repetidas

6. **Devolución del resultado**:
   - Devuelve la ruta completamente resuelta

## Implementación Técnica

El sistema está implementado mediante un array asociativo de aliases y una función helper:

### Definición de Aliases

```php
define('ALIASES', [
    // Rutas de recursos (URLs)
    '@Img' => URL_BASE . 'assets/img/',
    '@Js' => URL_BASE . 'assets/js/',
    '@Css' => URL_BASE . 'assets/css/',
    // ...

    // Rutas de archivos (filesystem paths)
    '@Meta_datos' => PATH_BASE . '/app/views/components/meta_datos.php',
    '@Menu' => PATH_BASE . '/app/views/components/menu.php',
    // ...
]);
```

## Uso en la Aplicación

El sistema de aliases se utiliza principalmente en:

### 1. Inclusión de Componentes en Plantillas

```php
// Incluir componentes reutilizables
include alias('@Meta_datos');
include alias('@Menu');
```

### 2. Referencia a Recursos Estáticos en HTML/JavaScript

```php
// En HTML
<link rel="stylesheet" href="<?php echo alias('@Css'); ?>styles.css">
<script src="<?php echo alias('@Js'); ?>main.js"></script>

// En JavaScript (mediante PHP)
<script>
    const imgBase = '<?php echo alias('@Img'); ?>';
    loadImage(imgBase + 'logo.png');
</script>
```

## Ventajas del Sistema

1. **Simplificación de referencias**:

   - Evita rutas relativas complejas (`../../../`)
   - Reduce errores de ruta en archivos profundamente anidados

2. **Rendimiento optimizado**:

   - Sistema de caché que evita resolver repetidamente las mismas rutas
   - Ordenamiento inteligente para resolver ambigüedades

3. **Detección de problemas**:

   - Verificación automática de existencia de archivos
   - Mensajes de error descriptivos que facilitan la depuración

4. **Centralización**:
   - Todas las rutas definidas en un único archivo de configuración
   - Facilita el mantenimiento y actualización

## Consideraciones de Uso

### Cuándo usar aliases

- Para componentes reutilizables que se incluyen en múltiples vistas
- Para recursos estáticos (CSS, JS, imágenes) referenciados desde diferentes partes de la aplicación
- Para plantillas y layouts compartidos
- Para archivos que están fuera del flujo MVC principal

### Cuándo no usar aliases

- Para rutas dinámicas que se determinan en tiempo de ejecución
- Para rutas temporales o que cambien frecuentemente
- Para controladores y modelos en la arquitectura MVC (estos deberían usar el sistema de enrutamiento MVC)
