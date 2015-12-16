<?php
    require_once(__DIR__.'/../vendor/autoload.php');
	use Shrubbery\GetJSONList;
	use Shrubbery\CreateRestaurant;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
	use Shrubbery\fileActions;



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


		$newFileAction = new fileActions();

        $readFile = $newFileAction->read_from_file();

       // $bootstrapCSS = new PathPackage('/../vendor/twitter/bootstrap/dist', new StaticVersionStrategy('v1'));

        $bootstrappackage = $request->getBasePath().'/vendor/twitter/bootstrap/dist/css/bootstrap.css';


		return $app['twig']->render('index.twig', array(
			'name' => 'amy',
            'finalList' => $readFile,
            'bootstrapPath' => $bootstrappackage
		));
	});




