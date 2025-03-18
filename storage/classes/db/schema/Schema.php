<?php

namespace Bimp\Framework\Database\Schema;

use Bimp\Framework\Database\Database;

class Schema extends Database{

    protected $pdo;

    private $sql        = null;
    private $table_name = null;
    private $column     = null;
    private $columns    = [];
    private $pk         = [];
    private $fk         = [];
    private $engine     = 'InnoDB'; // por defecto
    private $charset    = 'utf8';   // por defecto
    private $auto_inc   = 1;        // por defecto
    private $ph         = '`%s`';   // placeholder
    

}