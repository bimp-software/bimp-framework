<?php

class Db {

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

    /**
     * Constructor para nuestra clase
     */
    public function __construct(){
        $this->engine = IS_LOCAL ? LDB_ENGINE : DB_ENGINE;
        $this->host = IS_LOCAL ? LDB_HOST : DB_HOST;
        $this->name = IS_LOCAL ? LDB_NAME : DB_NAME;
        $this->charset = IS_LOCAL ? LDB_CHARSET : DB_CHARSET;
        $this->dsn = sprintf('%s:host=%s;dbname=%s;charset=%s', $this->engine, $this->host, $this->name, $this->charset);

        $this->user = IS_LOCAL ? LDB_USER : DB_USER;
        $this->pass = IS_LOCAL ? LDB_PASS : DB_PASS;

        $this->options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        return $this;  
    }

    /**
     * Metodo para abrir una conexion a la base de datos
     * @return void
     */
    protected function connect(bool $throw_exception = false){
        try {
            /**
             * Se implementó singleton para optimizar la carga de la base de datos y sus conexiones
             */
            if(self::$instance === null){
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


    /**
     * Regresa la conexion a la base de datos
     * @return PDO
     */
    public function link(){
        return self::connect();
    }

    public static function table($table){
        return new Query($table); // Instancia la clase Query dentro de Db
    }


}