<?php

namespace Shrubbery;

use Shrubbery\Restuarant;

class CreateRestaurant
{

    public function generateList($resultArray)
    {
        $restaurantList = array();

        for ($i=0; $i < count($resultArray); ++$i) {
            $restaurant = new Restuarant($resultArray[$i]);

            $restaurantList[] = $restaurant;
        }

        return $restaurantList;
    }

}
