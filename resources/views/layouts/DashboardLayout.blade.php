<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chronicle — Blog Dashboard</title>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'>
        <path fill='%23FFD700' d='M15.807.531c-.174-.177-.41-.289-.64-.363a3.8 3.8 0 0 0-.833-.15c-.62-.049-1.394 0-2.252.175C10.365.545
         8.264 1.415 6.315 3.1S3.147 6.824 2.557 8.523c-.294.847-.44 1.634-.429 2.268.005.316.05.62.154.88q.025.061.056.122A68 68 0 0 0
          .08 15.198a.53.53 0 0 0 .157.72.504.504 0 0 0 .705-.16 68 68 0 0 1 2.158-3.26c.285.141.616.195.958.182.513-.02 1.098-.188 1.723-.49
           1.25-.605 2.744-1.787 4.303-3.642l1.518-1.55a.53.53 0 0 0 0-.739l-.729-.744 1.311.209a.5.5 0 0 0 .443-.15l.663-.684c.663-.68
            1.292-1.325 1.763-1.892.314-.378.585-.752.754-1.107.163-.345.278-.773.112-1.188a.5.5 0 0 0-.112-.172M3.733 11.62C5.385 9.374 
            7.24 7.215 9.309 5.394l1.21 1.234-1.171 1.196-.027.03c-1.5 1.789-2.891 2.867-3.977 3.393-.544.263-.99.378-1.324.39a1.3 1.3 0 0
             1-.287-.018Zm6.769-7.22c1.31-1.028 2.7-1.914 4.172-2.6a7 7 0 0 1-.4.523c-.442.533-1.028 1.134-1.681 1.804l-.51.524z'/></svg>">
    {{--
    <link rel="icon"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'><path fill='%23FFD700' d='M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0'/></svg>">
    --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" />
    @stack('styles')
</head>

<body class="loading">

    <!-- ============ LOADER ============ -->
    <div id="pageLoader" aria-label="Loading Chronicle">
        <div class="loader-core">
            <div class="loader-logo">Chronicle</div>
            <div class="loader-track">
                <div class="loader-fill"></div>
            </div>
            <div class="loader-count"><span id="loaderPercent">0</span>%</div>
        </div>
    </div>

    <div class="app-wrap">

        <!-- ============ SIDEBAR ============ -->
        <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
        <aside class="sidebar" id="sidebar">
            <button class="collapse-btn" id="collapseBtn" title="Collapse sidebar"><i
                    class="bi bi-chevron-left"></i></button>
            <div class="sidebar-brand">
                <a class="navbar-brand chronicle-brand d-flex align-items-center gap-2 m-0" href="/">
                    <svg width="26" height="26" viewBox="0 0 16 16" class="brand-svg">
                        <defs>
                            <linearGradient id="logoGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#FFF0A0" />
                                <stop offset="40%" stop-color="#FFD700" />
                                <stop offset="100%" stop-color="#B8860B" />
                            </linearGradient>
                        </defs>
                        <path fill="url(#logoGrad)"
                            d="M15.807.531c-.174-.177-.41-.289-.64-.363a3.8 3.8 0 0 0-.833-.15c-.62-.049-1.394 0-2.252.175C10.365.545 8.264 1.415 6.315 3.1S3.147 6.824 2.557 8.523c-.294.847-.44 1.634-.429 2.268.005.316.05.62.154.88q.025.061.056.122A68 68 0 0 0 .08 15.198a.53.53 0 0 0 .157.72.504.504 0 0 0 .705-.16 68 68 0 0 1 2.158-3.26c.285.141.616.195.958.182.513-.02 1.098-.188 1.723-.49 1.25-.605 2.744-1.787 4.303-3.642l1.518-1.55a.53.53 0 0 0 0-.739l-.729-.744 1.311.209a.5.5 0 0 0 .443-.15l.663-.684c.663-.68 1.292-1.325 1.763-1.892.314-.378.585-.752.754-1.107.163-.345.278-.773.112-1.188a.5.5 0 0 0-.112-.172M3.733 11.62C5.385 9.374 7.24 7.215 9.309 5.394l1.21 1.234-1.171 1.196-.027.03c-1.5 1.789-2.891 2.867-3.977 3.393-.544.263-.99.378-1.324.39a1.3 1.3 0 0 1-.287-.018Zm6.769-7.22c1.31-1.028 2.7-1.914 4.172-2.6a7 7 0 0 1-.4.523c-.442.533-1.028 1.134-1.681 1.804l-.51.524z" />
                    </svg>
                    <span class="chronicle-logo brand-name">Chronicle</span>
                </a>
            </div>

            <nav class="side-nav">
                <div class="nav-section-label">Main</div>
                <a href="#" class="side-link active" title="Dashboard"><i class="bi bi-grid-1x2-fill"></i> <span
                        class="link-text">Dashboard</span></a>
                <a href="#" class="side-link" title="Posts"><i class="bi bi-file-earmark-text"></i> <span
                        class="link-text">Posts</span> <span class="badge-count">128</span></a>
                <a href="#" class="side-link" title="New Article"><i class="bi bi-pencil-square"></i> <span
                        class="link-text">New Article</span></a>
                <a href="#" class="side-link" title="Categories"><i class="bi bi-folder2-open"></i> <span
                        class="link-text">Categories</span></a>
                <a href="#" class="side-link" title="Tags"><i class="bi bi-tags"></i> <span
                        class="link-text">Tags</span></a>

                <div class="nav-section-label">Engagement</div>
                <a href="#" class="side-link" title="Comments"><i class="bi bi-chat-square-dots"></i> <span
                        class="link-text">Comments</span> <span class="badge-count">24</span></a>
                <a href="#" class="side-link" title="Authors"><i class="bi bi-people"></i> <span
                        class="link-text">Authors</span></a>
                <a href="#" class="side-link" title="Analytics"><i class="bi bi-graph-up-arrow"></i> <span
                        class="link-text">Analytics</span></a>

                <div class="nav-section-label">System</div>
                <a href="#" class="side-link" title="Media Library"><i class="bi bi-images"></i> <span
                        class="link-text">Media Library</span></a>
                <a href="#" class="side-link" title="Settings"><i class="bi bi-gear"></i> <span
                        class="link-text">Settings</span></a>
            </nav>

            <div class="sidebar-foot">
                <img class="avatar" src="https://i.pravatar.cc/80?img=12" alt="user" />
                <div>
                    <div style="font-weight:600;font-size:.9rem;">{{ auth()->user()->name}}</div>
                    <div style="color:var(--text2);font-size:.76rem;">Editor in Chief</div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="all: unset; cursor: pointer;" title="Log out">
                        <span class="logout-btn ms-auto">
                            <i class="bi bi-box-arrow-right"></i>
                        </span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- ============ MAIN ============ -->
        <div class="main">

            <!-- TOPBAR -->
            <header class="topbar">
                <button class="icon-btn menu-toggle" id="menuToggle"><i class="bi bi-list"></i></button>
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Search posts, authors, tags..." />
                </div>
                <div class="ms-auto d-flex align-items-center gap-2">
                    <button class="icon-btn" id="themeToggle" title="Toggle theme"><i
                            class="bi bi-moon-stars"></i></button>
                    <button class="icon-btn hide-sm"><i class="bi bi-bell"></i><span class="dot"></span></button>
                    <form action="{{ route('posts.create') }}" method="GET">
                        <button class="btn btn-accent"><i class="bi bi-plus-lg me-1"></i> New Post</button>
                    </form>
                </div>
            </header>

            <!-- THIS is where each page's content gets injected -->
            <main>

                @yield('content')

            </main>
        </div>
    </div>


    <script>
        // Dismiss the page loader once DOM is ready
        document.addEventListener('DOMContentLoaded', () => {
            const loader = document.getElementById('pageLoader');
            loader?.classList.add('active');          // animate the core in
            setTimeout(() => {
                loader?.classList.add('hidden');        // fade it out
                document.body.classList.remove('loading'); // restore scroll
            }, 900);
        });
    </script>

    @stack('scripts')
</body>

</html>