const initSidebarUI = () => {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    if (!sidebar) return;

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });
    }

    // Highlight active sidebar menu on click (and on initial page load).
    const sidebarLinks = document.querySelectorAll('#sidebar .nav-link[href]');
    const setActiveLink = (activeLink) => {
        sidebarLinks.forEach((link) => {
            if (link === activeLink) return;
            link.classList.remove('active', 'bg-dark', 'text-white');
            link.classList.add('text-dark');
        });

        if (activeLink) {
            activeLink.classList.add('active', 'bg-dark', 'text-white');
            activeLink.classList.remove('text-dark');
        }
    };

    // Initial highlight based on the current URL.
    const currentPage = window.location.pathname.split('/').pop();
    sidebarLinks.forEach((link) => {
        const href = link.getAttribute('href');
        if (!href || href === '#') return;
        if (href === currentPage || href.endsWith(currentPage)) {
            setActiveLink(link);
        }
    });

    // Update highlight when clicking sidebar items.
    sidebarLinks.forEach((link) => {
        link.addEventListener('click', () => {
            const href = link.getAttribute('href');
            if (!href || href === '#') return;
            setActiveLink(link);
        });
    });
};

// Run immediately if DOM is already ready.
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSidebarUI);
} else {
    initSidebarUI();
}