<?php
namespace App\Core;

use App\Core\Env;

class MySql {
    public $pdo = null;

    private $db_host = '';
    private $db_user = '';
    private $db_pass = '';
    private $db_name = '';
    private $dsn = '';

    function __construct() {
        $this->db_host = Env::get('MYSQL_HOST');
        $this->db_user = Env::get('MYSQL_USER');
        $this->db_pass = Env::get('MYSQL_PASSWORD');
        $this->db_name = Env::get('MYSQL_DB_NAME');
        $this->dsn = "mysql:host=$this->db_host;dbname=$this->db_name;charset=utf8mb4";
    }

    public function open() {
        $this->pdo = new \PDO($this->dsn, $this->db_user, $this->db_pass);
    }

    public function close() {
        $this->pdo = null;
    }
}
