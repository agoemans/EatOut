<?php
    require_once(__DIR__.'/../vendor/autoload.php');
	use Shrubbery\GetJSONList;
	use Shrubbery\CreateRestaurant;

	$app = new Silex\Application();
	$app['debug'] = true;

	//Section for adding configuration

	$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => __DIR__.'/../views',
		));


	$app->get('/', function() use ($app){
	    $output = '';
		$finalList = '';

	    $output = "This will show you a list of vegetarians restaurants in Amsterdam";

		$TempList = new GetJSONList();
		$TempRestaurant = new CreateRestaurant();

		$finalList = $TempRestaurant->receivedData($TempList->helper());
		//print_r(array_values($finalList));
		//var_dump($finalList[0]);
		for ($i=0; $i < count($finalList); ++$i) {
			//echo "first loop";
			foreach ($finalList[$i] as $key => $values) {
				//echo "in second loop";
				//print_r((array_values($finalList)));
				//var_dump($finalList[$i]);
				//var_dump($values);
				echo '</br>';
				echo $key;
				echo '</br>';
				echo $values;
				echo '</br>';
				//echo $values->placename;

				//echo $values->streetname;

				//echo $values->zipcode;

			}
		}


		return $app['twig']->render('index.html', array(
			'name' => 'amy',
		));
	});




