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
//                var_dump("%s (%s)\n", $row["streetname"], $row["mobile"]);
            }
        }
        $mysqli->close();
        return $this->resultsList;

    }

    public function updateRestaurantTables($restaurant)
    {
        $this->insertAddress($restaurant);
        $this->insertPhoneInfo($restaurant);
    }

    public function insertAddress($restaurant)
    {
        $mysqli = new \mysqli("localhost", $this->dbOptions->dbuser, $this->dbOptions->dbpass);

        $query = "Insert into EatOutDB.Address (placename, restaurantid, streetname) values('$restaurant->placename',$restaurant->placeid,'$restaurant->streetname')";


        if ($mysqli->query($query) === true) {
            echo "New record created successfully";
        } else {
            var_dump($mysqli->error);
        }

        $mysqli->close();


    }

    public function insertPhoneInfo($restaurant)
    {
        $mysqli = new \mysqli("localhost", $this->dbOptions->dbuser, $this->dbOptions->dbpass);

        $query = "Update EatOutDB.Address set telephone='$restaurant->telephone', mobile='$restaurant->mobile', postcode='$restaurant->zipcode' where restaurantid = $restaurant->placeid";


        if ($mysqli->query($query) === true) {
            echo "Record created successfully";
        } else {
            var_dump($mysqli->error);
        }

        $mysqli->close();

    }

    public function insertCategoryInfo()
    {
        $newArray = array();
        $catCode = null;

        $mysqli = new \mysqli("localhost", $this->dbOptions->dbuser, $this->dbOptions->dbpass);

        $query = "SELECT * FROM EatOutDB.basicCategory where categoryname = 'Dutch'";
//        $query = "SELECT * FROM EatOutDB.Address";



        if ($result = $mysqli->query($query)) {

                while ($row = $result->fetch_assoc()) {
//                     $newArray[] = [$row["streetname"]];
                    $catCode = $row["categorycode"];
                    $query = "Insert into EatOutDB.restaurantCategory (idbasicCategory, idrestaurant) values($catCode, 2312)";
                     printf("%s (%s)\n", $row["categorycode"], $row["categoryname"]);
                }

        } else {
             var_dump($mysqli->error);
        }

        $result->free();

        $mysqli->close();
        return $newArray;

    }
}