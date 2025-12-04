// main.js
import { initTooltips } from "../../src/js/tooltips.js";
import { initForms } from "../../src/js/form-validation.js";
import { initAnimations } from "../../src/js/animations.js";
import { initNavigation } from "../../src/js/navigation.js";
import { KMeans } from "../../src/js/modules/kmeans.js";

// DOM Ready
document.addEventListener("DOMContentLoaded", function () {
  // Initialize semua modul
  initTooltips();
  initForms();
  initAnimations();
  initNavigation();

  // Module KMeans sudah diimport, siap digunakan
  // const kmeans = new KMeans();
  // kmeans.method();
});

// Re-export jika perlu
export { KMeans };
