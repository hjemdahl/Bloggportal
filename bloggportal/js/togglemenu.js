/* DT093G Webbutveckling II - Projektuppgift bloggportal - Moa Hjemdahl 2019 */
"use strict";

// Variable
var toggleNavStatus = false;
var getMenu = document.querySelector(".menuDropdown");

// Function for toggle menu
function toggleNav() {
    if (toggleNavStatus === false) {
        getMenu.style.visibility = "visible";
        getMenu.style.width = "110px";
        getMenu.style.padding = "10px 15px 0 15px";

        toggleNavStatus = true;
    } else {
        getMenu.style.visibility = "hidden";
        getMenu.style.width = "0";
        getMenu.style.padding = "10px 0 0 0";

        toggleNavStatus = false;
    }
}


