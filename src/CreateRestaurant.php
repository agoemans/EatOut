<?php

require '../vendor/autoload.php';

use EatOut\src\DiningLocation;

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