<?php
/* DT093G Webbutveckling II - Projektuppgift bloggportal - Moa Hjemdahl 2019 */
// Log out

//Log out, end session
session_start();
session_destroy();
unset($_SESSION['username']);
header("Location: index.php");