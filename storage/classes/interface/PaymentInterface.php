<?php

namespace Bimp\Framework\Interface;

/**
 * 
 * @version 2.0.0
 */

interface PaymentInterface {
    public function Name(): string;
    public function Dependencia(): string;
    public function Process(array $config): void;
    public function Render(string $url): string;
}
