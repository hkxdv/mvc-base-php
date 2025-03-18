# Estructura Base del Proyecto MVC en PHP

Este documento detalla la estructura base MVC desarrollada para proyectos PHP, explicando cada directorio y componente esencial. **Esta es una estructura base**, diseñada para ser una plantilla inicial que puedes adaptar a tus necesidades específicas.

## Estructura de Carpetas

```
/
├── app/                     # Núcleo de la aplicación (MVC)
│   ├── controllers/         # Controladores de la aplicación
│   ├── models/              # Modelos para la lógica de negocio
│   │   └── sql/             # Scripts SQL para la creación de esquemas
│   └── views/               # Vistas para la presentación
│       ├── components/      # Componentes reutilizables
│       ├── modules/         # Módulos principales de la aplicación
│       ├── errors/          # Plantillas para páginas de error
│       └── templates/       # Plantillas base
├── assets/                  # Recursos estáticos
│   ├── css/                 # Hojas de estilo CSS
│   ├── js/                  # Scripts de JavaScript
│   │   ├── modules/         # Módulos JavaScript
│   │   └── utils/           # Utilidades JavaScript
│   └── img/                 # Imágenes y recursos gráficos
├── config/                  # Archivos de configuración
│   ├── autoloader.config.php    # Sistema de autoloading
│   ├── bootstrap.config.php     # Inicialización de la aplicación
│   ├── routes.config.php        # Configuración de rutas
│   ├── error_handler.config.php # Manejo de errores
│   └── alias.config.php         # Sistema de alias para rutas
├── docs/                    # Documentación del proyecto (opcional)
├── logs/                    # Registros de errores y eventos
├── vendor/                  # Dependencias (gestionadas por Composer)
├── .env.example             # Plantilla para variables de entorno
├── .gitignore               # Archivos a ignorar en control de versiones
├── .htaccess                # Configuración de Apache y manejo de errores HTTP
├── composer.json            # Definición de dependencias
└── index.php                # Punto de entrada principal
```

> **Nota importante**: Los componentes relacionados con la documentación (como el controlador DocumentacionControlador, vistas relacionadas y archivos en la carpeta docs/) son opcionales y solo sirven para mostrar información sobre la estructura base. Puedes eliminarlos en tus proyectos si no los necesitas.

## Componentes Esenciales

### 1. Archivos de Configuración

- **bootstrap.config.php**: Inicializa la aplicación, carga dependencias y configuraciones.
- **autoloader.config.php**: Sistema personalizado de carga automática de clases.
- **error_handler.config.php**: Manejo centralizado de errores y excepciones.
- **routes.config.php**: Definición de rutas estáticas de la aplicación.
- **alias.config.php**: Sistema de alias para simplificar rutas de archivos y recursos.

### 2. Estructura MVC

#### Controladores

- **Principal.controlador.php**: Controlador base que maneja el flujo principal.
- **Error.controlador.php**: Gestiona los errores de la aplicación.
- Otros controladores específicos para cada módulo.

#### Modelos

- **Conexion.modelo.php**: Gestiona la conexión a la base de datos.
- **Enlaces.modelo.php**: Maneja las rutas y enlaces dinámicos.
- Modelos específicos para entidades del sistema.

#### Vistas

- **templates/plantilla_base.php**: Estructura HTML principal.
- **templates/plantilla_error.php**: Plantilla específica para páginas de error.
- **modules/**: Contenido específico de cada sección.
- **components/**: Elementos reutilizables (menús, cabeceras, etc.).
- **errors/**: Vistas para diferentes tipos de errores.

### 3. Assets (Recursos Estáticos)

Organizados por tipo para facilitar su mantenimiento:

- **css/**: Estilos de la aplicación.
- **js/**: Scripts del lado del cliente.
- **img/**: Imágenes y elementos gráficos.

### 4. Archivos Raíz

- **index.php**: Punto de entrada único que inicia la aplicación.
- **.htaccess**: Configuración de Apache y manejo de URLs amigables.
- **composer.json**: Gestión de dependencias.
- **.env.example**: Plantilla para configuración de variables de entorno.

## Flujo de Ejecución

1. El usuario solicita una URL (ej: `index.php?option=dashboard`).
2. **index.php** carga el bootstrap de la aplicación.
3. **bootstrap.config.php** inicializa componentes esenciales.
4. **Principal.controlador.php** determina qué módulo cargar.
5. **Enlaces.modelo.php** obtiene la ruta del módulo solicitado.
6. Se carga la vista correspondiente dentro de la plantilla base.
7. El sistema de JavaScript carga los módulos JS necesarios para esa vista.

## Convenciones de Nomenclatura

### Archivos

- Controladores: `Nombre.controlador.php` (CapitalCase)
- Modelos: `Nombre.modelo.php` (CapitalCase)
- Módulos de Vista: `nombre_modulo.php` (snake_case)
- JavaScript: `nombre.modulo.js` o `nombre.util.js` (snake_case)

### Clases

- Controladores: `NombreControlador` (CapitalCase)
- Modelos: `NombreModelo` (CapitalCase)

### Métodos y Funciones

- PHP: `nombre_metodo()` (snake_case)
- JavaScript: `nombreFuncion()` (camelCase)
