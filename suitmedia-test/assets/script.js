let lastScroll = 0;
const navbar = document.getElementById("navbar");

window.addEventListener("scroll", function () {
  const currentScroll = window.pageYOffset;

  if (currentScroll <= 0) {
    // Di paling atas, tampilkan navbar solid
    navbar.classList.remove("navbar-hidden");
    navbar.classList.add("navbar-visible");
    navbar.style.backgroundColor = "#f97316"; // bg-orange-500
    return;
  }

  if (
    currentScroll > lastScroll &&
    !navbar.classList.contains("navbar-hidden")
  ) {
    // Scroll ke bawah - sembunyikan navbar
    navbar.classList.remove("navbar-visible");
    navbar.classList.add("navbar-hidden");
  } else if (
    currentScroll < lastScroll &&
    navbar.classList.contains("navbar-hidden")
  ) {
    // Scroll ke atas - tampilkan navbar transparan
    navbar.classList.remove("navbar-hidden");
    navbar.classList.add("navbar-visible");
    navbar.style.backgroundColor = "rgba(249, 115, 22, 0.95)";
  }

  lastScroll = currentScroll;
});

// Highlight menu aktif berdasarkan URL
document.addEventListener("DOMContentLoaded", function () {
  const currentPage = "<?php echo $current_page; ?>";
  const navLinks = document.querySelectorAll("nav a");

  navLinks.forEach((link) => {
    if (link.getAttribute("href").includes(currentPage)) {
      link.classList.add("border-b-2", "font-semibold");
    }
  });
});

window.addEventListener("scroll", function () {
  const scrollY = window.scrollY;
  document.getElementById("banner-image").style.transform = `translateY(${
    scrollY * 0.3
  }px)`;
  document.getElementById("banner-text").style.transform = `translateY(${
    scrollY * 0.1
  }px)`;
});
