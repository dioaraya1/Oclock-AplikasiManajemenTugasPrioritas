export function initHeaderBehavior() {
  let lastScroll = 0;

  const publicHeader = document.getElementById("publicHeader");
  const dashboardNav = document.getElementById("dashboardNav");

  window.addEventListener("scroll", () => {
    const currentScroll = window.pageYOffset;

    if (publicHeader) {
      if (currentScroll > lastScroll && currentScroll > 50) {
        publicHeader.style.transform = "translateY(-100%)";
      } else {
        publicHeader.style.transform = "translateY(0)";
      }
    }

    if (dashboardNav) {
      if (currentScroll > lastScroll && currentScroll > 50) {
        dashboardNav.style.transform = "translateY(-100%)";
      } else {
        dashboardNav.style.transform = "translateY(0)";
      }
    }

    lastScroll = currentScroll;
  });
}
