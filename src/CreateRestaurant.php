<?php

namespace Shrubbery;

require_once __DIR__ . '/../vendor/autoload.php';

use Shrubbery\DiningLocation;

class CreateRestaurant
{

    public function GenerateList($resultArray)
    {
        $restaurantList = array();

        for ($i=0; $i < count($resultArray); ++$i) {
            $restaurant = new DiningLocation($resultArray[$i]);

            $restaurantList[] = $restaurant;
        }

        return $restaurantList;
    }

}
?>