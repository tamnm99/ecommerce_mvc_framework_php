<?php

// This file will show every thing of website

session_start();

// [REQUEST_SCHEME] => http
// [SERVER_NAME] => localhost
// [PHP_SELF] => /ecommerce_mvc/public/index.php
// $path = http://localhost/ecommerce_mvc/public/index.php path of this project
$path = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];

//delete index.php in project path
$path = str_replace("index.php", "", $path);

define('ROOT', $path);

//ASSETS =  http://localhost/ecommerce_mvc/public/assets, file assets contains .css, .js, image....
define('ASSETS', $path . "assets/");

include('../app/init.php');

$app = new App();

?>