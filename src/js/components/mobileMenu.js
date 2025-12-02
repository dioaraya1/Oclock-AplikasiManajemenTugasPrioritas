export function initMobileMenu() {
  const menuBtn = document.getElementById("menuBtn");
  const mobileMenu = document.getElementById("mobileMenu");

  if (menuBtn && mobileMenu) {
    menuBtn.onclick = () => {
      mobileMenu.classList.toggle("hidden");
      mobileMenu.classList.toggle("flex");
    };
  }
}
