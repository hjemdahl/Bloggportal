<?php
/* DT093G Webbutveckling II - Projektuppgift bloggportal - Moa Hjemdahl 2019 */
// Logged in users write new blogpost page
include('includes/header.php');

// If publish is pressed and no fields are empty, new blogpost is created
if(isset($_POST['publish'])) {
    if(empty($_POST["header"]) || empty($_POST["editor"])) {
        $message = "<p class='mess'>Du måste fylla i alla fält...</p>";
    } else {
        $header = $_POST['header'];
        $content = $_POST['editor'];
        $writer = $_SESSION['username'];

        $blogpost = new Blogpost();
        if($blogpost->newBlogpost($header, $content, $writer)) {
            header("location: user_home.php");
        } else {
            $message = "<p class='mess'>Inlägget kunde inte publiceras...</p>";
        }
    }
}
?>
<!-- User menu -->
<nav class="userMenu">
    <ul>
        <li><a href="user_home.php">Min blogg</a></li>
        <li><a href="user_write.php">Skriv nytt</a></li>
        <li><a href="logout.php">Logga ut</a></li>
    </ul>
</nav>
<!-- New blogpost form -->
<div class="bkgBlock">
    <div class="siteHead">
        <h3>Skriv nytt blogginlägg</h3>
    </div>
    <form action="user_write.php" method="post" class="newPost">
        <label for="header">Rubrik</label>
        <input type="text" name="header" id="header" class="input">
        <textarea name="editor" class="editor"></textarea>
        <div>
            <input type="submit" value="Publicera" name="publish" class="btn">
            <input type="submit" value="Börja om" name="restart" class="btn btn2">
            <?php if (isset($message)) { echo $message; } ?>
        </div>
    </form>
</div>

<!-- CK Editor replaces the textarea -->
<script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor');
</script>
<?php
include('includes/footer.php');