
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    
    {{-- @php
        $socialImage = $posts->getFirstMediaUrl('social_image');
        $socialImage = $socialImage ?: $posts->getFirstMediaUrl('featured_image');
    @endphp
    <meta property="og:title" content="{{ $posts->title }}">
    <meta property="og:description" content="{{ $posts->excerpt ?? strip_tags(Str::limit($posts->body, 150)) }}">
    <meta property="og:image" content="{{ $socialImage }}">
    <meta property="og:url" content="{{ route('read', $posts->slug) }}">
    <meta property="og:type" content="article">
    {{-- Twitter card --}}
    {{-- <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $posts->title }}">
    <meta name="twitter:description" content="{{ $posts->excerpt ?? strip_tags(Str::limit($posts->body, 150)) }}">
    <meta name="twitter:image" content="{{ $socialImage }}"> --}}
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'>
        <path fill='%23FFD700' d='M15.807.531c-.174-.177-.41-.289-.64-.363a3.8 3.8 0 0 0-.833-.15c-.62-.049-1.394 0-2.252.175C10.365.545
         8.264 1.415 6.315 3.1S3.147 6.824 2.557 8.523c-.294.847-.44 1.634-.429 2.268.005.316.05.62.154.88q.025.061.056.122A68 68 0 0 0
          .08 15.198a.53.53 0 0 0 .157.72.504.504 0 0 0 .705-.16 68 68 0 0 1 2.158-3.26c.285.141.616.195.958.182.513-.02 1.098-.188 1.723-.49
           1.25-.605 2.744-1.787 4.303-3.642l1.518-1.55a.53.53 0 0 0 0-.739l-.729-.744 1.311.209a.5.5 0 0 0 .443-.15l.663-.684c.663-.68
            1.292-1.325 1.763-1.892.314-.378.585-.752.754-1.107.163-.345.278-.773.112-1.188a.5.5 0 0 0-.112-.172M3.733 11.62C5.385 9.374 
            7.24 7.215 9.309 5.394l1.21 1.234-1.171 1.196-.027.03c-1.5 1.789-2.891 2.867-3.977 3.393-.544.263-.99.378-1.324.39a1.3 1.3 0 0
             1-.287-.018Zm6.769-7.22c1.31-1.028 2.7-1.914 4.172-2.6a7 7 0 0 1-.4.523c-.442.533-1.028 1.134-1.681 1.804l-.51.524z'/></svg>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/Home.css') }}">
    <title>@yield('title', 'Chronicle | Modern Blog')</title>
    @stack('styles')
</head>

<body class="loading">
    <div id="pageLoader" aria-label="Loading Chronicle">
        <div class="loader-core">
            <div class="loader-logo">Chronicle</div>
            <div class="loader-track"><div class="loader-fill"></div></div>
            <div class="loader-count"><span id="loaderPercent">0</span>%</div>
        </div>
    </div>

    <div id="pageContent" class="page-content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="#"><i class="bi bi-pen-fill me-2"></i>Chronicle</a>
                <div class="d-flex align-items-center gap-2 d-lg-none">
                    <button class="theme-btn" id="themeMob" title="Toggle theme"><i class="bi bi-sun-fill"
                            id="iconMob"></i></button>
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#mobileMenu"><i class="bi bi-list fs-3" style="color:var(--text)"></i></button>
                </div>
                <div class="collapse navbar-collapse" id="navMain">
                    <ul class="navbar-nav mx-auto gap-lg-3">
                        <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>    
                        <li class="nav-item"><a class="nav-link" href="{{ route('explore') }}">Explore</a></li>                      
                        <li class="nav-item"><a class="nav-link" href="#">Authors</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Podcast</a></li>
                    </ul>                    
                        <div class="d-flex align-items-center gap-3">
                            <button class="theme-btn d-none d-lg-flex" id="themeDesk" title="Toggle theme"><i
                                    class="bi bi-sun-fill" id="iconDesk"></i></button>
                            @auth
                                <a href="{{ route('dashboard') }}" class="btn dashboard">
                                    <i class="bi bi-person me-1"></i>Dashboard
                                </a>
                             @else
                            <button class="login-btn" data-bs-toggle="modal" data-bs-target="#authModal"><i
                                    class="bi bi-person me-1"></i>Log In / Sign Up</button>
                            @endauth
                        </div>
                            
                </div>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenu">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title"
                    style="background:linear-gradient(135deg,var(--accent),var(--accent2));-webkit-background-clip:text;-webkit-text-fill-color:transparent">
                    <i class="bi bi-pen-fill me-2"></i>Chronicle
                </h5><button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav flex-column gap-2">
                    <li class="nav-item"><a class="nav-link fs-5" href="#"><i class="bi bi-house me-2"></i>Home</a></li>
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
                <button class="login-btn w-100 text-center py-3" data-bs-toggle="modal" data-bs-target="#authModal"><i
                        class="bi bi-person me-2"></i>Log In / Sign Up</button>
            </div>
        </div>

        <!-- Auth Modal -->
        <div class="modal fade" id="authModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 pb-0">
                        <h4 class="modal-title"
                            style="font-family:'Playfair Display',serif;background:linear-gradient(135deg,var(--accent),var(--accent2));-webkit-background-clip:text;-webkit-text-fill-color:transparent">
                            Welcome Back</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body px-4">
                        <ul class="nav nav-pills mb-4" id="authTab" role="tablist">
                            <li class="nav-item flex-fill text-center"><button class="nav-link active w-100"
                                    style="background:var(--glow);color:var(--accent);border:1px solid rgba(230,184,74,.25)"
                                    data-bs-toggle="pill" data-bs-target="#loginTab">Log In</button></li>
                            <li class="nav-item flex-fill text-center"><button class="nav-link w-100"
                                    style="color:var(--text2);border:1px solid var(--border)" data-bs-toggle="pill"
                                    data-bs-target="#signupTab">Sign Up</button></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="loginTab">
                                <form class="flip-card__form" action="/login" method="POST">@csrf
                                    <input class="nl-input w-100 mb-3" name="login_email" placeholder="Email" type="email">
                                    <input class="nl-input w-100 mb-3" name="login_password" placeholder="Password" type="password">
                                    <button class="nl-btn w-100 py-2">Log In</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="signupTab">
                                <form class="flip-card__form" action="/register" method="POST">@csrf
                                    <input class="nl-input w-100 mb-3" placeholder="Name" name="name" type="text">
                                    <input class="nl-input w-100 mb-3" placeholder="Email" name="email" type="email">
                                    <input class="nl-input w-100 mb-3" placeholder="Password" name="password" type="password">
                                    <button class="nl-btn w-100 py-2">Create Account</button>
                                </form>
                            </div>
                        </div>
                        <p class="text-center mt-3" style="color:var(--text2);font-size:.8rem">Or continue with</p>
                        <div class="d-flex gap-2 justify-content-center mb-3">
                            <button class="pill"><i class="bi bi-google me-1"></i>Google</button>
                            <button class="pill"><i class="bi bi-github me-1"></i>GitHub</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- THIS is where each page's content gets injected -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <a class="d-inline-block" href="#"
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

        <button class="back-top" id="backTop" aria-label="Back to top"><i class="bi bi-arrow-up"></i></button>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/Home.js') }}"></script>
    @stack('scripts')
</body>

</html>