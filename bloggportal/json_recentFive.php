<?php
/* DT093G Webbutveckling II - Projektuppgift bloggportal - Moa Hjemdahl 2019 */
// Convetion to JSON
include('includes/config.php');

//Webbservice available for all
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");

//Five most recent blogposts, convert to JSON
$blogpost = new Blogpost();

$posts = $blogpost->getRecentPosts();
$json = json_encode($posts, JSON_PRETTY_PRINT);

echo $json;