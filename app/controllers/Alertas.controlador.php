<?php

/**
 * Alertas.controlador.php
 * Controlador para gestionar las alertas de la aplicación
 * 
 * Esta clase proporciona métodos para mostrar mensajes de éxito, error, 
 * información y advertencia, utilizando la biblioteca SweetAlert para 
 * una mejor experiencia de usuario en el sistema de optimización de salas.
 */
class AlertasControlador
{
    /**
     * Muestra una alerta con formato específico
     * 
     * @param string $mensaje Mensaje a mostrar
     * @param string $tipo Tipo de alerta (exito, error, info, advertencia)
     * @param array $opciones Opciones adicionales (autoclose, showConfirmButton, etc)
     * @return string Código HTML y JavaScript para mostrar la alerta
     */
    static private function mostrar_alerta($mensaje, $tipo, $opciones = [])
    {
        $defaults = [
            'autoclose' => true,
            'timer' => 3000,
            'showConfirmButton' => false,
            'position' => 'top-end'
        ];

        $config = array_merge($defaults, $opciones);
        $json_config = json_encode($config);

        return "<script>
            Swal.fire({
                icon: '$tipo',
                title: '$mensaje',
                toast: true,
                position: '{$config['position']}',
                showConfirmButton: " . ($config['showConfirmButton'] ? 'true' : 'false') . ",
                timer: {$config['timer']},
                timerProgressBar: " . ($config['autoclose'] ? 'true' : 'false') . "
            });
        </script>";
    }

    /**
     * Muestra una alerta de éxito
     * 
     * @param string $mensaje Mensaje a mostrar
     * @param array $opciones Opciones adicionales
     * @return string Código HTML y JavaScript para mostrar la alerta
     */
    static public function exito($mensaje, $opciones = [])
    {
        return self::mostrar_alerta($mensaje, 'success', $opciones);
    }

    /**
     * Muestra una alerta de error
     * 
     * @param string $mensaje Mensaje a mostrar
     * @param array $opciones Opciones adicionales
     * @return string Código HTML y JavaScript para mostrar la alerta
     */
    static public function error($mensaje, $opciones = [])
    {
        $opciones_error = [
            'autoclose' => false,
            'showConfirmButton' => true
        ];
        return self::mostrar_alerta($mensaje, 'error', array_merge($opciones_error, $opciones));
    }
}
