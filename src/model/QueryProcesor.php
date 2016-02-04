<?php

namespace Shrubbery;

use Symfony\Component\HttpFoundation\Request;
use Silex\Provider\DoctrineServiceProvider;
use Shrubbery\Settings;

require_once(__DIR__.'../../vendor/autoload.php');

class QueryProcessor
{
    public $silexApp;
    private $conf = null;

    public function __construct($app)
    {
        $this->silexApp = $app;
        $this->conf = new Settings();
    }

    public function registerConn()
    {
        $this->silexApp->register(new Silex\Provider\DoctrineServiceProvider(), array(
            'db.options' => array(
                'dbname' => $this->conf->dbname,
                'user' => $this->conf->dbuser,
                'password' => $this->conf->dbpass,
                'host' => $this->conf->dbhost,
                'driver'   => $this->conf->dbdriver,

            ),
        ));

    }
}