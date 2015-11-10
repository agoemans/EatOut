<?php
    require_once(__DIR__.'/../vendor/autoload.php');
	use Shrubbery\GetJSONList;

	$app = new Silex\Application();

	//Section for adding configuration

	$app->get('/', function() use ($app){
	    $output = '';
	    $output = "This will show you a list of vegetarians restaurants in Amsterdam";

		$TempList = new GetJSONList();
		//$RestaurantList = $TempList->helper();
		var_dump($TempList);



	    //return $TempList->Helper();
		return $output;
	});



