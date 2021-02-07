/* DT093G Webbutveckling II - Projektuppgift bloggportal - Moa Hjemdahl 2019 */
"use strict";

//Variable
var userList = document.getElementById("userList");
var recentList = document.getElementById("recentList");

//Eventhandeler
window.addEventListener("load", loadUsers, false);
window.addEventListener("load", loadRecent, false);

// Call AJAX, get JSON
function loadUsers() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var list = JSON.parse(this.response);

            displayUserList(list);
        }
    };
    xhttp.open('GET', 'json_bloggers.php', true);
    xhttp.send();
}
// Print all users
function displayUserList(list) {

    for (var i = 0; i < list.length; i++) {
        userList.innerHTML += "<li><a href='blogg.php?id=" + list[i].user_id + "'>" + list[i].username + "</a></li>";
    }
}

// Call AJAX, get JSON
function loadRecent() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var list = JSON.parse(this.response);

            displayRecentList(list);
        }
    };
    xhttp.open('GET', 'json_recentFive.php', true);
    xhttp.send();
}
// Print five most recent blogposts
function displayRecentList(list) {

    for (var i = 0; i < list.length; i++) {
        recentList.innerHTML += "<div class='post'><h4>" + list[i].header + "</h4>" + list[i].content + "<p class='writer'> Av " + list[i].writer + "</p><h5>" + list[i].post_date + "</h5></div>";
    }
}