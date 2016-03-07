<?php

namespace Shrubbery;

class Restaurant
{
    public $placeid;
    public $placename;
    public $zipcode;
    public $streetname;
    public $geolocation;
    public $category;
    public $telephone;
    public $mobile;

    public function __construct($result)
    {
            $this->placeid = $result["id"];
            $this->placename = $result["name"];
            $this->streetname = $result["address"]["street"];
            $this->zipcode = $result["address"]["zipcode"];
            $this->category = $result["category"];
            $this->telephone = $result["telephone"];
            $this->mobile = $result["mobile"];
    }
}
