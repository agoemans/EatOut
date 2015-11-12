<?php
    require_once(__DIR__.'/../vendor/autoload.php');
	use Shrubbery\GetJSONList;

	$app = new Silex\Application();

	//Section for adding configuration

	$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => __DIR__.'/views',
		));


	$app->get('/', function() use ($app){
	    $output = '';
		$RestaurantList = '';
		$twig->render('@admin/index.html', array());
	    $output = "This will show you a list of vegetarians restaurants in Amsterdam";

		$TempList = new GetJSONList();
		$RestaurantList = $TempList->helper();
		//var_dump($TempList);



	    return $RestaurantList;
		//return $output;
	});




