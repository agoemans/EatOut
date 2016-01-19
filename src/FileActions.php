<?php

namespace Shrubbery;

use Shrubbery\GetJSONList;
use Shrubbery\CreateRestaurant;

require_once(__DIR__.'/../vendor/autoload.php');


class FileActions
{
    private $filename = "test.JSON";

    private function writeToFile()
    {

        $finalList = '';

        $TempList = new GetJSONList();
        $TempRestaurant = new CreateRestaurant();

        $finalList = $TempRestaurant->receivedData($TempList->helper());

        $handle = fopen($this->filename, "w+");

        fwrite($handle, json_encode($finalList));
        fclose($handle);

    }

    public function readFromFile()
    {
        if (file_exists($this->filename)) {
            $handle = fopen($this->filename, "r");
            $contents = json_decode(fread($handle, filesize($this->filename)));
            fclose($handle);
        }
        else {
            $this->writeToFile();
        }

        return $contents;
    }


}