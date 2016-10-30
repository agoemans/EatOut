<?php
    require_once(__DIR__.'/../vendor/autoload.php');
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Shrubbery\Helper;
    use Assetic\AssetWriter;
    use Assetic\Asset\AssetCollection;
    use Assetic\Asset\FileAsset;
    use Assetic\Asset\GlobAsset;
    use Assetic\AssetManager;
    use Assetic\Asset\AssetCache;
    use Assetic\Cache\FilesystemCache;
    use Shrubbery\QueryProcesor;
    use Shrubbery\RestaurantProcessor;
    use Shrubbery\Config;

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

    $getRestaurantList = new RestaurantProcessor();
    $jsonObj = $getRestaurantList->readFromDatabase();


    //Section for adding configuration

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../templates',
        ));

    $twig = $app['twig'];
    $twig->addExtension(new \Entea\Twig\Extension\AssetExtension($app));

    $app->get('/', function (Request $request) use ($app) {
        $output = '';
        $finalList = '';
        $apiKey = '';

        $ini_Obj = parse_ini_file("data.ini", true);
        $apiKey = $ini_Obj["apiKey"];


        $restaurantProcessor = new RestaurantProcessor();
        //$restaurantProcessor->generateList();
      //  $restaurantProcessor->updateSocialTables();


        return $app['twig']->render('index.twig', array(
            'name' => 'Restaurants In Amsterdam',
            'finalList' => $restaurantProcessor->readFromDatabase(),
            'apiKey' => $apiKey

        ));
    });

    $app->get('/api', function (Request $request) use ($jsonObj) {
        $output = '';
        $finalList = '';

        for ($i=0; $i < 7; ++$i) {
            $output[] = $jsonObj[$i];
        }

        return json_encode($output);
    });




