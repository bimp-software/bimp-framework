<?php

namespace Bimp\Framework\Console\Command;

use Bimp\Framework\Console\Command\Command;

/**
 * Clase que hace de comandos para el kernel
 * @package Bimp\Framework\Console
 * @author Bimp Software
 */
class CommandRegistry {

    /**
     * Lista de comandos disponibles
     * @var array<string, Command>
     */
    protected array $commands = [];

    public function register(Command $param){
        $this->commands[$param->getSignature()] = $param;
    }

    public function all() : array {
        return $this->commands;
    }

    public function get(string $args) : ?Command {
        return $this->commands[$args] ?? null;
    }


}   