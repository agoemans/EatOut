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

    $dbOptions = new Config();
    $app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'dbname' => $dbOptions->dbname,
        'user' => $dbOptions->dbuser,
        'password' => $dbOptions->dbpass,
        'host' => $dbOptions->dbhost,
        'driver'   => $dbOptions->dbdriver
//'dbname' => 'EatOutDB',
//        'user' => 'amy',
//        'password' => 'fesT3r',
//        'host' => 'localhost',
//        'driver'   => 'pdo_mysql',

        ),
    ));

    $mysqli = new mysqli("localhost", $dbOptions->dbuser, $dbOptions->dbpass);

    $query = "SELECT * FROM EatOutDB.Address";
    $resultsList = null;
//
//    $sql = "SELECT * FROM Address";
//    $post = $app['db']->fetchAssoc($sql, array((int) $id));
    if ($result = $mysqli->query($query))
    {
        while ($row = $result->fetch_assoc()) {
//            var_dump("%s (%s)\n", $row["streetname"], $row["mobile"]);
        }
    }
    $resultsList = $result;


//    print_r($post);
//    return "<h1>{$post['title']}</h1>".
//    "<p>{$post['body']}</p>";
//    $result->free();
    $mysqli->close();

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

        $queryConnection = new QueryProcesor();
        $newquery = $queryConnection ->selectResults();

        $newFileAction = new Helper();

        $readFile = $newFileAction->readFromFile();


        return $app['twig']->render('index.twig', array(
            'name' => 'amy',
            'finalList' => $readFile,
            'post' => $newquery
        ));
    });




