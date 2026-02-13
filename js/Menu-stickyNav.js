window.onscroll = function(){
    stickyNav()
};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function stickyNav() {
    if (window.pageYOffset != sticky) {
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
    
    if (window.pageYOffset == sticky) {
        navbar.classList.remove("sticky");
    } else {
        navbar.classList.add("sticky")
    }
}