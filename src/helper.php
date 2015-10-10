<?php

namespace Shrubbery;

require_once __DIR__ . '/../vendor/autoload.php';

use Shrubbery\CreateRestaurant;

use GuzzleHttp\Client;

function getRestaurants()
{
    $client = new Client(['base_uri' => 'https://api.eet.nu/venues?query=vegetarian&geolocation=52.3837955,4.9130078']);
    $response = $client->get('https://api.eet.nu/venues?query=vegetarian&geolocation=52.3837955,4.9130078');
    $code = $response->getBody();
    $restaurantArray = json_decode($code, true);


    $restaurant = new CreateRestaurant();
    $editedRestaurantList = $restaurant->GenerateList($restaurantArray['results']);


    return $editedRestaurantList;

}
?>