import { initNavbar } from "../../src/js/components/navbar.js";
import { initHeaderBehavior } from "../../src/js/components/header.js";
import { initMobileMenu } from "../../src/js/components/mobileMenu.js";
import { initSidebar } from "../../src/js/components/sideBar.js";

document.addEventListener("DOMContentLoaded", () => {
  initNavbar();
  initHeaderBehavior();
  initMobileMenu();
  initSidebar();
});
