
(function () {
  const init = () => {
    const sidebarToggle = document.getElementById("sidebarToggle");
    const sidebar = document.getElementById("sidebar");

    if (sidebarToggle && sidebar) {
      sidebarToggle.addEventListener("click", function () {
        sidebar.classList.toggle("show");
      });
    }

    const sidebarLinks = document.querySelectorAll('#sidebar .nav-link[href]');
    const setActiveLink = (activeLink) => {
      sidebarLinks.forEach((link) => {
        if (link === activeLink) return;
        link.classList.remove("active", "bg-dark", "text-white");
        link.classList.add("text-dark");
      });

      if (activeLink) {
        activeLink.classList.add("active", "bg-dark", "text-white");
        activeLink.classList.remove("text-dark");
      }
    };

    const currentPage = window.location.pathname.split("/").pop();
    sidebarLinks.forEach((link) => {
      const href = link.getAttribute("href");
      if (!href || href === "#") return;
      if (href === currentPage || href.endsWith(currentPage)) {
        setActiveLink(link);
      }
    });

    sidebarLinks.forEach((link) => {
      link.addEventListener("click", () => {
        const href = link.getAttribute("href");
        if (!href || href === "#") return;
        setActiveLink(link);


        if (window.innerWidth <= 768 && sidebar) {
          sidebar.classList.remove("show");
        }
      });
    });
  };

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();

