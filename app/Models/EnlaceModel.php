<?php

/**
 * EnlaceModel.php
 * Modelo para gestionar los enlaces y rutas de la aplicación
 */

namespace App\Models;

use PDO;
use PDOException;
use App\Models\ConexionModel;
use App\Controllers\ErrorController;

/**
 * Clase para gestionar los enlaces y rutas de la aplicación
 */
class EnlaceModel
{
    /**
     * Obtiene la ruta de un módulo desde la base de datos
     * 
     * Busca en la tabla 'enlaces' la ruta correspondiente al nombre
     * del enlace proporcionado. Si no existe o hay un error, devuelve
     * la pagina de error 404.
     * 
     * @param string $enlace Nombre del enlace a buscar
     * @return string|null Ruta del archivo del módulo o null si debe mostrarse página de error
     * @throws \PDOException Si ocurre un error en la consulta a la base de datos
     */
    public static function rutaModulo(string $enlace): ?string
    {
        try {
            // Obtener la conexión a la base de datos
            $conexion = ConexionModel::conectar();
            if (!$conexion) {
                return null;
            }

            // Preparar la consulta para obtener la ruta del módulo
            $stmt = $conexion->prepare("SELECT ruta FROM enlaces WHERE nombre = :nombre AND estado = 1");

            // Vinculamos el parámetro ":nombre" con el valor del enlace
            $stmt->bindParam(":nombre", $enlace, PDO::PARAM_STR);

            // Ejecutamos la consulta
            $stmt->execute();

            // Verificamos si se encontró un registro
            if ($renglon = $stmt->fetch(PDO::FETCH_ASSOC)) {
                return $renglon["ruta"];
            } else {

                // Usar el controlador de errores con namespace PSR-4
                ErrorController::error404("Lo sentimos, la página que buscas no existe.");
                return null;
            }
        } catch (PDOException $e) {

            $mensaje = "Error al consultar la ruta para '$enlace': " . $e->getMessage();
            // Si es un error de conexión, mostrar error de BD
            if (strpos(strtolower($e->getMessage()), 'connect') !== false) {
                ErrorController::errorDb($mensaje);
            }

            return null;
        }
    }
}
