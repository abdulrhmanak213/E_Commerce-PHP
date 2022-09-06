<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-type, Access-Control-Allow-Methods, X-Requested-With');
$requestMethod = $_SERVER["REQUEST_METHOD"];
require('../Controllers/UserController.php');
require('../Config.php');
$env = new DataBaseEnv();
$conn = $env->OpenCon();
$api = new UserController($conn);
switch($requestMethod) {
    case 'POST':
        $api->checkToken($conn);
        break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
$env->CloseCon($conn);