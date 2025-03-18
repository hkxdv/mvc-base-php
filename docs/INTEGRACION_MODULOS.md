# Guía de Integración de Módulos

Este documento explica el proceso para integrar nuevos módulos en tu aplicación utilizando la estructura base MVC. Recuerda que puedes personalizar esta estructura según tus necesidades específicas, incluyendo la eliminación de los componentes de documentación si no los requieres.

## Arquitectura de Módulos

El sistema sigue una arquitectura MVC (Modelo-Vista-Controlador) con carga dinámica de módulos JavaScript según la página actual:

```txt
/
├── app/
│   └── views/
│       └── modules/    # Módulos de vista
└── assets/
    └── js/
        ├── modules/    # Módulos JavaScript (.modulo.js)
        └── utils/      # Utilidades JavaScript (.util.js)
```

## Flujo de Carga de Páginas y Módulos

1. El usuario accede a una URL (ej: `index.php?option=salas`)
2. El controlador principal (`Principal.controlador.php`) procesa el parámetro `option`
3. Se carga la vista PHP correspondiente (ej: `app/views/modules/salas.php`)
4. El template principal (`plantilla_base.php`) carga el módulo JavaScript principal (`app.modulo.js`)
5. `app.modulo.js` inicializa el cargador de módulos (`cargador.modulo.js`)
6. El cargador detecta la página actual según el parámetro `option` y carga los módulos JavaScript correspondientes

## Sistema de Carga Dinámica de Módulos JavaScript

El sistema utiliza un cargador dinámico de módulos (`cargador.modulo.js`) que determina qué módulos JavaScript deben cargarse según la página actual:

## Relación entre Módulos PHP y JavaScript

Cada módulo de vista PHP (`app/views/modules/*.php`) tiene su correspondiente módulo JavaScript (`assets/js/modules/*.modulo.js`):

| Módulo PHP        | Módulo(s) JavaScript                                             |
| ----------------- | ---------------------------------------------------------------- |
| principal.php     | dashboard.modulo.js                                              |
| salas.php         | salas.modulo.js, calendario.modulo.js                            |
| reuniones.php     | reuniones.modulo.js, calendario.modulo.js, formularios.modulo.js |
| cronograma.php    | cronograma.modulo.js, calendario.modulo.js                       |
| optimizacion.php  | optimizacion.modulo.js                                           |
| recursos.php      | formularios.modulo.js                                            |
| participantes.php | formularios.modulo.js                                            |

## Inicialización de Módulos JavaScript

Todos los módulos JavaScript exportan una función `init()` que se llama automáticamente cuando el módulo se carga:

```javascript
/**
 * Inicializa el módulo de salas
 */
export function init() {
  console.log("Inicializando módulo de salas...");

  // Asociar eventos a elementos del DOM
  const btnBuscar = document.getElementById("btn-buscar-salas");
  if (btnBuscar) {
    btnBuscar.addEventListener("click", buscarSalas);
  }

  // Cargar datos iniciales
  cargarSalas();
}
```

## Cómo Agregar un Nuevo Módulo

### 1. Crear un Nuevo Módulo de Vista PHP

Crear un archivo en `app/views/modules/`, por ejemplo `nuevo_modulo.php`:

```php
<div class="card mb-4">
    <div class="card-header">
        <h2>Nuevo Módulo</h2>
    </div>
    <div class="card-body">
        <!-- Contenido del módulo -->
        <div id="nuevo-modulo-container">
            <!-- Este contenedor será manipulado por el JavaScript -->
        </div>
    </div>
</div>
```

### 2. Crear el Módulo JavaScript Correspondiente

Crear un archivo en `assets/js/modules/`, por ejemplo `nuevo_modulo.modulo.js`:

```javascript
/**
 * Módulo para gestionar la nueva funcionalidad
 * @module nuevo_modulo
 */

/**
 * Inicializa el módulo
 */
export function init() {
  console.log("Inicializando nuevo módulo...");

  // Inicializar componentes
  const container = document.getElementById("nuevo-modulo-container");
  if (!container) return;

  // Cargar datos o inicializar eventos
  container.innerHTML = "<p>Módulo inicializado correctamente</p>";
}

/**
 * Función específica del módulo
 */
function funcionEspecifica() {
  // Implementación
}
```

### 3. Registrar el Módulo en el Cargador

Modificar `cargador.modulo.js` para incluir el nuevo módulo:

```javascript
const MODULOS_POR_PAGINA = {
  // Módulos existentes...
  nuevo_modulo: ["nuevo_modulo.modulo.js"],
};
```

### 4. Actualizar el Controlador (si es necesario)

Si se requiere una nueva ruta, actualizar el controlador para manejar la nueva opción.

## Mejores Prácticas

1. **Naming convention**:

   - Módulos PHP: `nombre_modulo.php`
   - Módulos JS: `nombre_modulo.modulo.js`
   - Utilidades JS: `nombre_utilidad.util.js`

2. **Estructura de módulos JavaScript**:

   - Exportar una función `init()` que inicialice el módulo
   - Mantener funciones auxiliares como privadas dentro del módulo
   - Documentar cada función con JSDoc

3. **Separación de responsabilidades**:

   - PHP: renderizado de la estructura HTML y datos iniciales
   - JavaScript: interactividad, validaciones y actualización dinámica

4. **Evitar código JavaScript en archivos PHP**:
   - Todo el código JavaScript debe estar en archivos `.modulo.js` o `.util.js`
   - Los archivos PHP sólo deben contener etiquetas `<script>` para referenciar módulos, no para definir funciones
