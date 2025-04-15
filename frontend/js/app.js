document.addEventListener("DOMContentLoaded", function () {
  const menuToggle = document.getElementById("mobile-menu");
  const menuLinks = document.querySelector(".navbar__menu");

  menuToggle.addEventListener("click", function () {
    menuToggle.classList.toggle("active");
    menuLinks.classList.toggle("active");
  });
});
