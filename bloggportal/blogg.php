<?php
/* DT093G Webbutveckling II - Projektuppgift bloggportal - Moa Hjemdahl 2019 */
// Clicked users, from startpage, blog
include('includes/header.php');
?>

<div class="bkgBlock">
<?php
// if id is set, else back to start page
if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("loacation: index.php");
}

// Bloggname
$user = new User();

$username = $user->getUser($id);
echo "<h2>" . $username['username'] . "s blogg</h2>";

// Get all blogposts written by clicked on blogger
$blogpost = new Blogpost();

if($blogpost->getBloggersPosts($id)) {
    $posts = $blogpost->getBloggersPosts($id);
    foreach($posts as $p) {
        echo "<div class='post'><h4>" . $p['header'] . "</h4>" . $p['content'] . "<h5>" . $p['post_date']. "</h5></div>";
    }
} else {
    $message = "<p class='mess post'>Här finns inga inlägg än...</p>";
}
?>
<!-- Message output -->
<?php if (isset($message)) { echo $message; } ?>

</div>

<?php
include('includes/footer.php');