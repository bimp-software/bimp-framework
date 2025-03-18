<?php

namespace Bimp\Framework\Database;

class Database {

    private static $instance = null; // Instancia para singleton
    private $link  = null;
    private $dsn;
    private $engine;
    private $host;
    private $name;
    private $charset;
    private $user;
    private $pass;
    private $options;

    function __construct() {
        $this->engine  = getenv('DB_CONNECTION') ?: 'mysql'; // Valor por defecto: mysql
        $this->host    = getenv('DB_HOST') ?: 'localhost';
        $this->name    = getenv('DB_DATABASE') ?: 'database';
        $this->charset = getenv('DB_CHARSET') ?: 'utf8mb4';
        $this->user    = getenv('DB_USERNAME') ?: 'root';
        $this->pass    = getenv('DB_PASSWORD') ?: '';

        $this->dsn = sprintf('%s:host=%s;dbname=%s;charset=%s', 
            $this->engine, $this->host, $this->name, $this->charset
        );

        $this->options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false
        ];

        return $this;  
    }

    /**
     * Metodo para abrir una conexion a la base de datos
     * @return void
     */
    protected function connect(bool $throw_exception = false) {
        try {

            if (self::$instance === null) {
                self::$instance = new self();
            }

            $self = self::$instance;
      
            if ($self->link !== null) return $self->link;
            $self->link = new PDO($self->dsn, $self->user, $self->pass, $self->options);
            return $self->link;

        } catch (PDOException $e) {
            if ($throw_exception === true) {
                throw new Exception($e->getMessage());
            }
        }
    }

    public function link() {
        return self::connect();
    }

}
