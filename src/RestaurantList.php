<?php

namespace Shrubbery;

use Shrubbery\Restaurant;
use Shrubbery\GetJSONList;
use Shrubbery\QueryProcesor;

class RestaurantList
{

    public static function generateList($resultArray)
    {
        $restaurantList = array();
        $queryConnection = new QueryProcesor();

       // echo "out of the loop";
       // var_dump($resultArray["results"]);
        //print_r(array_values($resultArray));

        for ($i=0; $i < count($resultArray["results"]); ++$i) {
            $restaurant = new Restaurant($resultArray["results"][$i]);
            $queryConnection->updateRestaurantTables($restaurant);

            $restaurantList[] = $restaurant;
            //var_dump($restaurantList);
        }

        return $restaurantList;
    }

}
