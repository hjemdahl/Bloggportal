<?php
/* DT093G Webbutveckling II - Projektuppgift bloggportal - Moa Hjemdahl 2019 */
// Start page
include('includes/header.php');
?>
<!-- All registered bloggers list -->
<div class="bkgBlock" id="top-left">
    <h3>Våra bloggare</h3>
    <ul class="list" id="userList">

    </ul>
</div>
<!-- 5 most recent blogposts -->
<div class="bkgBlock" id="bottom-right">
    <h3>5 färskaste blogginläggen</h3>
    <div class="postList" id="recentList">

    </div>
</div>

<script src="js/main.js"></script>
<?php
include('includes/footer.php');