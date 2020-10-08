<?php
/**
 * Template Name: Emiter
 */
include('vendor/autoload.php');
require_once("../../../../wp-load.php");
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;

$version = new Version2X('http://localhost:3000/');
$client = new Client($version);
if (isset($_REQUEST['action'])) {
    switch ($_REQUEST['action']) {
        case "get_data":
            $data = ['message' => $_REQUEST['message']];
            $client->initialize();
            $client->emit('new_order', $data);
            $client->close();
    }
}




	


?>