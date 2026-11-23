// ALLTAGSHELDEN – Seiten-Interaktionen
(function () {
    // Header-Schatten beim Scrollen
    var header = document.querySelector('.site-header');
    function onScroll() {
        if (header) header.classList.toggle('scrolled', window.scrollY > 8);
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    // Mobile Navigation
    var toggle = document.querySelector('.nav-toggle');
    if (toggle && header) {
        toggle.addEventListener('click', function () {
            var open = header.classList.toggle('nav-open');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
        header.querySelectorAll('.main-nav a').forEach(function (link) {
            link.addEventListener('click', function () {
                header.classList.remove('nav-open');
                toggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    // Einblend-Animation beim Scrollen
    var items = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    io.unobserve(entry.target);
                }
            });
        }, { rootMargin: '0px 0px -8% 0px' });
        items.forEach(function (el) { io.observe(el); });
    } else {
        items.forEach(function (el) { el.classList.add('visible'); });
    }

    // Pflegegrad-Flyer (Dialog)
    var dialog = document.getElementById('flyerDialog');
    if (dialog && typeof dialog.showModal === 'function') {
        document.querySelectorAll('[data-open-flyer]').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                dialog.showModal();
                document.body.classList.add('dialog-open');
            });
        });
        dialog.addEventListener('close', function () {
            document.body.classList.remove('dialog-open');
        });
        // Klick auf den Hintergrund schließt den Dialog
        dialog.addEventListener('click', function (e) {
            if (e.target === dialog) dialog.close();
        });
        var closeBtn = dialog.querySelector('[data-close]');
        if (closeBtn) closeBtn.addEventListener('click', function () { dialog.close(); });
    }

    // Jahr im Footer
    document.querySelectorAll('[data-year]').forEach(function (el) {
        el.textContent = new Date().getFullYear();
    });
})();
