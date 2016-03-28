<?php

namespace Shrubbery;

use Shrubbery\Restaurant;
use Shrubbery\GetJSONList;
use Shrubbery\QueryProcesor;
use GuzzleHttp\Client;

class RestaurantProcessor
{

    private function getRawJSONData()
    {
        $url = 'https://api.eet.nu/venues?query=vegetarian&geolocation=52.3837955,4.9130078';
        $client = new Client(['base_uri' => $url]);
        $response = $client->get($url);
        $rawCode = $response->getBody();

        return json_decode($rawCode, true);
    }

    public function generateList()
    {
        $rawData = $this->getRawJSONData();
        $restaurantList = array();
        $queryConnection = new QueryProcesor();

        for ($i=0; $i < count($rawData["results"]); ++$i) {
            $restaurant = Restaurant::fromApiData($rawData["results"][$i]);
//            print_r($rawData);
            $queryConnection->updateRestaurantTables($restaurant);

            $restaurantList[] = $restaurant;
            //var_dump($restaurantList);
        }

        return $restaurantList;
    }

    public function readFromDatabase()
    {
        $queryConnection = new QueryProcesor();
        $results = $queryConnection->selectResults();
        $restaurantList = array();

//        return $queryConnection->selectResults();
//making this 5 for testing todo -- change for google maps limitation
//        for ($i=0; $i < count($results); ++$i) {
        for ($i=0; $i < 5; ++$i) {
                $restaurant = Restaurant::fromDatabaseData($results[$i]);

                $restaurantList[] = $restaurant;
                //var_dump($restaurantList);
        }


        return $restaurantList;
    }

}
