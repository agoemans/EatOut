<?php
    require_once(__DIR__.'/../vendor/autoload.php');

	$app = new Silex\Application();

	//Section for adding configuration
	$app->get('/', function(Silex\Application $app){
	    $output = '';
	    $output = "This will show you a list of vegetarians restaurants in Amsterdam";

	    return $output;
	});

	$app->run();

?>