<?php
/* DT093G Webbutveckling II - Projektuppgift bloggportal - Moa Hjemdahl 2019 */
// Register page
include('includes/header.php');

// If register button is pressed and no fields are empty, crate new user
if(isset($_POST['register'])) {
    if(empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["first_name"]) || empty($_POST["last_name"]) ||empty($_POST["email"])) {
        $message = "<p class='mess'>Någonting gick fel, har du fyllt i alla uppgifter?</p>";
    } else {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];

        // If username is available and email correct, create new user
        $user = new User();
        if($user->availableUsername($username)) {
            $message = "<p class='mess'>Användarnamn upptaget...</p>";
        } else if(!$user->setEmail($email)) {
            $message = "<p class='mess'>Felaktig email...</p>";
        } else {
            if($user->registerUser($username, $password, $first_name, $last_name, $email)) {
            $message = "<p class='mess'>Du är nu medlem!</p>";
            }
        } 
    }    
}
?>
<!-- Register form -->
<div class="register">
    <div class="siteHead">
        <h3>Registrera dig</h3>
    </div>
    <form method="post" action="register.php" class="form1">
        <label for="username">Användarnamn</label>
        <input type="text" name="username" id="username" class="input">
        <label for="password">Lösenord</label>
        <input type="password" name="password" id="password" class="input">
        <label for="first_name">Förnamn</label>
        <input type="text" name="first_name" id="first_name" class="input">
        <label for="last_name">Efternamn</label>
        <input type="text" name="last_name" id="last_name" class="input">
        <label for="email">E-postadress</label>
        <input type="text" name="email" id="email" class="input">
        <div>
            <input type="submit" value="Bli medlem" name="register" class="btn">
            <!-- Message output -->
            <?php if (isset($message)) { echo $message; } ?>
        </div>
    </form>
</div>

<?php
include('includes/footer.php');