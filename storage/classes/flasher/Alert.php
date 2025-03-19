<?php

namespace Bimp\Framework\Flasher;

class Alert {

    private static array $valid_types = ['success','error','warning','info','question'];

    public static function new(string $msg, string $type = 'info', ?string $title, int $time = 3000, bool $show = false){

        $type = in_array($type, self::$valid_types) ? $type : 'info';

        $_SESSION['alert'][] = [
            'type' => $type,
            'title' => $title ?? ucfirst($type),
            'message' => $msg,
            'timer' => $time,
            'shoConfirmButton' => $show,
        ];
    }

    /**
     * Crea una alerta de éxito rápidamente
     */
    public static function success(string $message, ?string $title = "¡Éxito!", int $timer = 3000){
        self::new($message, 'success', $title, $timer);
    }

    /**
     * Crea una alerta de error rápidamente
     */
    public static function error(string $message, ?string $title = "¡Error!", int $timer = 0){
        self::new($message, 'error', $title, $timer, true);
    }

    /**
     * Crea una alerta de advertencia rápidamente
     */
    public static function warning(string $message, ?string $title = "¡Advertencia!", int $timer = 5000){
        self::new($message, 'warning', $title, $timer, true);
    }

    /**
     * Crea una alerta de información rápidamente
     */
    public static function info(string $message, ?string $title = "¡Información!", int $timer = 4000){
        self::new($message, 'info', $title, $timer);
    }

    /**
     * Renderiza las alertas en JavaScript
     *
     * @return string Código JS para mostrar las alertas
     */
    public static function flash(): string {
        if (!session_id()) session_start();

        if (empty($_SESSION['alert'])) return '';

        $script = '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script><script>';

        foreach ($_SESSION['alert'] as $alert) {
            $script .= "
                Swal.fire({
                    icon: '{$alert['type']}',
                    title: '" . addslashes($alert['title']) . "',
                    text: '" . addslashes($alert['message']) . "',
                    timer: {$alert['timer']},
                    showConfirmButton: " . ($alert['showConfirmButton'] ? 'true' : 'false') . "
                });";
        }

        $script .= '</script>';

        unset($_SESSION['alert']); // Limpiar mensajes de sesión
        return $script;
    }
}