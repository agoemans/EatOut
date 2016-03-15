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

    public $dbhost;
    public $dbuser;
    public $dbpass;
    public $dbname;
    public $dbdriver;

    private static $link = null ;
    private $ini_array;

    public function __construct()
    {
        $this->dbOptions = new Config();
        $this->resultsList = array();

        $this->ini_array = parse_ini_file("config.ini", true);
        $this->dbuser = $this->ini_array["db_user"];
        $this->dbpass = $this->ini_array["db_password"];
        $this->dbdriver = $this->ini_array["db_driver"];
        $this->dbhost = $this->ini_array["dsn"]["host"];
//        print_r($this->ini_array["db_user"]);
    }

    public function selectResults()
    {
        $mysqli = new \mysqli($this->dbhost, $this->dbuser, $this->dbpass);

        $query = Database::prepare("SELECT * FROM EatOutDB.Address");
        $query->execute();
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
        $mysqli = new \mysqli($this->dbhost, $this->dbuser, $this->dbpass);

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
        $mysqli = new \mysqli($this->dbhost, $this->dbuser, $this->dbpass);

        $query = "Update EatOutDB.Address set telephone='$restaurant->telephone', mobile='$restaurant->mobile', postcode='$restaurant->zipcode' where restaurantid = $restaurant->placeid";


        if ($mysqli->query($query) === true) {
            echo "Record created successfully";
        } else {
            var_dump($mysqli->error);
        }

        $mysqli->close();

    }

    public function insertCategoryInfo($categoryname)
    {
        $newArray = array();
        $catCode = null;
        $row_cnt = null;

        $mysqli = new \mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);

        $query = "SELECT * FROM EatOutDB.basicCategory where categoryname = $categoryname ";


        if ($result = $mysqli->query($query)) {
            $row_cnt = $result->num_rows;
            print_r($row_cnt);
            if ($row_cnt == 0) {
                $result->free();
                $query = "Insert into EatOutDB.basicCategory (categoryname) values($categoryname)";
                print_r(" empty");
            }

//                while ($row = $result->fetch_assoc()) {
//
//                    $catCode = $row["categorycode"];
////                    $query = "Insert into EatOutDB.restaurantCategory (idbasicCategory, idrestaurant) values($catCode, 2312)";
//                     printf("%s (%s)\n", $row["categorycode"], $row["categoryname"]);
//                }

        } else {
             var_dump($mysqli->error);
        }

//        $result->free();

        $mysqli->close();
        return $newArray;

    }
}