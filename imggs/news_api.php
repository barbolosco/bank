<?php
require_once 'autoload.php';
require_once 'config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use NewsdataIO\NewsdataApi;

$newsdataApiObj = new NewsdataApi("23718137f651325cb0827421903100e1c9063");

$data = array(
                "q" => "ronaldo",
                "country" => "ie"
            );

$response = $newsdataApiObj->get_latest_news($data);

var_dump($response);