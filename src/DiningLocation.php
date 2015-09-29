<?php
/**
 * Created by PhpStorm.
 * User: kwallen
 * Date: 20-9-15
 * Time: 11:30
 */


    class DiningLocation{
        public $placeid;
        public $placename;
        public $address;
        public $zipcode;
        public $streetname;
        public $geolocation;

        public function __construct($result)
        {

                $this->placeid = $result["id"];
                $this->placename = $result["name"];
                $this->streetname = $result["address"]["street"];
                $this->zipcode = $result["address"]["zipcode"];
        }
    }

    function createRestaurant($resultArray)
    {
        $restaurantList = array();

        for ($i=0; $i < count($resultArray); ++$i) {
            $restaurant = new DiningLocation($resultArray[$i]);

            $restaurantList[] = $restaurant;
        }

        return $restaurantList;
    }
?>