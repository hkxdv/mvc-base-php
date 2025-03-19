/**
 * Módulo principal de la aplicación
 * @module app
 */

import { inicializarCargador } from "./cargador.modulo.js";

/**
 * Inicializa la aplicación cuando el DOM esté completamente cargado
 */
document.addEventListener("DOMContentLoaded", function () {
  inicializarAplicacion();
});

/**
 * Configura e inicializa los componentes principales de la aplicación
 *
 * @returns {void}
 */
function inicializarAplicacion() {
  try {
    console.log("Inicializando aplicación...");

    // Inicializar el cargador de módulos
    // El cargador se encarga de detectar la página actual y cargar los módulos correspondientes
    inicializarCargador();
  } catch (error) {
    console.error(`Error al inicializar la aplicación: ${error.message}`);
    mostrarNotificacionError(
      "No se pudo inicializar la aplicación correctamente"
    );
  }
}

/**
 * Muestra una notificación de error al usuario
 *
 * @param {string} mensaje - Mensaje de error para mostrar
 */
function mostrarNotificacionError(mensaje) {
  // Implementación básica, se debería reemplazar con un sistema de notificaciones real
  console.error(mensaje);

  if (window.Swal) {
    Swal.fire({
      icon: "error",
      title: "Error",
      text: mensaje,
      background: "var(--bg-tertiary)",
      color: "var(--text-primary)",
      confirmButtonColor: "var(--accent-color)",
    });
  } else {
    alert(mensaje);
  }
}

// Exportar funciones públicas
export { inicializarAplicacion };
