<?php 

use App\Core\App;

header('Access-Control-Allow-Origin: *');

require_once '../vendor/autoload.php';

$app = new App();
$app->run();