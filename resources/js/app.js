/**
 * Copy-to-clipboard buttons.
 *
 * A button opts in with `data-copy`. The text comes from `data-copy-value`
 * when present, otherwise from the `<pre>` inside the nearest code block.
 */
const COPY_FEEDBACK_MS = 1800;

document.addEventListener('click', async (event) => {
    const button = event.target.closest('[data-copy]');

    if (! button) {
        return;
    }

    const target = button.dataset.copyTarget
        ? document.querySelector(button.dataset.copyTarget)
        : button.closest('[data-code-block]')?.querySelector('pre');

    const value = button.dataset.copyValue ?? target?.innerText ?? '';

    try {
        await navigator.clipboard.writeText(value.trim());
    } catch {
        return;
    }

    const idle = button.querySelector('[data-copy-idle]');
    const done = button.querySelector('[data-copy-done]');

    idle?.classList.add('hidden');
    done?.classList.remove('hidden');
    button.setAttribute('data-copied', '');

    clearTimeout(button._copyTimer);

    button._copyTimer = setTimeout(() => {
        idle?.classList.remove('hidden');
        done?.classList.add('hidden');
        button.removeAttribute('data-copied');
    }, COPY_FEEDBACK_MS);
});

/**
 * Documentation sidebar drawer.
 *
 * The toggle owns `aria-expanded`; the panel is hidden from assistive tech and
 * from pointer events while closed, and focus is returned to the toggle on close.
 */
function setupDrawer() {
    const toggle = document.querySelector('[data-drawer-toggle]');
    const panel = document.getElementById('docs-drawer');

    if (! toggle || ! panel) {
        return;
    }

    const close = () => {
        if (toggle.getAttribute('aria-expanded') !== 'true') {
            return;
        }

        toggle.setAttribute('aria-expanded', 'false');
        panel.setAttribute('inert', '');
        panel.classList.add('pointer-events-none', 'opacity-0');
        panel.querySelector('[data-drawer-panel]')?.classList.add('-translate-x-full');
        document.body.classList.remove('overflow-hidden');
        toggle.focus();
    };

    const open = () => {
        toggle.setAttribute('aria-expanded', 'true');
        panel.removeAttribute('inert');
        panel.classList.remove('pointer-events-none', 'opacity-0');
        panel.querySelector('[data-drawer-panel]')?.classList.remove('-translate-x-full');
        document.body.classList.add('overflow-hidden');
        panel.querySelector('a, button')?.focus();
    };

    toggle.addEventListener('click', () => {
        toggle.getAttribute('aria-expanded') === 'true' ? close() : open();
    });

    panel.addEventListener('click', (event) => {
        if (event.target.closest('[data-drawer-dismiss]') || event.target.closest('a')) {
            close();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            close();
        }
    });

    // A resize past the drawer breakpoint leaves the panel inert but visible.
    window.matchMedia('(min-width: 1024px)').addEventListener('change', (event) => {
        if (event.matches) {
            close();
        }
    });
}

/**
 * "On this page" scroll spy.
 *
 * Marks the last heading scrolled past as current, so the highlight tracks the
 * section you are reading rather than the one entering the viewport.
 */
function setupScrollSpy() {
    const links = Array.from(document.querySelectorAll('[data-toc-link]'));

    if (links.length === 0) {
        return;
    }

    const entries = links
        .map((link) => ({ link, heading: document.getElementById(decodeURIComponent(link.hash.slice(1))) }))
        .filter((entry) => entry.heading);

    if (entries.length === 0) {
        return;
    }

    let queued = false;

    const sync = () => {
        queued = false;

        // Offset by the sticky header so a heading counts as "read" once it
        // passes underneath it rather than when it leaves the viewport.
        const threshold = 96;

        // The final headings often sit inside the last screenful and never
        // cross the threshold, so the bottom of the page selects the last one.
        const root = document.documentElement;
        const atBottom = Math.ceil(window.scrollY + window.innerHeight) >= root.scrollHeight - 2;

        let active = entries[0];

        for (const entry of entries) {
            if (entry.heading.getBoundingClientRect().top <= threshold) {
                active = entry;
            }
        }

        if (atBottom) {
            active = entries[entries.length - 1];
        }

        for (const entry of entries) {
            const isActive = entry === active;

            entry.link.classList.toggle('text-white', isActive);
            entry.link.classList.toggle('text-zinc-500', ! isActive);

            isActive
                ? entry.link.setAttribute('aria-current', 'true')
                : entry.link.removeAttribute('aria-current');
        }
    };

    const schedule = () => {
        if (queued) {
            return;
        }

        queued = true;
        requestAnimationFrame(sync);
    };

    window.addEventListener('scroll', schedule, { passive: true });
    window.addEventListener('resize', schedule, { passive: true });

    sync();
}

setupDrawer();
setupScrollSpy();
