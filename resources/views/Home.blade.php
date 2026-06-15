@extends('layouts.Home')
@section('content')
    <!-- Hero -->
    <section class="hero text-center">
        <div class="container position-relative" style="z-index:2">
            <div class="hero-badge"><i class="bi bi-stars"></i> Welcome to Chronicle</div>
            <h1 class="hero-title">Stories that <span style="color:var(--accent)">inspire</span>, insights that
                <span style="color:var(--accent)">empower</span>
            </h1>
            <p class="hero-sub">Discover thought-provoking articles on technology, design, business, and life. Join
                our community of curious minds.</p>
            <div class="search-wrap mx-auto">
                <i class="bi bi-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Search articles, topics, authors...">
            </div>
            <div class="pill-wrap">
                <button class="pill active" data-cat="all"><i class="bi bi-grid-fill me-1"></i>All</button>
                <button class="pill" data-cat="tech"><i class="bi bi-laptop me-1"></i>Tech</button>
                <button class="pill" data-cat="design"><i class="bi bi-palette me-1"></i>Design</button>
                <button class="pill" data-cat="business"><i class="bi bi-briefcase me-1"></i>Business</button>
                <button class="pill" data-cat="life"><i class="bi bi-heart me-1"></i>Life</button>
                <button class="pill" data-cat="ideas"><i class="bi bi-lightbulb me-1"></i>Ideas</button>
            </div>
        </div>
    </section>

    <!-- Featured Card (60vw) -->
    <div class="featured-section">
        <article class="featured-card">
            <div class="img-wrap">
                <img src="https://images.unsplash.com/photo-1677442136019-21780ecad995?w=1200&h=600&fit=crop&crop=center"
                    alt="Future of AI" width="1200" height="600" loading="lazy">
            </div>
            <div class="featured-overlay">
                <span class="cat-tag">Technology</span>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&q=80" alt="Sarah Chen"
                        class="author-sm" width="32" height="32" loading="lazy">
                    <div><small style="font-weight:600;color:var(--text)">Sarah Chen</small>
                        <div style="font-size:.73rem;color:var(--text2)"><i class="bi bi-clock me-1"></i>8 min read
                        </div>
                    </div>
                </div>
                <h2 style="font-size:1.5rem;font-weight:800;margin-bottom:.4rem;color:#fff">The Future of AI: How
                    Machine Learning is Reshaping Industries in 2024</h2>
                <p style="color:rgba(255,255,255,.7);font-size:.88rem;margin:0">Explore the transformative impact of
                    artificial intelligence across healthcare, finance, and creative industries, and what it means
                    for the future of work.</p>
            </div>
        </article>
    </div>

    <!-- Main Content -->
    <section class="py-3">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="section-head">
                        <h3 style="font-size:1.5rem;margin:0;color:var(--text)">Latest Articles</h3>
                        <button class="sort-btn" data-bs-toggle="dropdown"><i class="bi bi-sort-down me-1"></i>Sort
                            by</button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Newest First</a></li>
                            <li><a class="dropdown-item" href="#">Most Popular</a></li>
                            <li><a class="dropdown-item" href="#">Most Liked</a></li>
                        </ul>
                    </div>

                    <div class="grid-3" id="articleGrid">
                        <article class="card article" data-cat="tech">
                            <div class="card-img-wrap"><img
                                    src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=600&h=400&fit=crop"
                                    alt="" class="card-img-top" width="600" height="400" loading="lazy"></div>
                            <div class="card-body">
                                <span class="cat-tag"
                                    style="font-size:.63rem;padding:.2rem .55rem;margin-bottom:.45rem">Technology</span>
                                <h5 class="card-title">Understanding WebAssembly: The Future of Web Performance</h5>
                                <p class="card-text">A deep dive into how WebAssembly is revolutionizing browser
                                    capabilities and enabling near-native performance.</p>
                                <div class="card-meta"><img
                                        src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=60&q=80" alt=""
                                        class="author-sm" width="32" height="32" loading="lazy"><span>Marcus
                                        Johnson</span><span class="reading-time"><i class="bi bi-clock"></i> 7
                                        min</span></div>
                            </div>
                        </article>

                        <article class="card article" data-cat="design">
                            <div class="card-img-wrap"><img
                                    src="https://images.unsplash.com/photo-1561070791-2526d30994b5?w=600&h=400&fit=crop"
                                    alt="" class="card-img-top" width="600" height="400" loading="lazy"></div>
                            <div class="card-body">
                                <span class="cat-tag"
                                    style="font-size:.63rem;padding:.2rem .55rem;margin-bottom:.45rem">Design</span>
                                <h5 class="card-title">Color Psychology in Brand Identity: A 2026 Guide</h5>
                                <p class="card-text">How strategic color choices can influence consumer perception
                                    and strengthen brand recognition.</p>
                                <div class="card-meta"><img
                                        src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=60&q=80" alt=""
                                        class="author-sm" width="32" height="32" loading="lazy"><span>Emma
                                        Wilson</span><span class="reading-time"><i class="bi bi-clock"></i> 4
                                        min</span></div>
                            </div>
                        </article>

                        <article class="card article" data-cat="business">
                            <div class="card-img-wrap"><img
                                    src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop"
                                    alt="" class="card-img-top" width="600" height="400" loading="lazy"></div>
                            <div class="card-body">
                                <span class="cat-tag"
                                    style="font-size:.63rem;padding:.2rem .55rem;margin-bottom:.45rem">Business</span>
                                <h5 class="card-title">Sustainable Business Models: Profit Meets Purpose</h5>
                                <p class="card-text">Exploring how modern companies integrate environmental
                                    responsibility into core strategies.</p>
                                <div class="card-meta"><img
                                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=60&q=80" alt=""
                                        class="author-sm" width="32" height="32" loading="lazy"><span>David
                                        Park</span><span class="reading-time"><i class="bi bi-clock"></i> 9
                                        min</span></div>
                            </div>
                        </article>

                        <article class="card article" data-cat="life">
                            <div class="card-img-wrap"><img
                                    src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=600&h=400&fit=crop"
                                    alt="" class="card-img-top" width="600" height="400" loading="lazy"></div>
                            <div class="card-body">
                                <span class="cat-tag"
                                    style="font-size:.63rem;padding:.2rem .55rem;margin-bottom:.45rem">Lifestyle</span>
                                <h5 class="card-title">Digital Wellness: Finding Balance in a Connected World</h5>
                                <p class="card-text">Practical strategies for maintaining mental health in an
                                    always-on digital culture.</p>
                                <div class="card-meta"><img
                                        src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=60&q=80" alt=""
                                        class="author-sm" width="32" height="32" loading="lazy"><span>Lisa
                                        Thompson</span><span class="reading-time"><i class="bi bi-clock"></i> 5
                                        min</span></div>
                            </div>
                        </article>

                        <article class="card article" data-cat="tech">
                            <div class="card-img-wrap"><img
                                    src="https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=600&h=400&fit=crop"
                                    alt="" class="card-img-top" width="600" height="400" loading="lazy"></div>
                            <div class="card-body">
                                <span class="cat-tag"
                                    style="font-size:.63rem;padding:.2rem .55rem;margin-bottom:.45rem">Technology</span>
                                <h5 class="card-title">React Server Components: A Complete Guide</h5>
                                <p class="card-text">Everything about the future of React and how server components
                                    change web development.</p>
                                <div class="card-meta"><img
                                        src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=60&q=80" alt=""
                                        class="author-sm" width="32" height="32" loading="lazy"><span>Alex
                                        Rivera</span><span class="reading-time"><i class="bi bi-clock"></i> 11
                                        min</span></div>
                            </div>
                        </article>

                        <article class="card article" data-cat="ideas">
                            <div class="card-img-wrap"><img
                                    src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&h=400&fit=crop"
                                    alt="" class="card-img-top" width="600" height="400" loading="lazy"></div>
                            <div class="card-body">
                                <span class="cat-tag"
                                    style="font-size:.63rem;padding:.2rem .55rem;margin-bottom:.45rem">Ideas</span>
                                <h5 class="card-title">The Art of Deep Work in Distracted Times</h5>
                                <p class="card-text">Rediscovering focus and productivity through intentional work
                                    practices.</p>
                                <div class="card-meta"><img
                                        src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=60&q=80" alt=""
                                        class="author-sm" width="32" height="32" loading="lazy"><span>Nina
                                        Patel</span><span class="reading-time"><i class="bi bi-clock"></i> 6
                                        min</span></div>
                            </div>
                        </article>
                    </div>

                    <div class="text-center mt-4"><button class="load-btn" id="loadMore"><i
                                class="bi bi-arrow-down-circle me-1"></i> Load More Articles</button></div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="sidebar-card">
                        <div class="sidebar-title"><i class="bi bi-person-circle me-2"></i>Author Spotlight</div>
                        <div class="text-center">
                            <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=150&q=80"
                                alt="Amanda Foster" class="rounded-circle mb-2" width="72" height="72" loading="lazy"
                                style="object-fit:cover;border:2px solid var(--border)">
                            <h6 style="font-weight:700;margin-bottom:.15rem;color:var(--text)">Dr. Amanda Foster
                            </h6>
                            <p style="color:var(--text2);font-size:.78rem;margin-bottom:.4rem">AI Researcher & Tech
                                Writer</p>
                            <p style="color:var(--text2);font-size:.75rem">Exploring the intersection of technology
                                and humanity through thoughtful analysis.</p>
                        </div>
                    </div>

                    <div class="sidebar-card">
                        <div class="sidebar-title"><i class="bi bi-fire me-2"></i>Trending Now</div>
                        <div class="trend-item"><span class="trend-num">01</span>
                            <div>
                                <div class="trend-text">OpenAI's Latest Breakthrough</div>
                                <div class="trend-meta">2.4k reads</div>
                            </div>
                        </div>
                        <div class="trend-item"><span class="trend-num">02</span>
                            <div>
                                <div class="trend-text">CSS Container Queries Guide</div>
                                <div class="trend-meta">1.8k reads</div>
                            </div>
                        </div>
                        <div class="trend-item"><span class="trend-num">03</span>
                            <div>
                                <div class="trend-text">2026 Design Trends</div>
                                <div class="trend-meta">1.5k reads</div>
                            </div>
                        </div>
                        <div class="trend-item"><span class="trend-num">04</span>
                            <div>
                                <div class="trend-text">Remote Work Best Practices</div>
                                <div class="trend-meta">1.2k reads</div>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-card">
                        <div class="sidebar-title"><i class="bi bi-tags me-2"></i>Popular Tags</div>
                        <a href="#" class="tag">#JavaScript</a>
                        <a href="#" class="tag">#AI</a>
                        <a href="#" class="tag">#UXDesign</a>
                        <a href="#" class="tag">#Startup</a>
                        <a href="#" class="tag">#WebDev</a>
                        <a href="#" class="tag">#Productivity</a>
                        <a href="#" class="tag">#Career</a>
                        <a href="#" class="tag">#Innovation</a>
                    </div>

                    <div class="nl-box">
                        <h6 style="font-weight:700;color:var(--accent);margin-bottom:.4rem"><i
                                class="bi bi-envelope-paper me-2"></i>Weekly Digest</h6>
                        <p style="color:var(--text2);font-size:.78rem;margin-bottom:.7rem">Best articles every
                            Monday.</p>
                        <input type="email" class="nl-input w-100 mb-2" placeholder="Your email">
                        <button class="nl-btn w-100">Subscribe</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter CTA -->
    <section class="py-4">
        <div class="container">
            <div class="newsletter-section text-center">
                <h2
                    style="font-size:2rem;margin-bottom:.5rem;position:relative;z-index:2;background:linear-gradient(135deg,var(--accent),#f5d98c,var(--accent2));-webkit-background-clip:text;-webkit-text-fill-color:transparent">
                    Join 50,000+ Readers</h2>
                <p style="color:var(--text2);margin-bottom:1.5rem;position:relative;z-index:2">Stay ahead with
                    curated insights on tech, design, and business.</p>
                <div class="d-flex flex-wrap gap-2 justify-content-center position-relative" style="z-index:2">
                    <input type="email" class="nl-input" placeholder="Enter your email" style="max-width:340px;width:100%">
                    <button class="nl-btn">Subscribe Now <i class="bi bi-arrow-right ms-1"></i></button>
                </div>
                <p style="color:var(--text2);font-size:.73rem;margin-top:.8rem;position:relative;z-index:2"><i
                        class="bi bi-shield-check me-1"></i>We respect your privacy. No spam, ever.</p>
            </div>
        </div>
    </section>

@endsection