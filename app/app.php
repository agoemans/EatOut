<?php
    require_once(__DIR__.'/../vendor/autoload.php');
	use Shrubbery\GetJSONList;
	use Shrubbery\CreateRestaurant;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
	use Shrubbery\fileActions;
    use Assetic\AssetWriter;
    use Assetic\Asset\AssetCollection;
    use Assetic\Asset\FileAsset;
    use Assetic\Asset\GlobAsset;
    use Assetic\AssetManager;
    use Assetic\Asset\AssetCache;
    use Assetic\Cache\FilesystemCache;




	$app = new Silex\Application();
	$app['debug'] = true;
    $app['asset_path'] = 'views';


    //todo move this to a separate function
    $bundles = array(
        new Symfony\Bundle\AsseticBundle\AsseticBundle(),
    );


    $styles = new FileAsset('./vendor/twitter/bootstrap/dist/css/bootstrap.css');


    $cache = new AssetCache(
        $styles,
        new FilesystemCache('./views/cache')
    );
    $cache->setTargetPath('bootstrap.css');

    $writer = new AssetWriter('./views/assets');
    $writer->writeAsset($cache);


    //end todo

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


		return $app['twig']->render('index.twig', array(
			'name' => 'amy',
            'finalList' => $readFile,

		));
	});




