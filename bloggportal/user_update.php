<?php
/* DT093G Webbutveckling II - Projektuppgift bloggportal - Moa Hjemdahl 2019 */
// Logges in users update blogpost page
include('includes/header.php');

// If id is not set send back to user_home.php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("loacation: user_home.php");
}

// Get values från blogpost
$blogpost = new Blogpost();

$update = $blogpost->getWritersPost($id);
$header = $update['header'];
$content = $update['content'];

// If publish is pressed and fiels not empty, new values are assignded
if(isset($_POST['publish'])) {
    if(empty($_POST["header"]) || empty($_POST["editor"])) {
        $message = "<p class='mess'>Du måste fylla i alla fält...</p>";
    } else {
        $header = $_POST['header'];
        $content = $_POST['editor'];

        // New values are sent to the database
        if($blogpost->editBlogpost($header, $content, $id)) {
            $message = "<p class='mess'>Inlägget uppdatet!</p>";
        } else {
            $message = "<p class='mess'>Inlägget kunde inte uppdateras...</p>";
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
<!-- Update blogpost form -->
<div class="bkgBlock">
    <div class="siteHead">
        <h3>Uppdatera blogginlägg</h3>
    </div>
    <form method="post" class="newPost">
        <label for="header">Rubrik</label>
        <input type="text" name="header" id="header" class="input" value="<?= $header; ?>">
        <textarea name="editor" class="editor"><?= $content; ?></textarea>
        <div>
            <input type="submit" value="Uppdatera" name="publish" class="btn">
            <?php if (isset($message)) { echo $message; } ?>
        </div>
    </form>
</div>

<!-- CK Editor replaces the textarea -->
<script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor' );
</script>
<?php
include('includes/footer.php');