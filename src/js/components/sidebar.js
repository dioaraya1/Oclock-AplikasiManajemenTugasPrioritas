export function initSidebar() {
  const toggleSidebar = document.getElementById("toggleSidebar");
  const sidebar = document.getElementById("sidebar");

  if (toggleSidebar && sidebar) {
    toggleSidebar.onclick = () => {
      sidebar.classList.toggle("-translate-x-full");
    };
  }
}
