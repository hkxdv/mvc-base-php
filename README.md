# Estructura Base MVC en PHP

Estructura base desarrollada en PHP con arquitectura MVC para crear aplicaciones web. Este proyecto sirve como punto de partida para desarrollar tus propias aplicaciones, manteniendo buenas prácticas de organización de código.

<div align="center">
  <img src="https://img.shields.io/badge/-PHP-000000?style=for-the-badge&logo=php&labelColor=282c34"/>
  <img src="https://img.shields.io/badge/-PostgreSQL-000000?style=for-the-badge&logo=postgresql&labelColor=282c34"/>
  <img src="https://img.shields.io/badge/-XAMPP-000000?style=for-the-badge&logo=xampp&labelColor=282c34"/>
  <img src="https://img.shields.io/badge/-Composer-000000?style=for-the-badge&logo=composer&labelColor=282c34"/>
</div>

## Descripción

Esta estructura base MVC (Modelo-Vista-Controlador) está diseñada como punto de partida para el desarrollo de aplicaciones web en PHP. No es un framework completo, sino una plantilla estructurada que puedes adaptar según tus necesidades específicas.

> Para las especificaciones técnicas detalladas, consulta: [ESPECIFICACIONES.md](docs/ESPECIFICACIONES.md)

## Características Principales

### Arquitectura MVC

```php
// Ejemplo básico de un controlador
class EjemploControlador {
    public static function index() {
        $datos = EjemploModelo::obtener_datos();
        include "app/views/modules/ejemplo_vista.php";
    }
}
```

### Sistema de Aliases para Rutas

```php
// Ejemplo de uso del sistema de alias
include alias('@Meta_datos');
<link rel="stylesheet" href="<?php echo alias('@Css'); ?>styles.css">
```

## Estructura de Carpetas

La estructura sigue el patrón MVC con carpetas específicas para:

- **app/controllers/**: Controladores de la aplicación
- **app/models/**: Modelos para la lógica de negocio
- **app/views/**: Vistas para la presentación
- **config/**: Archivos de configuración del sistema
- **assets/**: Recursos estáticos (CSS, JS, imágenes)
- **docs/**: Documentación (opcional)

> La estructura completa se detalla en [ESTRUCTURA_BASE.md](docs/ESTRUCTURA_BASE.md)

## Componentes Opcionales

La documentación incluida (controlador, vistas y archivos en /docs) es completamente opcional y sirve principalmente como ejemplo y guía. Puedes eliminar estos componentes en tus proyectos si no los necesitas.

```php
// DocumentacionControlador.php - Componente opcional
class DocumentacionControlador {
    // Este controlador es OPCIONAL y puede eliminarse
    public static function index() {
        $archivos = self::obtener_lista_documentos();
        include "app/views/docs/listado.php";
    }
}
```

> [!NOTE]
>
> Esta estructura es un punto de partida. Está diseñada para ser simple y fácilmente adaptable a tus necesidades específicas.

## 🥷 Autor

<a href="https://github.com/hk4u-dxv">
  <img src="https://img.shields.io/badge/-hk4u--dxv-000000?style=for-the-badge&logo=github&labelColor=282c34"/>
</a>

<div align="center">
  <p>Estructura base MVC para el desarrollo de aplicaciones PHP.</p>
  <p>Diseñada como punto de partida para tus proyectos.</p>
</div>
