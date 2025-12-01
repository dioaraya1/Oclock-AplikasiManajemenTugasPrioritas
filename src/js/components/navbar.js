export function initNavbar() {
  const menuBtn = document.querySelector("[data-menu-btn]");
  const mobileNav = document.querySelector("[data-mobile-nav]");
  const overlay = document.querySelector("[data-overlay]");

  if (!menuBtn || !mobileNav) return;

  const openNav = () => {
    mobileNav.classList.remove("hidden");
    overlay.classList.remove("hidden");
    document.body.classList.add("overflow-hidden");
  };

  const closeNav = () => {
    mobileNav.classList.add("hidden");
    overlay.classList.add("hidden");
    document.body.classList.remove("overflow-hidden");
  };

  menuBtn.addEventListener("click", () => {
    if (mobileNav.classList.contains("hidden")) {
      openNav();
    } else {
      closeNav();
    }
  });

  overlay.addEventListener("click", closeNav);

  // Close when pressing ESC key
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") closeNav();
  });
}
