<?php

namespace Bimp\Framework\Console;

use Bimp\Framework\Console\Command\CommandRegistry;
use Bimp\Framework\Console\Input\ConsoleInput;

use Bimp\Framework\Make\MakeModel;
use Bimp\Framework\Make\MakeController;

/**
 * Clase que hace la gestion de comandos para el framework
 * @package Bimp\Framework\Console
 * @author Bimp Software
 */
class Kernel extends ConsoleInput{

    /**
     * registro de comandos disponibles
     * @var cmd
     */
    protected CommandRegistry $cmd;

    public function __construct(){
        $this->cmd = new CommandRegistry();
        $this->cmd->register(new MakeModel());
        $this->cmd->register(new MakeController());
    }

    private function menu(){
        ConsoleInput::loading("Iniciando Bimp-Framework...", 2);
    
        while (true) {
            echo "\n";
            $options = array_keys($this->cmd->all());
            $options[] = "❌ Salir";
    
            // Encabezado del menú
            echo "\033[36m" . str_repeat("═", 40) . "\033[0m\n";
            echo "\033[1;33m BIMP FRAMEWORK - MENÚ PRINCIPAL\033[0m\n";
            echo "\033[36m" . str_repeat("═", 40) . "\033[0m\n";
    
            // Mostrar opciones con numeración
            foreach ($options as $index => $option) {
                echo "\033[32m[$index]\033[0m → \033[1;37m$option\033[0m\n";
            }
            echo "\033[36m" . str_repeat("═", 40) . "\033[0m\n";
    
            // Pedir entrada del usuario
            $choice = $this->ask("Seleccione una opción (número):");
    
            // Validar entrada
            if (!isset($options[$choice])) {
                echo "\033[31m Opción inválida. Intente nuevamente.\033[0m\n";
                continue;
            }
    
            $commandName = $options[$choice];
    
            // Manejar la opción de salir
            if ($commandName === "Salir") {
                ConsoleInput::loading("Saliendo del sistema...", 2);
                echo "\033[32m\n Hasta luego!\n\033[0m";
                exit;
            }
    
            // Ejecutar comando
            ConsoleInput::loading("Ejecutando comando: $commandName", 1);
            $this->handle($commandName);
        }
    }
    

    public function handle(string $commandName)
    {
        $command = $this->cmd->get($commandName);

        if ($command) {
            $command->handle([]);
        } else {
            ConsoleInput::ask("❌ Comando no encontrado: $commandName\n");
        }
    }

    public function run()
    {
        $this->menu();
    }

}