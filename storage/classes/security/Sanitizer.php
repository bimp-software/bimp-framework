<?php

namespace Bimp\Framework\Security;

use Bimp\Framework\Interface\SanitizerInterface;

class Sanitizer implements SanitizerInterface{

    public static function String(string $input) : string{
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    public static function Email(string $input): string{
        $email = filter_var($input, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("El correo electrónico proporcionado no es válido.");
        }
        return $email;
    }

    public static function Url(string $url): string{
        $input = filter_var($url, FILTER_SANITIZE_URL);
        if (!filter_var($input, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException("La URL proporcionada no es válida.");
        }
        return $input;
    }

    public static function Int(int|string $input): int{
        if (!is_numeric($input)) {
            throw new InvalidArgumentException("El valor proporcionado no es un número entero válido.");
        }
        return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
    }

    public static function Float(float|string $input): float{
        if (!is_numeric($input)) {
            throw new InvalidArgumentException("El valor proporcionado no es un número flotante válido.");
        }
        return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }

    public static function Array(array $input): array{
        return array_map(function ($item) {
            return is_array($item) ? Array($item) : String($item);
        }, $input);
    }

    public static function sanitize(mixed $data, string $type): mixed{
        return match ($type) {
            'email'  => Email($data),
            'url'    => Url($data),
            'int'    => Int($data),
            'float'  => Float($data),
            'array'  => Array($data),
            'string' => String($data),
            default  => String($data),
        };
    }

}