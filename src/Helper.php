<?php

namespace Shrubbery;

use Shrubbery\GetJSONList;
use Shrubbery\RestaurantList;
use GuzzleHttp\Client;

require_once(__DIR__.'/../vendor/autoload.php');


class Helper
{
    private $filename = "test.JSON";

    private function writeToFile()
    {

        $finalList = '';

        //$TempRestaurant = new RestaurantList();

        $finalList = RestaurantList::generateList($this->getJSONFile());

        $handle = fopen($this->filename, "w+");

        fwrite($handle, json_encode($finalList));
        fclose($handle);

    }

    public function readFromFile()
    {
        if (!file_exists($this->filename)) {
            $this->writeToFile();
        }
        $handle = fopen($this->filename, "r");
        $contents = json_decode(fread($handle, filesize($this->filename)));
        fclose($handle);

        return $contents;
    }


    private function getJSONFile()
    {
        $client = new Client(['base_uri' => 'https://api.eet.nu/venues?query=vegetarian&geolocation=52.3837955,4.9130078']);
        $response = $client->get('https://api.eet.nu/venues?query=vegetarian&geolocation=52.3837955,4.9130078');
        $code = $response->getBody();

        $restaurantArray = json_decode($code, true);

        return $restaurantArray;


    }

}