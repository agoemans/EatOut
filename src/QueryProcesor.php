<?php

namespace Shrubbery;

use Symfony\Component\HttpFoundation\Request;
use Silex\Provider\DoctrineServiceProvider;
use Shrubbery\Config;
use Shrubbery\app;

require_once(__DIR__ . '../../vendor/autoload.php');

class QueryProcesor
{
    public $silexApp;
    private $conf = null;

    public function __construct()
    {
        $this->dbOptions = new Config();
        $this->resultsList = array();
    }

    public function selectResults()
    {
        $mysqli = new \mysqli("localhost", $this->dbOptions->dbuser, $this->dbOptions->dbpass);

        $query = "SELECT * FROM EatOutDB.Address";
        if ($result = $mysqli->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $this->resultsList[]=[$row["streetname"]];
                var_dump("%s (%s)\n", $row["streetname"], $row["mobile"]);
            }
        }
        $mysqli->close();
        return $this->resultsList;

    }

    public function insertAddress($restuarant)
    {
        $mysqli = new \mysqli("localhost", $this->dbOptions->dbuser, $this->dbOptions->dbpass);

        $query = "Insert into EatOutDB.Address (placename, restaurantid, streetname) values('$restuarant->placename',$restuarant->placeid,'$restuarant->streetname')";

        var_dump($restuarant);

        if ($mysqli->query($query) === true) {
            echo "New record created successfully";
        } else {
            var_dump($mysqli->error);
        }

        $query = "Insert into EatOutDB.Address (telephone, mobile, postcode) values('$restuarant->telephone','$restuarant->mobile','$restuarant->zipcode') where restaurantid = $restuarant->placeid";

        $mysqli->close();
        return $this->resultsList;

    }
}