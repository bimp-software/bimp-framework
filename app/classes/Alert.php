<?php

class Alert{

    private static $alertType = ['success','error','warning','info'];

    public static function create($title, $message, $type = 'info'){
        if (!array_key_exists($type, self::$alertTypes)) {
            $type = 'info';
        }

        $_SESSION['alert'] = [
            'title' => $title,
            'message' => $message,
            'type' => $type
        ];
    }
}