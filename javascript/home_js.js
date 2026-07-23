/* ============================================================
   Acadex marketing site — nav + interactions
   Vanilla JS, no dependencies. Loaded on every public page.
   ============================================================ */

(function () {
    'use strict';

    /* ---------- mobile drawer ---------- */
    var toggle = document.getElementById('navToggle');
    var drawer = document.getElementById('sidebar');

    function openDrawer() {
        if (!drawer) return;
        drawer.hidden = false;
        // allow the browser to paint the un-hidden element before animating
        requestAnimationFrame(function () {
            drawer.classList.add('open');
        });
        if (toggle) toggle.setAttribute('aria-expanded', 'true');
        document.body.style.overflow = 'hidden';
    }

    function closeDrawer() {
        if (!drawer) return;
        drawer.classList.remove('open');
        if (toggle) toggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
        setTimeout(function () { drawer.hidden = true; }, 280);
    }

    if (toggle) {
        toggle.addEventListener('click', function () {
            if (drawer && drawer.classList.contains('open')) {
                closeDrawer();
            } else {
                openDrawer();
            }
        });
    }

    if (drawer) {
        drawer.querySelectorAll('[data-close-drawer]').forEach(function (el) {
            el.addEventListener('click', closeDrawer);
        });
        // close when a real navigation link inside the drawer is tapped
        drawer.querySelectorAll('.drawer-nav a:not(.nav-soon)').forEach(function (a) {
            a.addEventListener('click', closeDrawer);
        });
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && drawer && drawer.classList.contains('open')) {
            closeDrawer();
        }
    });

    /* ---------- coming-soon toast (mirrors dashboard nav-soon pattern) ---------- */
    var notice = document.getElementById('soon_notice');
    var noticeTimer;

    function showSoon(message) {
        if (!notice) return;
        notice.textContent = message || 'This section is coming soon.';
        notice.classList.add('on');
        clearTimeout(noticeTimer);
        noticeTimer = setTimeout(function () {
            notice.classList.remove('on');
        }, 4200);
    }

    document.addEventListener('click', function (e) {
        var link = e.target.closest ? e.target.closest('.nav-soon') : null;
        if (!link) return;
        e.preventDefault();
        showSoon(link.getAttribute('data-soon'));
        if (drawer && drawer.classList.contains('open')) closeDrawer();
    });

    /* ---------- header shadow on scroll ---------- */
    var header = document.getElementById('site-header');
    if (header) {
        var onScroll = function () {
            if (window.scrollY > 8) {
                header.style.boxShadow = '0 6px 24px rgba(28,17,64,0.08)';
            } else {
                header.style.boxShadow = 'none';
            }
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    /* ---------- reveal on scroll ---------- */
    var revealables = document.querySelectorAll('[data-reveal]');
    if ('IntersectionObserver' in window && revealables.length) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        revealables.forEach(function (el) { io.observe(el); });
    } else {
        revealables.forEach(function (el) { el.classList.add('is-visible'); });
    }

    /* ---------- FAQ accordion ---------- */
    document.querySelectorAll('.faq-item .faq-q').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var item = btn.closest('.faq-item');
            var open = item.classList.contains('open');
            item.classList.toggle('open', !open);
            btn.setAttribute('aria-expanded', String(!open));
        });
    });

})();
