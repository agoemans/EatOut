<?php
/**
 * Created by PhpStorm.
 * User: kwallen
 * Date: 19-9-15
 * Time: 17:28
 */
require '../vendor/autoload.php';
use GuzzleHttp\Client;

function getRestaurants(){
    $client = new GuzzleHttp\Client(['base_uri' => 'https://api.eet.nu/venues?query=vegetarian&geolocation=52.3837955,4.9130078']);
//    $response = $client->request('GET','base_uri');
    $response = $client->get('https://api.eet.nu/venues?query=vegetarian&geolocation=52.3837955,4.9130078');
    $code = $response->getBody();
    $restaurantArray = json_decode($code, true);
//    $firstResult = $restaurantArray['results'];
//        $response = $request->send();
//    $code = $response->getBody();
    return $restaurantArray['results'][0]['name'];

}
?>