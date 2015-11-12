<?php

namespace Shrubbery;

use Shrubbery\Restaurant;

class CreateRestaurant
{

    public function generateList($resultArray)
    {
        $restaurantList = array();

        for ($i=0; $i < count($resultArray); ++$i) {
            $restaurant = new Restaurant($resultArray[$i]);

            $restaurantList[] = $restaurant;
        }

        return $restaurantList;
    }

}
