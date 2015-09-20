<?php
/**
 * Created by PhpStorm.
 * User: kwallen
 * Date: 19-9-15
 * Time: 17:28
 */
require '../vendor/autoload.php';
use GuzzleHttp\Client;

    function getClientInfo(){
        $client = new GuzzleHttp\Client(['base_uri' => 'http://httpbin.org']);
        $response = $client->request('GET','get');
//        $response = $request->send();
        $code = $response->getBody();
        return $code;

    }
?>