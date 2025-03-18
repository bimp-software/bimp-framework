<?php

namespace Bimp\Framework\Interface;

interface SanitizerInterface{
    public static function String(string $input): string;
    public static function Email(string $input): string;
    public static function Url(string $url): string;
    public static function Int(int|string $input): int;
    public static function Float(float|string $input): float;
    public static function Array(array $input): array;
    public static function sanitize(mixed $data, string $type): mixed;
}