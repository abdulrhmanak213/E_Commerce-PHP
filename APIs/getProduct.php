<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-type, Access-Control-Allow-Methods, X-Requested-With');
$requestMethod = $_SERVER["REQUEST_METHOD"];
require('../Controllers/ProductController.php');
require('../Config.php');
require('../middleware/Auth.php');
$env = new DataBaseEnv();
$conn = $env->OpenCon();
$api = new ProductController($conn);
$auth = new Auth();
switch ($requestMethod) {
    case 'POST':
    {
        if ($auth->handle()) {
            $api->get($conn);
            break;
        } else {
            header("HTTP/1.0 401 Unauthorized");
            break;
        }
    }
    default:
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}
$env->CloseCon($conn);
