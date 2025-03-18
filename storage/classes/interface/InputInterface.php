<?php

namespace Bimp\Framework\Interface;

/**
 * Interfaz para la calase que manejan entrada de usuarios en consola.
 * y sus propiedades y metodos obligatorios
 * @version 2.0.0
 */

interface InputInterface{
    public function text(string $message): string;
    public function ask(string $question): string;
    public function confirm(string $question): bool;
    public function choice(string $question, array $options): string;
}
