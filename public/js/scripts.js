// Mobile menu functionality
function toggleMobileMenu() {
    const mobileMenu = document.getElementById("mobileMenu");
    const hamburger = document.querySelector(".hamburger");
    mobileMenu.classList.toggle("active");
    hamburger.classList.toggle("active");
    const isExpanded = hamburger.getAttribute("aria-expanded") === "true";
    hamburger.setAttribute("aria-expanded", !isExpanded);
    document.body.style.overflow = mobileMenu.classList.contains("active")
        ? "hidden"
        : "";
    if (mobileMenu.classList.contains("active")) {
        mobileMenu.querySelector("a").focus();
    }
}