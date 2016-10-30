<?php

namespace Shrubbery;

use GuzzleHttp\Client;

class Restaurant
{
    public $placeid;
    public $placename;
    public $zipcode;
    public $streetname;
    public $geoLat;
    public $geoLng;
    public $category;
    public $telephone;
    public $mobile;
    public $numberofRestaurants;
    public $rating;
    public $website;
    public $facebook;
    public $twitter;

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
        $restaurant->geoLat = $result["geolocation"]["latitude"];
        $restaurant->geoLng = $result["geolocation"]["longitude"];
        $restaurant->rating = $result["rating"];
        $restaurant->facebook = $result["facebook_url"];
        $restaurant->website = $result["website_url"];
        $restaurant->twitter = $result["twitter"];

        return $restaurant;
    }

    public static function fromDatabaseData($result)
    {

//        print_r($result[0]["restaurantid"]);
        $restaurant = new Restaurant();
        $restaurant->placeid = $result["restaurantid"];
        $restaurant->placename = $result["placename"];
        $restaurant->streetname = $result["streetname"];
        $restaurant->zipcode = $result["postcode"];
        $restaurant->telephone = $result["telephone"];
        $restaurant->mobile = $result["mobile"];
        $restaurant->geoLat = $result["lat"];
        $restaurant->geoLng = $result["lng"];
        $restaurant->rating = $result["rating"];        
        $restaurant->facebook = $result["facebook"];
        $restaurant->website = $result["website"];
        $restaurant->twitter = $result["twitter"];

        return $restaurant;
    }


}
