<?php

namespace Shrubbery;

require_once(__DIR__ . '../../vendor/autoload.php');

class Config
{
    public $dbhost;
    public $dbuser;
    public $dbpass;
    public $dbname;
    public $dbdriver;

    public function __construct()
    {
        $this->dbhost = 'localhost';
        $this->dbuser = 'amy';
        $this->dbpass = 'fesT3r';
        $this->dbname = 'RESTAURANT';
        $this->dbdriver = 'pdo_mysql';
    }
}