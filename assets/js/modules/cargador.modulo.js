/**
 * Módulo para cargar dinámicamente otros módulos según la página actual
 * @module cargador
 */

// Mapeo de páginas a módulos
const MODULOS_POR_PAGINA = {
  dashboard: ["dashboard.modulo.js"],
};

// Módulos comunes a todas las páginas
const MODULOS_COMUNES = [""];

/**
 * Inicializa el cargador de módulos
 *
 * @returns {Promise<void>}
 */
export async function inicializarCargador() {
  try {
    const paginaActual = obtenerPaginaActual();
    console.log(`Cargando módulos para: ${paginaActual}`);

    // Cargar módulos comunes
    await cargarModulosComunes();

    // Cargar módulos específicos para la página
    await cargarModulosPorPagina(paginaActual);

    console.log("Todos los módulos cargados correctamente");
  } catch (error) {
    console.error(`Error en la carga de módulos: ${error.message}`);
    throw new Error(`Fallo al cargar módulos: ${error.message}`);
  }
}

/**
 * Obtiene el identificador de la página actual
 *
 * @returns {string} Identificador de la página
 */
function obtenerPaginaActual() {
  // 1. Intentar obtenerlo desde un atributo data en el body
  const dataPage = document.body.dataset.page;
  if (dataPage) {
    return dataPage;
  }

  // 2. Buscar el parámetro option en la URL (prioridad)
  const urlParams = new URLSearchParams(window.location.search);
  const optionParam = urlParams.get("option");
  if (optionParam) {
    return optionParam;
  }

  // 3. Extraer del nombre de archivo (fallback)
  const ruta = window.location.pathname;
  const nombreArchivo = ruta.split("/").pop().replace(".php", "");

  // Si el archivo es index.php, asumimos que es la página principal
  if (nombreArchivo === "index" || nombreArchivo === "") {
    return "principal";
  }

  return nombreArchivo;
}

/**
 * Carga los módulos comunes para todas las páginas
 *
 * @returns {Promise<void>}
 */
async function cargarModulosComunes() {
  try {
    const promesas = MODULOS_COMUNES.map(async (nombreModulo) => {
      await cargarModulo(nombreModulo);
    });

    await Promise.all(promesas);
    console.log("Módulos comunes cargados");
  } catch (error) {
    console.error(`Error al cargar módulos comunes: ${error.message}`);
    throw error;
  }
}

/**
 * Carga los módulos específicos para una página
 *
 * @param {string} pagina - Identificador de la página
 * @returns {Promise<void>}
 */
async function cargarModulosPorPagina(pagina) {
  try {
    const modulosParaCargar = MODULOS_POR_PAGINA[pagina] || [];

    if (modulosParaCargar.length === 0) {
      console.warn(
        `No hay módulos específicos definidos para la página: ${pagina}`
      );
      return;
    }

    const promesas = modulosParaCargar.map(async (nombreModulo) => {
      await cargarModulo(nombreModulo);
    });

    await Promise.all(promesas);
    console.log(`Módulos para la página "${pagina}" cargados`);
  } catch (error) {
    console.error(
      `Error al cargar módulos para página ${pagina}: ${error.message}`
    );
    throw error;
  }
}

/**
 * Carga un módulo específico dinámicamente
 *
 * @param {string} nombreModulo - Nombre del archivo del módulo
 * @returns {Promise<object>} Módulo cargado
 */
async function cargarModulo(nombreModulo) {
  try {
    console.log(`Cargando módulo: ${nombreModulo}`);
    const rutaCompleta = `../modules/${nombreModulo}`;

    const modulo = await import(rutaCompleta);
    console.log(`Módulo ${nombreModulo} cargado correctamente`);

    // Inicializar el módulo si tiene un método init
    if (typeof modulo.init === "function") {
      modulo.init();
    }

    return modulo;
  } catch (error) {
    console.error(
      `Error al cargar el módulo ${nombreModulo}: ${error.message}`
    );
    throw error;
  }
}
