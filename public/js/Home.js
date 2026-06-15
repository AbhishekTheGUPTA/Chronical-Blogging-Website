
document.addEventListener('DOMContentLoaded', function () {
    const loader = document.getElementById('pageLoader'), pct = document.getElementById('loaderPercent'), loaderStart = performance.now();
    if (loader) {
        requestAnimationFrame(() => loader.classList.add('active'));
        const count = setInterval(() => {
            const n = Math.min(100, Math.round(((performance.now() - loaderStart) / 1200) * 100));
            pct.textContent = n;
            if (n === 100) clearInterval(count);
        }, 12);
        const finishLoader = () => {
            const delay = Math.max(0, 1200 - (performance.now() - loaderStart)) + 200;
            setTimeout(() => {
                clearInterval(count); pct.textContent = '100'; loader.classList.add('hidden');
                setTimeout(() => { loader.style.display = 'none'; document.body.classList.remove('loading'); document.body.classList.add('loaded'); }, 400);
            }, delay);
        };
        if (document.readyState === 'complete') finishLoader();
        else window.addEventListener('load', finishLoader, { once: true });
    }

    const html = document.documentElement;
    let savedTheme = localStorage.getItem('chronicle-theme');
    if (!savedTheme) savedTheme = 'dark';
    html.setAttribute('data-bs-theme', savedTheme);

    function updateIcons(t) {
        const sun = 'bi-sun-fill', moon = 'bi-moon-fill';
        const d = document.getElementById('iconDesk'), m = document.getElementById('iconMob');
        if (d) d.className = 'bi ' + (t === 'dark' ? sun : moon);
        if (m) m.className = 'bi ' + (t === 'dark' ? sun : moon);
    }
    updateIcons(savedTheme);

    function toggleTheme() {
        const c = html.getAttribute('data-bs-theme');
        const n = c === 'dark' ? 'light' : 'dark';
        html.setAttribute('data-bs-theme', n);
        localStorage.setItem('chronicle-theme', n);
        updateIcons(n);
    }
    const dB = document.getElementById('themeDesk'), mB = document.getElementById('themeMob');
    if (dB) { dB.addEventListener('click', toggleTheme); dB.style.cursor = 'pointer'; }
    if (mB) { mB.addEventListener('click', toggleTheme); mB.style.cursor = 'pointer'; }

    // Category Filter
    document.querySelectorAll('.pill[data-cat]').forEach(p => {
        p.addEventListener('click', () => {
            document.querySelectorAll('.pill[data-cat]').forEach(x => x.classList.remove('active'));
            p.classList.add('active');
            const cat = p.dataset.cat;
            document.querySelectorAll('.article').forEach(a => { a.style.display = (cat === 'all' || a.dataset.cat === cat) ? '' : 'none'; });
        });
    });

    // Search
    const search = document.querySelector('.search-input');
    if (search) search.addEventListener('input', e => {
        const q = e.target.value.toLowerCase();
        document.querySelectorAll('.article').forEach(a => {
            const t = a.querySelector('.card-title').textContent.toLowerCase();
            const d = a.querySelector('.card-text').textContent.toLowerCase();
            a.style.display = (t.includes(q) || d.includes(q)) ? '' : 'none';
        });
    });

    // Load More
    const loadBtn = document.getElementById('loadMore');
    if (loadBtn) loadBtn.addEventListener('click', function () {
        const btn = this;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Loading...';
        setTimeout(() => {
            const grid = document.getElementById('articleGrid');
            const extras = [
                { img: '1555066931-4365d14bab8c', cat: 'tech', label: 'Technology', title: 'The Rise of Edge Computing', author: 'James Lee', time: '6 min' },
                { img: '1561070791-2526d30994b5', cat: 'design', label: 'Design', title: 'Typography Rules for 2026', author: 'Olivia Kim', time: '5 min' },
                { img: '1460925895917-afdab827c52f', cat: 'business', label: 'Business', title: 'Scaling Startups Without Burnout', author: 'Ryan Chen', time: '8 min' }
            ];
            extras.forEach(x => {
                const div = document.createElement('article');
                div.className = 'card article';
                div.dataset.cat = x.cat;
                div.innerHTML = '<div class="card-img-wrap"><img src="https://images.unsplash.com/photo-' + x.img + '?w=600&h=400&fit=crop" alt="" class="card-img-top" width="600" height="400" loading="lazy"></div><div class="card-body"><span class="cat-tag" style="font-size:.63rem;padding:.2rem .55rem;margin-bottom:.45rem">' + x.label + '</span><h5 class="card-title">' + x.title + '</h5><p class="card-text">An insightful article exploring emerging trends in ' + x.label.toLowerCase() + '.</p><div class="card-meta"><span>' + x.author + '</span><span class="reading-time"><i class="bi bi-clock"></i> ' + x.time + '</span></div></div>';
                grid.appendChild(div);
            });
            btn.innerHTML = '<i class="bi bi-arrow-down-circle me-1"></i> Load More Articles';
        }, 600);
    });

    // Back to Top
    const backTop = document.getElementById('backTop');
    if (backTop) {
        window.addEventListener('scroll', () => { backTop.classList.toggle('show', window.scrollY > 400); });
        backTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
    }
});
