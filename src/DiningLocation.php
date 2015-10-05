<?php

namespace EatOut\src;
/**
 * Created by PhpStorm.
 * User: kwallen
 * Date: 20-9-15
 * Time: 11:30
 */


    class DiningLocation{
        public $placeid;
        public $placename;
        public $address;
        public $zipcode;
        public $streetname;
        public $geolocation;

        public function __construct($result)
        {

                $this->placeid = $result["id"];
                $this->placename = $result["name"];
                $this->streetname = $result["address"]["street"];
                $this->zipcode = $result["address"]["zipcode"];
        }
    }


?>