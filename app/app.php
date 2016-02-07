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
    use Shrubbery\QueryProcessor;
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

    //to register the connections
 //   $queryConnection = new QueryProcessor($app);

    $conf = new Config();
    $app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'dbname' => $conf->dbname,
        'user' => $conf->dbuser,
        'password' => $conf->dbpass,
        'host' => $conf->dbhost,
        'driver'   => $conf->dbdriver,

        ),
    ));

    //check connection
    if ($app->connect_error) {
        die("Connection failed: " . $app->connect_error);
    }

    //Section for adding configuration

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../templates',
        ));

    $twig = $app['twig'];
    $twig->addExtension(new \Entea\Twig\Extension\AssetExtension($app));

    $app->get('/', function (Request $request) use ($app)
    {
        $output = '';
        $finalList = '';


        $newFileAction = new Helper();

        $readFile = $newFileAction->readFromFile();


        return $app['twig']->render('index.twig', array(
            'name' => 'amy',
            'finalList' => $readFile,

        ));
    });




