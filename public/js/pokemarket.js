/* =========================================================
   PokéMarket – JavaScript sencillo (sin librerías)
   ========================================================= */
document.addEventListener('DOMContentLoaded', () => {
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ---------- 1. Menú móvil ---------- */
    const toggle = document.querySelector('.nav-toggle');
    const nav = document.getElementById('main-nav');
    if (toggle && nav) {
        toggle.addEventListener('click', () => {
            const open = nav.classList.toggle('open');
            toggle.setAttribute('aria-expanded', open);
        });
        nav.querySelectorAll('a').forEach(a => a.addEventListener('click', () => nav.classList.remove('open')));
    }

    /* ---------- 2. Aparición al hacer scroll (IntersectionObserver) ---------- */
    const revealEls = document.querySelectorAll('.reveal');
    if (reduceMotion || !('IntersectionObserver' in window)) {
        revealEls.forEach(el => el.classList.add('visible'));
    } else {
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        revealEls.forEach(el => observer.observe(el));
    }

    /* ---------- 3. Carta 3D con brillo holográfico ---------- */
    document.querySelectorAll('[data-tilt]').forEach(card => {
        if (reduceMotion) return;
        card.addEventListener('mousemove', e => {
            const r = card.getBoundingClientRect();
            const x = (e.clientX - r.left) / r.width;   // 0..1
            const y = (e.clientY - r.top) / r.height;   // 0..1
            card.style.setProperty('--ry', ((x - 0.5) * 24) + 'deg');
            card.style.setProperty('--rx', ((0.5 - y) * 24) + 'deg');
            card.style.setProperty('--mx', (x * 100) + '%');
            card.style.setProperty('--my', (y * 100) + '%');
        });
        card.addEventListener('mouseleave', () => {
            card.style.setProperty('--rx', '0deg');
            card.style.setProperty('--ry', '0deg');
        });
    });

    /* ---------- 4. Filtros por tipo/rareza y ordenación ---------- */
    const grid = document.getElementById('card-grid');
    if (grid) {
        const cards = Array.from(grid.querySelectorAll('.card'));
        const filters = { type: '', rarity: '' };
        const countEl = document.getElementById('visible-count');
        const noResults = document.getElementById('no-results');

        const applyFilters = () => {
            let visible = 0;
            cards.forEach(card => {
                const ok = (!filters.type || card.dataset.type === filters.type) &&
                           (!filters.rarity || card.dataset.rarity === filters.rarity);
                card.hidden = !ok;
                if (ok) visible++;
            });
            countEl.textContent = visible;
            noResults.hidden = visible !== 0;
        };

        document.querySelectorAll('[data-filter-group]').forEach(group => {
            group.addEventListener('click', e => {
                const chip = e.target.closest('.chip');
                if (!chip) return;
                group.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
                chip.classList.add('active');
                filters[group.dataset.filterGroup] = chip.dataset.value;
                applyFilters();
            });
        });

        const original = cards.slice(); // orden inicial
        document.getElementById('sort-select').addEventListener('change', e => {
            const v = e.target.value;
            const sorted = original.slice();
            if (v === 'price-asc')  sorted.sort((a, b) => a.dataset.price - b.dataset.price);
            if (v === 'price-desc') sorted.sort((a, b) => b.dataset.price - a.dataset.price);
            if (v === 'name')       sorted.sort((a, b) => a.dataset.name.localeCompare(b.dataset.name, 'es'));
            sorted.forEach(c => grid.appendChild(c));
        });
    }

    /* ---------- 5. Modal "Ver carta" ---------- */
    const modal = document.getElementById('card-modal');
    if (modal) {
        const $ = id => document.getElementById(id);
        document.querySelectorAll('.js-open-modal').forEach(btn => {
            btn.addEventListener('click', () => {
                const d = btn.closest('.card').dataset;
                const typeClass = Array.from(btn.closest('.card').classList).find(c => c.startsWith('type-'));
                $('modal-art').className = 'modal-art ' + (typeClass || '');
                const img = $('modal-img');
                if (d.image) { img.src = d.image; img.alt = 'Ilustración de ' + d.name; img.hidden = false; }
                else { img.hidden = true; }
                $('modal-name').textContent = d.name;
                $('modal-desc').textContent = d.description;
                $('modal-type').textContent = d.icon + ' ' + d.type;
                $('modal-set').textContent = d.set;
                $('modal-number').textContent = d.number;
                $('modal-price').textContent = d.priceLabel;
                const badge = $('modal-rarity');
                badge.textContent = d.rarity;
                badge.className = 'badge ' + Array.from(btn.closest('.card').classList).find(c => c.startsWith('rarity-'));
                modal.showModal();
            });
        });
        modal.querySelector('.modal-close').addEventListener('click', () => modal.close());
        // Cerrar al hacer clic fuera del contenido
        modal.addEventListener('click', e => { if (e.target === modal) modal.close(); });
    }
});
