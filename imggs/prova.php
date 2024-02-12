<?php
require_once 'autoload.php' ; // change the path according to your file location
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
use NewsdataIO\NewsdataApi ;
$newsdataApiObj = new NewsdataApi ( "pub_23718137f651325cb0827421903100e1c9063" ); // replace with your API key
$data = array ("q" => "pizza"); // you can add more parameters here
$response = $newsdataApiObj -> get_latest_news ( $data ); // this will return a JSON object
print_r($response); // you can process the JSON object as you wish
?>