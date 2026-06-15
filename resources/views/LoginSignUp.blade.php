<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In / Sign Up | Chronicle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Login.css') }}">
</head>

<body class="loading">

    <div id="pageLoader" aria-label="Loading Chronicle">
        <div class="loader-core">
            <div class="loader-logo">Chronicle</div>
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
            <div class="loader-count"><span id="loaderPercent">0</span>%</div>
        </div>
    </div>

    <div id="pageContent" class="page-content">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.html"><i class="bi bi-pen-fill me-2"></i>Chronicle</a>
                <div class="d-flex align-items-center gap-2 d-lg-none">
                    <button class="theme-btn" id="themeMob" title="Toggle theme"><i class="bi bi-sun-fill"
                            id="iconMob"></i></button>
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#mobileMenu"><i class="bi bi-list fs-3" style="color:var(--text)"></i></button>
                </div>
                <div class="collapse navbar-collapse" id="navMain">
                    <ul class="navbar-nav mx-auto gap-lg-3">
                        <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Categories</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-laptop me-2"
                                            style="color:var(--accent)"></i>Technology</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-palette me-2"
                                            style="color:var(--accent)"></i>Design</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-briefcase me-2"
                                            style="color:var(--accent)"></i>Business</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-heart me-2"
                                            style="color:var(--accent)"></i>Lifestyle</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#">Authors</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Podcast</a></li>
                    </ul>
                    <div class="d-flex align-items-center gap-3">
                        <button class="theme-btn d-none d-lg-flex" id="themeDesk" title="Toggle theme"><i
                                class="bi bi-sun-fill" id="iconDesk"></i></button>
                        <a href="login.html" class="login-btn"><i class="bi bi-person me-1"></i>Log In / Sign Up</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title"
                    style="background:linear-gradient(135deg,var(--accent),var(--accent2));-webkit-background-clip:text;-webkit-text-fill-color:transparent">
                    <i class="bi bi-pen-fill me-2"></i>Chronicle</h5><button type="button" class="btn-close"
                    data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav flex-column gap-2">
                    <li class="nav-item"><a class="nav-link fs-5" href="index.html"><i
                                class="bi bi-house me-2"></i>Home</a></li>
                    <li class="nav-item"><a class="nav-link fs-5" href="#"><i
                                class="bi bi-laptop me-2"></i>Technology</a></li>
                    <li class="nav-item"><a class="nav-link fs-5" href="#"><i class="bi bi-palette me-2"></i>Design</a>
                    </li>
                    <li class="nav-item"><a class="nav-link fs-5" href="#"><i
                                class="bi bi-briefcase me-2"></i>Business</a></li>
                    <li class="nav-item"><a class="nav-link fs-5" href="#"><i class="bi bi-heart me-2"></i>Lifestyle</a>
                    </li>
                </ul>
                <hr style="border-color:var(--border)">
                <a href="login.html" class="login-btn w-100 text-center py-3"><i class="bi bi-person me-2"></i>Log In /
                    Sign Up</a>
            </div>
        </div>
        @auth
            <h1>Congrates you are logged in!</h1>
        @else
            <!-- Auth Hero -->
            <section class="auth-hero">
                <div class="container position-relative">
                    <div class="auth-intro">
                        <div class="auth-badge"><i class="bi bi-shield-lock"></i> Secure Access</div>
                        <h1>Welcome to <span style="color:var(--accent)">Chronicle</span></h1>
                        <p>Sign in to save articles, follow authors, and join our community of curious minds.</p>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="wrapper">
                            <div class="card-switch">
                                <label class="switch">
                                    <input type="checkbox" class="toggle">
                                    <span class="slider"></span>
                                    <span class="card-side"></span>
                                    <div class="flip-card__inner">
                                        <div class="flip-card__front">
                                            <div class="title">Log in</div>
                                            <form class="flip-card__form" method="POST" action="{{ route('login') }}">
                                                @csrf
                                                <input class="flip-card__input" name="login_email" placeholder="Email"
                                                    type="email">
                                                <input class="flip-card__input" name="login_password" placeholder="Password"
                                                    type="password">
                                                <button class="flip-card__btn" type="button">Let's go!</button>
                                            </form>
                                        </div>
                                        <div class="flip-card__back">
                                            <div class="title">Sign up</div>
                                            <form class="flip-card__form" method="POST" action="{{ route('register') }}">
                                                @csrf
                                                <input class="flip-card__input" placeholder="Name" name="name" type="text">
                                                <input class="flip-card__input" name="email" placeholder="Email"
                                                    type="email">
                                                <input class="flip-card__input" name="password" placeholder="Password"
                                                    type="password">
                                                <button class="flip-card__btn" type="button">Confirm!</button>
                                            </form>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="auth-footer">
                        <p><i class="bi bi-arrow-left me-1"></i>Back to <a href="index.html">Chronicle Home</a></p>
                    </div>
                </div>
            </section>
        @endauth

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <a class="d-inline-block" href="index.html"
                            style="font-family:'Playfair Display',serif;font-size:1.3rem;font-weight:900;background:linear-gradient(135deg,var(--accent),var(--accent2));-webkit-background-clip:text;-webkit-text-fill-color:transparent;margin-bottom:.75rem"><i
                                class="bi bi-pen-fill me-2"></i>Chronicle</a>
                        <p style="color:var(--text2);font-size:.83rem;max-width:320px">A modern publishing platform for
                            thoughtful stories, expert insights, and creative inspiration.</p>
                        <div class="d-flex gap-2 mt-3">
                            <a href="#" class="social-link"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-link"><i class="bi bi-linkedin"></i></a>
                            <a href="#" class="social-link"><i class="bi bi-github"></i></a>
                        </div>
                    </div>
                    <div class="col-6 col-lg-2">
                        <h6 style="font-weight:700;margin-bottom:.7rem;color:var(--text)">Categories</h6><a href="#"
                            class="foot-link">Technology</a><a href="#" class="foot-link">Design</a><a href="#"
                            class="foot-link">Business</a><a href="#" class="foot-link">Lifestyle</a><a href="#"
                            class="foot-link">Ideas</a>
                    </div>
                    <div class="col-6 col-lg-2">
                        <h6 style="font-weight:700;margin-bottom:.7rem;color:var(--text)">Company</h6><a href="#"
                            class="foot-link">About Us</a><a href="#" class="foot-link">Careers</a><a href="#"
                            class="foot-link">Press</a><a href="#" class="foot-link">Contact</a>
                    </div>
                    <div class="col-6 col-lg-2">
                        <h6 style="font-weight:700;margin-bottom:.7rem;color:var(--text)">Resources</h6><a href="#"
                            class="foot-link">Blog</a><a href="#" class="foot-link">Newsletter</a><a href="#"
                            class="foot-link">Events</a><a href="#" class="foot-link">Help Center</a>
                    </div>
                    <div class="col-6 col-lg-2">
                        <h6 style="font-weight:700;margin-bottom:.7rem;color:var(--text)">Legal</h6><a href="#"
                            class="foot-link">Privacy</a><a href="#" class="foot-link">Terms</a><a href="#"
                            class="foot-link">Cookie Policy</a>
                    </div>
                </div>
                <hr style="border-color:var(--border);margin:1.5rem 0">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <p style="color:var(--text2);font-size:.8rem;margin:0">&copy; 2026 Chronicle. All rights reserved.
                    </p>
                    <p style="color:var(--text2);font-size:.8rem;margin:0">Made with <i class="bi bi-heart-fill"
                            style="color:var(--accent)"></i> by Chronicle Team</p>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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

            // Form feedback
            document.querySelectorAll('.flip-card__btn').forEach(btn => {
                btn.addEventListener('click', function () {
                    const original = this.textContent;
                    this.textContent = '✓ Done!';
                    setTimeout(() => { this.textContent = original; }, 1200);
                });
            });
        });
    </script>
</body>

</html>