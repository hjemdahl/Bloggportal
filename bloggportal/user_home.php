<?php
/* DT093G Webbutveckling II - Projektuppgift bloggportal - Moa Hjemdahl 2019 */
// Logged in users home page
include('includes/header.php');

// If session is not set, send back to login page
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
}
?>
<!-- User menu -->
<nav class="userMenu">
    <ul>
        <li class="loggedin">Hej <?= $_SESSION['username'] ?></li>
        <li><a href="user_home.php">Min blogg</a></li>
        <li><a href="user_write.php">Skriv nytt</a></li>
        <li><a href="logout.php">Logga ut</a></li>
    </ul>
</nav>
<!-- Logged in users blogposts -->
<div class="bkgBlock">
    <h3>Dina blogginlägg</h3>
    <div class="postList">
        <?php
        $post = new Blogpost();

        // If delete button is pressed, delete
        if(isset($_GET['deleteid'])) {
            $id = $_GET['deleteid'];

            $post->deleteBlogpost($id);
        }

        // Get logged in users blogposts
        $writer = $_SESSION['username'];

        if($post->getWritersPosts($writer)) {
            $posts = $post->getWritersPosts($writer);
            foreach($posts as $p) {
                echo "<div class='post'><a class='btnUser btn2' href='user_home.php?deleteid=" . $p['post_id'] . "'>Ta bort</a><a class='btnUser' href='user_update.php?id=" . $p['post_id'] . "'>Uppdatera</a><h4>" . $p['header'] . "</h4>" . $p['content'] . "<h5>" . $p['post_date'] . "</h5></div>";
            }
        } else {
            $message = "<p class='mess post'>Du har inte skrivit något inlägg än...</p>";
        }

        ?>
    </div>
</div>

<?php
include('includes/footer.php');