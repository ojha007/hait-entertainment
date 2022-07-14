function toggleNavMenu() {
  if (window.innerWidth <= 768)
    document.getElementById("nav-menu-items").classList.add("d-none");
  else
    document.getElementById("nav-menu-items").classList.remove("d-none");
}

window.addEventListener("load", toggleNavMenu);

window.addEventListener("resize", function() {
  const navMenuItemsClassList = document.getElementById("nav-menu-items").classList;
  if (window.innerWidth >= 768) {
    if (navMenuItemsClassList.contains("animate-nav-menu-close")) navMenuItemsClassList.remove("animate-nav-menu-close");
    document.getElementById("nav-menu-items").classList.remove("d-none");
  } else document.getElementById("nav-menu-items").classList.add("d-none");
});

// When the user scrolls the page
window.addEventListener("scroll", function() {
  // Get the navbar
  let navbar = document.getElementById("navbar");

// Get the offset position of the navbar
  let sticky = navbar.offsetTop;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
  if (window.scrollY > sticky) {
    navbar.classList.add("sticky");
  } else {
    navbar.classList.remove("sticky");
  }
});
