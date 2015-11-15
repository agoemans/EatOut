<?php

namespace Shrubbery;

use Shrubbery\Restaurant;
use Shrubbery\GetJSONList;

class CreateRestaurant
{

    public function generateList($resultArray)
    {
        $restaurantList = array();

       // echo "out of the loop";
       // var_dump($resultArray["results"]);
        //print_r(array_values($resultArray));

        for ($i=0; $i < count($resultArray["results"]); ++$i) {
            $restaurant = new Restaurant($resultArray["results"][$i]);
            //echo "IN the loop";
           // var_dump($resultArray["results"][$i]);


            $restaurantList[] = $restaurant;
            //var_dump($restaurantList);
        }

        return $restaurantList;
    }

    public function receivedData($data)
    {

        $finalData = array();
        $finalData = $this->generateList($data);
        //$finalData = $data;
        //var_dump($finalData);
        return $finalData;
    }

}
