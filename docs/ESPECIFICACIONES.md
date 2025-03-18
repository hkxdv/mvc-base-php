# Especificaciones Técnicas de la Estructura Base MVC

**Última actualización:** 15/03/2025

> [!IMPORTANT]
>
> **NOTA EDUCATIVA Y DE LICENCIA**  
> Este documento y el proyecto asociado son de naturaleza puramente educativa, desarrollados en un contexto académico.
>
> - **Propósito de aprendizaje**: El objetivo principal es servir como herramienta para aprender sobre arquitecturas, estándares y buenas prácticas, no para demostrar una implementación perfecta o producción.
> - La arquitectura MVC implementada está adaptada para fines didácticos y puede no reflejar todas las mejores prácticas de una implementación profesional completa.
> - Se invita a los estudiantes a experimentar, modificar y mejorar esta base según avance su comprensión de los conceptos.
> - Todo el código y documentación se consideran de código abierto y pueden utilizarse, modificarse y distribuirse libremente con propósitos educativos.
> - Se recomienda no utilizar esta implementación directamente en entornos de producción sin realizar las adaptaciones necesarias para cumplir con estándares industriales de seguridad y eficiencia.

Este documento establece las especificaciones técnicas, estándares y guías para el desarrollo de aplicaciones basadas en la estructura MVC proporcionada. Sirve como referencia para mantener la consistencia y calidad en el desarrollo de proyectos que utilicen esta base.

## Índice

- [Especificaciones Técnicas de la Estructura Base MVC](#especificaciones-técnicas-de-la-estructura-base-mvc)
  - [Índice](#índice)
  - [Arquitectura MVC](#arquitectura-mvc)
    - [Responsabilidades](#responsabilidades)
      - [Modelos](#modelos)
      - [Controladores](#controladores)
      - [Vistas](#vistas)
  - [Estándares de Codificación](#estándares-de-codificación)
    - [Convenciones de Nombrado](#convenciones-de-nombrado)
      - [Archivos](#archivos)
      - [Variables y Funciones](#variables-y-funciones)
      - [Base de Datos PostgreSQL](#base-de-datos-postgresql)
    - [Estructura de Clases y Módulos](#estructura-de-clases-y-módulos)
      - [PHP](#php)
      - [JavaScript (ES6)](#javascript-es6)
    - [Documentación de Código](#documentación-de-código)
      - [PHPDoc](#phpdoc)
      - [JSDoc](#jsdoc)
  - [Especificaciones de Base de Datos](#especificaciones-de-base-de-datos)
    - [Normalización](#normalización)
    - [Campos y Tipos de Datos](#campos-y-tipos-de-datos)
      - [Campos Obligatorios](#campos-obligatorios)
      - [Tipos de Datos Recomendados](#tipos-de-datos-recomendados)
      - [Restricciones de Nulidad](#restricciones-de-nulidad)
      - [Relación Entre Tablas](#relación-entre-tablas)
  - [Arquitectura Frontend](#arquitectura-frontend)
    - [Módulos JavaScript ES6](#módulos-javascript-es6)
      - [Estructura de Módulos](#estructura-de-módulos)
      - [Ejemplo de Clase](#ejemplo-de-clase)
    - [Framework CSS Tailwind](#framework-css-tailwind)
  - [Seguridad y Optimización](#seguridad-y-optimización)
    - [Principios de Seguridad](#principios-de-seguridad)
    - [Manejo de Errores](#manejo-de-errores)
      - [PHP](#php-1)
      - [JavaScript](#javascript)
  - [Limitaciones y Propósito Educativo](#limitaciones-y-propósito-educativo)
    - [Naturaleza Educativa del Proyecto](#naturaleza-educativa-del-proyecto)
    - [Limitaciones](#limitaciones)

## Arquitectura MVC

### Responsabilidades

#### Modelos

- **Función**: Gestionar la conexión y operaciones con la base de datos
- **Responsabilidades**:
  - Implementar métodos CRUD para entidades del sistema
  - Aplicar validaciones de datos
  - Encapsular la lógica de negocio
  - Optimizar consultas SQL
  - Implementar transacciones para operaciones complejas

#### Controladores

- **Función**: Coordinar las interacciones entre modelo y vista
- **Responsabilidades**:
  - Procesar las solicitudes del usuario
  - Validar datos de entrada
  - Llamar a los métodos apropiados del modelo
  - Preparar los datos para las vistas
  - Gestionar redirecciones y mensajes de estado
  - Proporcionar endpoints API para interacciones AJAX

#### Vistas

- **Función**: Presentar la información al usuario
- **Responsabilidades**:
  - Mostrar los datos proporcionados por el controlador
  - Implementar formularios para la entrada de datos
  - Mantener una interfaz de usuario consistente
  - Separar la lógica de presentación de la lógica de negocio
  - Utilizar componentes reutilizables

## Estándares de Codificación

> [!WARNING]
>
> **NOTA SOBRE ESTÁNDARES PSR**  
> Las convenciones definidas en este documento **no** siguen los estándares PSR (PHP Standards Recommendations) oficiales. Algunas diferencias importantes incluyen:
>
> - Este documento usa `snake_case` para métodos, mientras que PSR-1/PSR-12 recomienda `camelCase`
> - La estructura de archivos y extensiones (`.modelo.php`, `.controlador.php`) difiere de las recomendaciones PSR-4 para autoloader
> - Las convenciones de formato de código (indentación, espacios vs. tabs) pueden diferir de PSR-12
>
> El documento es un estándar personalizado adaptado para fines educativos, con énfasis en la claridad y separación de responsabilidades según el patrón MVC, pero no se adhiere a los estándares PSR oficiales para PHP.

### Convenciones de Nombrado

#### Archivos

| Tipo de archivo            | Convención                       | Ejemplo                     |
| -------------------------- | -------------------------------- | --------------------------- |
| Clases MVC (modelos)       | CapitalCase + `.modelo.php`      | `Entidad.modelo.php`        |
| Clases MVC (controladores) | CapitalCase + `.controlador.php` | `Principal.controlador.php` |
| Vistas de módulos          | snake_case + `.modulo.php`       | `listado.modulo.php`        |
| Vistas de componentes      | snake_case + `.php`              | `menu.php`                  |
| Archivos SQL               | snake_case + `.sql`              | `funciones_pg.sql`          |
| Módulos JavaScript         | snake_case + `.modulo.js`        | `app.modulo.js`             |
| Utilidades JavaScript      | snake_case + `.util.js`          | `validacion.util.js`        |

Esta convención permite identificar fácilmente el propósito y tipo de cada archivo, manteniendo el código organizado y coherente. La extensión `.modulo` sirve para distinguir claramente los componentes modulares tanto en el frontend como en el backend, facilitando la identificación de archivos con responsabilidades específicas en la arquitectura del sistema.

- Los archivos de clases siguen la convención CapitalCase porque representan entidades del sistema
- Los archivos funcionales (que no contienen clases) siguen la convención snake_case para mantener consistencia con el estilo de sus funciones internas.

#### Variables y Funciones

**PHP**

| Elemento   | Convención       | Ejemplo             |
| ---------- | ---------------- | ------------------- |
| Clases     | CapitalCase      | `EntidadModelo`     |
| Métodos    | snake_case       | `obtener_por_id()`  |
| Funciones  | snake_case       | `obtener_entidad()` |
| Variables  | snake_case       | `$nombre_entidad`   |
| Constantes | UPPER_SNAKE_CASE | `MAX_REGISTROS`     |

> [!NOTE]
>
> **ESTÁNDARES JAVASCRIPT ES6**  
> A diferencia de PHP, para JavaScript se seguirán los estándares más comunes de ES6:

**JavaScript (Estándares ES6)**

| Elemento   | Convención       | Ejemplo            |
| ---------- | ---------------- | ------------------ |
| Clases     | PascalCase       | `GestorDatos`      |
| Métodos    | camelCase        | `cargarDatos()`    |
| Funciones  | camelCase        | `obtenerEntidad()` |
| Variables  | camelCase        | `nombreUsuario`    |
| Constantes | UPPER_SNAKE_CASE | `API_URL`          |

#### Base de Datos PostgreSQL

| Elemento         | Convención                                                | Ejemplo              |
| ---------------- | --------------------------------------------------------- | -------------------- |
| Tablas           | Sustantivo en singular                                    | `entidad`            |
| Llaves primarias | Prefijo `pk_` seguido del nombre de la tabla              | `pk_entidad`         |
| Llaves foráneas  | Prefijo `fk_` seguido del nombre de la tabla referenciada | `fk_entidad`         |
| Índices          | Prefijo `idx_` seguido de las columnas indexadas          | `idx_entidad_nombre` |
| Campos booleanos | Prefijo `es_` o `tiene_`                                  | `es_activo`          |
| Campos de estado | `estado` con valores numéricos                            | `estado`             |
| Marcas de tiempo | `fecha_creacion`, `fecha_actualizacion`                   | `fecha_creacion`     |

### Estructura de Clases y Módulos

#### PHP

- Todas las clases deben tener un propósito único y bien definido
- Seguir el principio de responsabilidad única
- Métodos estáticos para operaciones que no requieren estado

```php
/**
 * Clase para gestionar operaciones relacionadas con la entidad
 */
class EntidadModelo
{
    /**
     * Obtiene un registro por su identificador
     *
     * @param int $id Identificador del registro
     * @return array|null Datos del registro o null si no existe
     */
    public function obtener_por_id($id)
    {
        // Implementación
    }
}
```

#### JavaScript (ES6)

- Cada módulo debe tener una única responsabilidad
- Exportar solo lo necesario
- Importar dependencias de forma explícita
- Usar documentación JSDoc

```javascript
/**
 * Módulo para gestionar datos de entidades
 * @module datos
 */

import { mostrarNotificacion } from "../utilidades.modulo.js";

/**
 * Obtiene los datos de una entidad desde la API
 *
 * @param {number} id - Identificador de la entidad
 * @returns {Promise<Object>} - Datos de la entidad
 */
export async function obtenerEntidad(id) {
  try {
    const respuesta = await fetch(`api.php?action=obtener&id=${id}`);

    if (!respuesta.ok) {
      throw new Error(`Error HTTP: ${respuesta.status}`);
    }

    return await respuesta.json();
  } catch (error) {
    console.error(`Error al obtener entidad: ${error.message}`);
    mostrarNotificacion("Error al cargar datos", "error");
    throw error;
  }
}
```

### Documentación de Código

#### PHPDoc

```php
<?php
/**
 * Nombre_archivo.php
 * Descripción breve del propósito del archivo
 */

/**
 * Clase para gestionar operaciones relacionadas con entidades
 */
class EntidadModelo
{
    /**
     * Obtiene registros según criterios de filtrado
     *
     * @param array $filtros Criterios de filtrado (opcional)
     * @param int $limite Número máximo de registros a devolver
     * @return array Registros que cumplen con los criterios
     * @throws Exception Si ocurre un error en la base de datos
     */
    public function obtener_registros($filtros = [], $limite = 100)
    {
        // Implementación
    }
}
```

#### JSDoc

```javascript
/**
 * Módulo para gestionar la interfaz de usuario
 * @module ui
 */

/**
 * Muestra una notificación al usuario
 *
 * @param {string} mensaje - Texto de la notificación
 * @param {string} tipo - Tipo de notificación (success, error, warning, info)
 * @param {number} [duracion=3000] - Duración en milisegundos
 * @returns {void}
 */
export function mostrarNotificacion(mensaje, tipo, duracion = 3000) {
  // Implementación
}
```

## Especificaciones de Base de Datos

### Normalización

Todas las bases de datos deben estar normalizadas hasta la Tercera Forma Normal (3FN):

1. **Primera Forma Normal (1FN)**:

   - Eliminar grupos repetitivos
   - Crear tabla separada para cada conjunto de datos relacionados
   - Identificar cada conjunto con una clave primaria

2. **Segunda Forma Normal (2FN)**:

   - Cumplir con 1FN
   - Eliminar subconjuntos de datos aplicables a múltiples filas
   - Crear tablas separadas para estos subconjuntos
   - Relacionar mediante claves foráneas

3. **Tercera Forma Normal (3FN)**:
   - Cumplir con 2FN
   - Eliminar campos que no dependan de la clave primaria
   - Mover estos campos a tablas apropiadas

### Campos y Tipos de Datos

#### Campos Obligatorios

Cada tabla debe incluir los siguientes campos:

| Campo    | Tipo     | Descripción                                | Restricción        |
| -------- | -------- | ------------------------------------------ | ------------------ |
| `hora`   | TIME     | Hora en que se almacena el registro        | NOT NULL           |
| `fecha`  | DATE     | Fecha en que se almacena el registro       | NOT NULL           |
| `estado` | SMALLINT | Estado del registro (1=activo, 0=inactivo) | NOT NULL DEFAULT 1 |

#### Tipos de Datos Recomendados

| Tipo de Dato | Uso Recomendado             | PostgreSQL          |
| ------------ | --------------------------- | ------------------- |
| Enteros      | Identificadores, cantidades | `INTEGER`, `SERIAL` |
| Texto corto  | Nombres, títulos            | `VARCHAR(100)`      |
| Texto largo  | Descripciones extensas      | `TEXT`              |
| Fechas       | Fechas de eventos           | `DATE`              |
| Hora         | Horarios                    | `TIME`              |
| Fecha y hora | Marcas de tiempo            | `TIMESTAMP`         |
| Booleanos    | Estados binarios            | `BOOLEAN`           |

#### Restricciones de Nulidad

- Las llaves primarias siempre deben ser NOT NULL
- Las llaves foráneas no deben permitir valores nulos, salvo justificación específica
- Los campos específicos del negocio deben evaluarse individualmente

#### Relación Entre Tablas

- Implementar mediante llaves foráneas
- Especificar acciones ON DELETE y ON UPDATE
- Tipos de relaciones: Uno a uno (1:1), Uno a muchos (1:N), Muchos a muchos (N:M)

## Arquitectura Frontend

### Módulos JavaScript ES6

#### Estructura de Módulos

```txt
assets/js/
├── modules/               # Módulos de la aplicación
│   ├── app.modulo.js      # Punto de entrada principal
│   ├── cargador.modulo.js # Cargador dinámico de módulos
│   └── componentes/       # Componentes específicos
└── utils/                 # Utilidades de JavaScript
    └── validacion.util.js # Utilidades de validación
```

> [!IMPORTANT]
> Aunque el patrón de nombrado de archivos sigue la convención snake_case con sufijos `.modulo.js` y `.util.js`,
> el código dentro de estos archivos debe seguir las convenciones ES6 (camelCase para métodos y variables).

**Inicialización de Módulos**:

- El archivo `app.modulo.js` actúa como punto de entrada principal
- `cargador.modulo.js` gestiona la carga dinámica basada en la página actual
- Cada módulo específico se autogestiona, inicializándose cuando es importado

#### Ejemplo de Clase

```javascript
/**
 * Clase para gestionar datos de entidades
 */
export class GestorEntidades {
  /**
   * Inicializa una nueva instancia del gestor
   *
   * @param {string} urlApi - URL base de la API
   * @param {Object} opciones - Configuración adicional
   */
  constructor(urlApi, opciones = {}) {
    this.urlApi = urlApi;
    this.opciones = opciones;
    this.elementos = [];
  }

  /**
   * Carga elementos desde la API
   *
   * @param {Object} filtros - Filtros para la búsqueda
   * @returns {Promise<Array>} - Promesa que resuelve a un array de elementos
   */
  async cargarElementos(filtros) {
    // Implementación
    const params = new URLSearchParams(filtros);
    const respuesta = await fetch(`${this.urlApi}?${params}`);
    return await respuesta.json();
  }
}
```

### Framework CSS Tailwind

La interfaz de usuario debe implementarse utilizando Tailwind CSS para mantener consistencia, facilitar el mantenimiento y permitir un desarrollo rápido:

**Principios de Uso**:

- **Clases Utilitarias**: Utilizar las clases utilitarias de Tailwind CSS directamente en el HTML
- **Componentes Personalizados**: Crear componentes reutilizables mediante la combinación de clases
- **Diseño Responsivo**: Implementar diseños responsivos utilizando los prefijos de breakpoint
- **Tema Personalizado**: Extender el tema de Tailwind mediante la configuración adecuada

## Seguridad y Optimización

### Principios de Seguridad

1. **Validación de Datos**
   - Validar en cliente y servidor
   - Sanitizar entradas y salidas

```php
// Ejemplo de validación y sanitización
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if ($id === false || $id <= 0) {
    // Error: ID inválido
    return false;
}

// Preparar consulta (previene inyección SQL)
$stmt = $conexion->prepare("SELECT * FROM entidad WHERE pk_entidad = :id");
$stmt->bindParam(":id", $id, PDO::PARAM_INT);
$stmt->execute();

// Sanitizar salida (previene XSS)
echo htmlspecialchars($dato, ENT_QUOTES, "UTF-8");
```

2. **Protección de Información Sensible**

- Usar .env para configuraciones sensibles o específicas del entorno
- Nunca incluir .env en el repositorio (usar .env.example como plantilla)
- Cargar variables de entorno al inicio de la aplicación

```php

// Cargar variables de entorno con phpdotenv si existe .env
if (file_exists(__DIR__ . "/../.env")) {
    Dotenv\Dotenv::createImmutable(dirname(__DIR__))->load();
}
// Uso
$host = $_ENV["DB_HOST"];
$dbname = $_ENV["DB_NAME"];
```

### Manejo de Errores

#### PHP

```php
try {
    // Operación que puede fallar
    $resultado = $modelo->procesar_datos($datos);
    return $resultado;
} catch (Exception $e) {
    // Registrar el error
    error_log("Error en procesamiento: " . $e->getMessage());

    // Devolver respuesta de error
    return ["estado" => "error", "mensaje" => "No se pudo procesar la solicitud"];
}
```

- Usar bloques try-catch para capturar excepciones
- Registrar errores en archivos de log mediante `error_log()`
- Mostrar mensajes de error amigables al usuario

#### JavaScript

Similar a PHP, el manejo de errores en JavaScript debe seguir estas prácticas:

- Usar bloques try-catch para operaciones propensas a errores
- Registrar errores en la consola o en un servicio de logging

```javascript
/**
 * Carga datos desde la API
 *
 * @param {string} endpoint - Punto final de la API
 * @returns {Promise<Object>} - Datos obtenidos de la API
 * @throws {Error} - Error si la solicitud falla
 */
async function cargarDatosApi(endpoint) {
  try {
    const respuesta = await fetch(endpoint);

    if (!respuesta.ok) {
      throw new Error(`Error HTTP: ${respuesta.status}`);
    }

    return await respuesta.json();
  } catch (error) {
    console.error(`Error al cargar datos: ${error.message}`);
    mostrarNotificacion("Error al cargar datos", "error");
    throw error;
  }
}
```

## Limitaciones y Propósito Educativo

### Naturaleza Educativa del Proyecto

Este proyecto y sus especificaciones han sido desarrollados en un contexto educativo universitario. La arquitectura MVC implementada está simplificada para facilitar el aprendizaje y la comprensión de los conceptos fundamentales.

### Limitaciones

1. **Seguridad**: Implementación básica, no suficiente para producción
2. **Escalabilidad**: Requiere modificaciones para mayor escala
3. **Rendimiento**: Optimizaciones limitadas
4. **Compatibilidad**: Probado en entornos específicos

Se invita a los usuarios a extender y mejorar este código como parte de su proceso de aprendizaje, pero se recomienda precaución al implementarlo en entornos de producción.
