<?php
/* DT093G Webbutveckling II - Projektuppgift bloggportal - Moa Hjemdahl 2019 */
// Log in page
include('includes/header.php');

// if session exists send to user_home.php
if(isset($_SESSION['username'])) {
    header("Location: user_home.php");
}

//Log in user with information from form
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User();
    if($user->loginUser($username, $password)) {
        header("Location: user_home.php");
    } else {
        $message = "<p class='mess'>Felaktigt användarnamn eller lösenord...</p>";
    }
}
?>
<!-- Log in form -->
<div class="login">
    <div class="siteHead">
        <h3>Logga in</h3>
    </div>
    <form method="post" action="login.php" class="form1">
        <label for="username">Användarnamn</label>
        <input type="text" name="username" id="username" class="input">
        <label for="password">Lösenord</label>
        <input type="password" name="password" id="password" class="input">
        <div>
            <input type="submit" value="Logga in" name="login" class="btn">
            <!-- Message output -->
            <?php if (isset($message)) { echo $message; } ?>
        </div>
    </form>
</div>

<?php
include('includes/footer.php');