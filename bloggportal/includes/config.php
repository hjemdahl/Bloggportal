<?php
// DT093G Webbutveckling II - Projektuppgift bloggportal - Moa Hjemdahl 2019

//Start session
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

//Load classfiles automatic
spl_autoload_register(function ($class) {
    include 'class/' . $class . '.class.php';
});

//Database configurations
define("DBHOST", "studentmysql.miun.se");
define("DBUSER", "mohj1800");
define("DBPASSWORD", "0mn2d4p7");
define("DBDATABASE", "mohj1800");

// define("DBHOST", "localhost");
// define("DBUSER", "bloggbibblan");
// define("DBPASSWORD", "dt093g");
// define("DBDATABASE", "bloggbibblan");

// Enable error reporting
error_reporting(-1); // Report all type of errors
ini_set("display_errors", 1); // Display all errors