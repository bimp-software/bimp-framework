<?php

namespace Bimp\Framework\Console\Command;

/**
 * Clase que hace de comandos para el kernel
 * @package Bimp\Framework\Console
 * @author Bimp Software
 */
class Command {

    /**
     * El nombre y la firma del comando de consola.
     * @var string
     */
    protected string $signature;

    /**
     * El nombre del comando de consola.
     * @var string
     */
    protected string $name;

    /**
     * La descripcion del comando de consola.
     * @var string|null
     */
    protected string $description;

    /**
     * El texto de ayuda del comando de consola.
     * @var string
     */
    protected ?string $help;

    /**
     * Constructor de la clase Command
     * @param string $signature Firma del comando.
     * @param string $name Nombre del comando.
     * @param string|null $description Descripcion del comando.
     * @param string|null $help Texto de ayuda del comando.
     */
    public function __construct(string $signature, string $name, ?string $description = null, ?string $help = null){
        $this->signature = $signature;
        $this->name = $name;
        $this->description = $description;
        $this->help = $help;
    }    

    public function getSignature() : string {
        return $this->signature;
    }

    public function getName() : string {
        return $this->name;
    }
    
    public function getDescription() : ?string {
        return $this->description;
    }

    public function getHelp() : ?string {
        return $this->help;
    }
    
    public function handle(array $args){
        echo "Ejecutando el comando: $this->name \n";
    }

}   