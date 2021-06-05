<?php

// this file declare constants and config server

define("WEBSITE_NAME", "TAM'S ESHOP");
define("DB_NAME", "eshop_db");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_TYPE", "mysql");
define("DB_HOST", "localhost");



//If change template html, change 'eshop' -> new_template_html
define("THEME", "eshop/");

//When upload website to internet, change true -> false
define("DEBUG", true);

if (DEBUG) {
    ini_set('display_errors', 1);
}else {
    ini_set('display_errors', 0);
}

?>
