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
    private $restaurantArray;

    public function __construct($result)
    {
        $this->placeid = $result["id"];
        $this->placename = $result["name"];
        $this->streetname = $result["address"]["street"];
        $this->zipcode = $result["address"]["zipcode"];
        $this->category = $result["category"];
        $this->telephone = $result["telephone"];
        $this->mobile = $result["mobile"];

        $this->getRawJSONData();
        $this->updateRestaurantProperties($this->restaurantArray["results"]);


    }

    private function getRawJSONData()
    {
        $client = new Client(['base_uri' => 'https://api.eet.nu/venues?query=vegetarian&geolocation=52.3837955,4.9130078']);
        $response = $client->get('https://api.eet.nu/venues?query=vegetarian&geolocation=52.3837955,4.9130078');
        $rawCode = $response->getBody();

        $this->restaurantArray = json_decode($rawCode, true);
    }

    private function updateRestaurantProperties($result)
    {
        $this->placeid = $result["id"];
        $this->placename = $result["name"];
        $this->streetname = $result["address"]["street"];
        $this->zipcode = $result["address"]["zipcode"];
        $this->category = $result["category"];
        $this->telephone = $result["telephone"];
        $this->mobile = $result["mobile"];
    }

    private function writeToDatabase()
    {
        $this->restaurantArray();
    }
}
