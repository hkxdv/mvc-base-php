/**
 * Sistema de caché para reducir llamadas al servidor
 * @module cache
 */

/**
 * Objeto que gestiona el almacenamiento de datos en caché
 */
const appCache = {
  data: {},
  ttl: {},

  /**
   * Almacena datos en la caché
   *
   * @param {string} key - Clave única para identificar los datos
   * @param {any} data - Datos a almacenar
   * @param {number} ttlSeconds - Tiempo de vida en segundos (por defecto 5 minutos)
   */
  set: function (key, data, ttlSeconds = 300) {
    this.data[key] = data;
    this.ttl[key] = Date.now() + ttlSeconds * 1000;
  },

  /**
   * Recupera datos de la caché si están disponibles y no han expirado
   *
   * @param {string} key - Clave de los datos a recuperar
   * @returns {any|null} - Datos almacenados o null si no existen o han expirado
   */
  get: function (key) {
    if (this.data[key] && this.ttl[key] > Date.now()) {
      return this.data[key];
    }
    return null;
  },

  /**
   * Elimina datos de la caché
   *
   * @param {string|null} key - Clave específica a eliminar, o null para limpiar toda la caché
   */
  clear: function (key = null) {
    if (key) {
      delete this.data[key];
      delete this.ttl[key];
    } else {
      this.data = {};
      this.ttl = {};
    }
  },

  /**
   * Verifica si una clave existe en la caché y no ha expirado
   *
   * @param {string} key - Clave a verificar
   * @returns {boolean} - true si la clave existe y es válida, false en caso contrario
   */
  has: function (key) {
    return this.data.hasOwnProperty(key) && this.ttl[key] > Date.now();
  },

  /**
   * Obtiene el tiempo restante de vida de una clave en segundos
   *
   * @param {string} key - Clave a verificar
   * @returns {number} - Segundos restantes, 0 si ha expirado o no existe
   */
  ttlRemaining: function (key) {
    if (!this.has(key)) {
      return 0;
    }

    const remaining = Math.max(0, this.ttl[key] - Date.now());
    return Math.floor(remaining / 1000);
  },
};

// Exportar el objeto de caché
export default appCache;
