<?php
    require_once(__DIR__.'/../app/app.php');
    
    $filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
        if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}
    $app->run();

?>