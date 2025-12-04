// tooltips.js
// Tooltip initialization
function initTooltips() {
  const tooltips = document.querySelectorAll("[data-tooltip]");
  tooltips.forEach((element) => {
    element.addEventListener("mouseenter", showTooltip);
    element.addEventListener("mouseleave", hideTooltip);
  });
}

// Tooltip handlers
function showTooltip(event) {
  // Implementasi show tooltip
  console.log("Show tooltip for:", event.target);
}

function hideTooltip(event) {
  // Implementasi hide tooltip
  console.log("Hide tooltip for:", event.target);
}

export { initTooltips };
