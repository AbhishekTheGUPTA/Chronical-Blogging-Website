
(function () {
    const btn = document.getElementById('backTop');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 600) btn.classList.add('show');
        else btn.classList.remove('show');
    });
    btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
})();