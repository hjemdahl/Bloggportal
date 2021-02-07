<?php
/* DT093G Webbutveckling II - Projektuppgift bloggportal - Moa Hjemdahl 2019 */
// Convetion to JSON
include('includes/config.php');

//Webbservice available for all
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");

//All users, convert to JSON
$user = new User();

$rows = $user->getUsers();
$json = json_encode($rows, JSON_PRETTY_PRINT);

echo $json;