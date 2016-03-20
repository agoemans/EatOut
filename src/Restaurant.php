<?php

namespace Shrubbery;

use GuzzleHttp\Client;

class Restaurant
{
    public $placeid;
    public $placename;
    public $zipcode;
    public $streetname;
    public $geolocation;
    public $category;
    public $telephone;
    public $mobile;
    public $numberofRestaurants;

    private function __construct()
    {


//        $restaurantArray = $this->getRawJSONData();
//        $this->updateRestaurantProperties($restaurantArray["results"]);
//        $numberofRestaurants = count($restaurantArray["results"]);

    }


    public static function fromApiData($result)
    {
        $restaurant = new Restaurant();

        $restaurant->placeid = $result["id"];
        $restaurant->placename = $result["name"];
        $restaurant->streetname = $result["address"]["street"];
        $restaurant->zipcode = $result["address"]["zipcode"];
        $restaurant->category = $result["category"];
        $restaurant->telephone = $result["telephone"];
        $restaurant->mobile = $result["mobile"];

        return $restaurant;
    }

    public static function fromDatabaseData($result)
    {

//        print_r($result[0]["restaurantid"]);
        $restaurant = new Restaurant();

        $restaurant->placeid = $result[0]["restaurantid"];
        $restaurant->placename = $result["placename"];
        $restaurant->streetname = $result["streetname"];
        $restaurant->zipcode = $result["postcode"];
        $restaurant->telephone = $result["telephone"];
        $restaurant->mobile = $result["mobile"];

        return $restaurant;
    }


}
