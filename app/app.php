<?php
    require_once(__DIR__.'/../vendor/autoload.php');
	use Shrubbery\GetJSONList;
	use Shrubbery\CreateRestaurant;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;



	$app = new Silex\Application();
	$app['debug'] = true;
    $app['asset_path'] = 'views';

	//Section for adding configuration

	$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => __DIR__.'/../views',
		));

    $twig = $app['twig'];
    $twig->addExtension(new \Entea\Twig\Extension\AssetExtension($app));

	$app->get('/', function(Request $request) use ($app){
	    $output = '';
		$finalList = '';

	    $output = "This will show you a list of vegetarians restaurants in Amsterdam";

		$TempList = new GetJSONList();
		$TempRestaurant = new CreateRestaurant();

		$finalList = $TempRestaurant->receivedData($TempList->helper());
		//print_r(array_values($finalList));
		//var_dump($finalList[0]);
/*		for ($i=0; $i < count($finalList); ++$i) {
			//echo "first loop";
			echo '</br>';
			echo "Place name:  ";
			echo $finalList[$i]->placename;
			echo '</br>';
			echo "Street name:  ";
			echo $finalList[$i]->streetname;
			echo '</br>';
			echo "Zip Code:  ";
			echo $finalList[$i]->zipcode;
			echo '</br>';
			echo '</br>';*/
			//echo 'before for loop';

		//}

       // $bootstrapCSS = new PathPackage('/../vendor/twitter/bootstrap/dist', new StaticVersionStrategy('v1'));

        $bootstrappackage = $request->getBasePath().'/vendor/twitter/bootstrap/dist/css/bootstrap.css';


		return $app['twig']->render('index.twig', array(
			'name' => 'amy',
            'finalList' => $finalList,
            'bootstrapPath' => $bootstrappackage
		));
	});




