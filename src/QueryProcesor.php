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
//        $this->dbOptions = new Config();
//        $this->resultsList = array();

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

        $query = "SELECT * FROM EatOutDB.Address";

        $resultsList = null;

        if ($result = $mysqli->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $resultsList[]= $row;
//                print_r($row["restaurantid"]);
////                var_dump("%s (%s)\n", $row["streetname"], $row["mobile"]);
            }

//            $resultsList = $result->fetch_assoc();
//            print_r($resultsList);
        }
//        print_r(count($resultsList));
        $mysqli->close();
        return $resultsList;

    }

    public function updateRestaurantTables($restaurant)
    {
        $this->insertAddress($restaurant);
        $this->insertPhoneInfo($restaurant);
        $this->insertCategoryInfo($restaurant);
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

    public function insertCategoryInfo($restaurant)
    {
        $newArray = array();
        $catCode = null;
        $row_cnt = null;
        $restaurantID = $restaurant->placeid;
        $basicCategoryID = null;

        $mysqli = new \mysqli($this->dbhost, $this->dbuser, $this->dbpass);

        $query = "SELECT * FROM EatOutDB.basicCategory where categoryname = '$restaurant->category'";

//        $query  = "Insert into EatOutDB.basicCategory (categoryname) where VALUE ($categoryname)";


        if ($result = $mysqli->query($query)) {
            $row_cnt = $result->num_rows;
            print_r($result);
            if ($row_cnt == 0) {
                $result->free_result();
                $query  = "Insert into EatOutDB.basicCategory (categoryname) VALUE ('$restaurant->category')";
                $mysqli->query($query);
                print_r(" emptyness");

            } else{
                $row = $result->fetch_row();
                print_r ("exists");
                print_r($row[0]);
                $basicCategoryID = $row[0];

                $result->free_result();
                $query  = "Insert into EatOutDB.restaurantCategory (idrestaurantCategory, idbasicCategory) VALUE ($restaurant->placeid,$basicCategoryID)";
                $mysqli->query($query);
//                $insert_query= "Select * from EatOutDB.basicCategory where categoryname = $categoryname";
//                $row = $result->fetch_row();
//                print_r($row["categorycode"]);

            }


        } else {
             var_dump($mysqli->error);
        }

//        $result->free();

        $mysqli->close();
        return $newArray;

    }
}