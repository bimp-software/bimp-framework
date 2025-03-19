<?php

namespace Bimp\Framework\Services;

use Bimp\Framework\Interface\PaymentInterface;

abstract class PaymentServices implements PaymentInterface{

    protected string $name;
    protected string $dependency;

    function __construct(string $name, string $dependency){
        $this->name = $name;
        $this->dependency = $dependency;
    }

    public function Name(): string {
        return $this->name;
    }

    public function Dependencia(): string {
        return $this->dependency;
    }

    abstract public function Process(array $config): void;

    abstract public function Render(string $url): string;
}