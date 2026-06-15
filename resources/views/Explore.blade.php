@extends('layouts.Home')
@section('content')
    <!-- ==================== PAGE CONTENT (goes inside @yield('content')) ==================== -->
    <main class="pp-page">
        <section class="pp-hero">
            <div class="container-lg">
                <div class="row align-items-center g-4">
                    <div class="col-lg-7">
                        <span class="pp-hero-eyebrow"><span class="pp-accent">●</span> Fresh thoughts, daily.</span>
                        <h1 class="pp-hero-title">Stories from the <em>community</em><br>worth your time.</h1>
                        <p class="pp-hero-copy">Discover thoughtful posts, personal essays, and ideas from writers and
                            creators around the world. All public, all free, always.</p>
                        <div class="pp-search mb-3">
                            <i class="bi bi-search pp-muted"></i>
                            <input type="text" placeholder="Search posts, authors, topics...">
                            <button class="pp-btn-accent" type="button">Search</button>
                        </div>
                        <div class="d-flex flex-wrap gap-4">
                            <div class="pp-stat"><strong>12.4k</strong><span>Posts</span></div>
                            <div class="pp-stat"><strong>3.8k</strong><span>Writers</span></div>
                            <div class="pp-stat"><strong>92</strong><span>Categories</span></div>
                        </div>
                    </div>
                    <div class="col-lg-5 d-none d-lg-block">
                        <div class="pp-mini-preview">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <span class="pp-window-dot" style="background:#e65c5c;"></span>
                                <span class="pp-window-dot" style="background:#e6b84a;"></span>
                                <span class="pp-window-dot" style="background:#5cb85c;"></span>
                                <span class="ms-2 pp-muted" style="font-size:.76rem;">inkwell.app / feed</span>
                            </div>
                            <div class="d-flex gap-2 align-items-center mb-2">
                                <div class="pp-avatar">AK</div>
                                <div>
                                    <div style="font-weight:700;font-size:.88rem;color:var(--text);">Ada Kim</div>
                                    <div class="pp-muted" style="font-size:.74rem;">2 hours ago · Productivity</div>
                                </div>
                            </div>
                            <h2 class="m-0 mb-2"
                                style="font-family:'Inter',system-ui,sans-serif;font-size:1rem;font-weight:800;line-height:1.35;color:var(--text);">
                                The quiet power of writing things down</h2>
                            <p class="pp-muted mb-3" style="font-size:.84rem;line-height:1.55;">A small practice that
                                rewires how you think, decide, and remember — every single day.</p>
                            <div class="d-flex gap-3 pp-muted" style="font-size:.8rem;"><span><i class="bi bi-heart"></i>
                                    248</span><span><i class="bi bi-chat"></i> 34</span><span><i class="bi bi-bookmark"></i>
                                    save</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pp-filter-bar">
            <div class="container-lg">
                <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center">
                    <div class="d-flex flex-wrap gap-2">
                        <span class="pp-pill is-active">All Posts</span>
                        <span class="pp-pill">Trending</span>
                        <span class="pp-pill">Latest</span>
                        <span class="pp-pill">Most Liked</span>
                        <span class="pp-pill">Following</span>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <span class="pp-muted d-none d-sm-inline" style="font-size:.85rem;">Showing 1–9 of 248 posts</span>
                        <div class="pp-sort">
                            <details>
                                <summary><i class="bi bi-arrow-down-up pp-accent"
                                        style="font-size:.82rem;"></i><span>Latest</span><i
                                        class="bi bi-chevron-down pp-sort-chevron"></i></summary>
                                <div class="pp-sort-menu">
                                    <a href="#" class="pp-sort-option is-selected"><i
                                            class="bi bi-clock"></i><span>Latest</span><i
                                            class="bi bi-check2 pp-sort-check"></i></a>
                                    <a href="#" class="pp-sort-option"><i class="bi bi-fire"></i><span>Popular</span></a>
                                    <a href="#" class="pp-sort-option"><i class="bi bi-chat-dots"></i><span>Most
                                            Discussed</span></a>
                                    <a href="#" class="pp-sort-option"><i
                                            class="bi bi-hourglass-bottom"></i><span>Oldest</span></a>
                                </div>
                            </details>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-5">
            <div class="container-lg">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="row g-4">
                            {{-- {{ dd($posts) }} --}}
                            
                            @foreach($posts as $post)
                            {{-- {{ dd($post->getMedia('featured_image')) }} --}}
                            <!-- DEBUG: {{ $post->getFirstMediaUrl('featured_image') }} -->
                            <article class="col-md-6 col-xl-4">
                                <div class="pp-post-card">
                                    @php 
                                        $imageUrl = $post->getFirstMediaUrl('featured_image');
                                        $imageUrl = $imageUrl ?: 'https://images.unsplash.com/...';
                                        $encodedUrl = str_replace(['(', ')'], ['%28', '%29'], $imageUrl);
                                    @endphp
                                    <div class="pp-cover" style="background-image:url('{{ $encodedUrl }}');">
                                        <span class="pp-category">{{ $post->categories->first()->name ?? 'No Category' }}</span>
                                    </div>
                                    <div class="pp-card-body">
                                        <div class="pp-byline">
                                            <span class="pp-avatar-sm">ML</span>
                                            <span>Maya Lin · 1h ago</span>
                                        </div>{{ $post->title }}</h2>
                                        <p class="pp-excerpt">{{ $post->Description }}</p>
                                        <div class="pp-card-footer">
                                            <div class="d-flex gap-3">
                                                <span class="pp-meta"><i class="bi bi-heart"></i>{{ $post->views }}</span>
                                                <span class="pp-meta"><i class="bi bi-chat"></i> {{ $post->comments->count() + $post->comments->sum(fn($c) => $c->replies->count()) }}</span>
                                            </div><a href="{{ route('read', $post->slug) }}" class="pp-read-more">Read <i
                                                    class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            @endforeach
                            {{-- <article class="col-md-6 col-xl-4">
                                <div class="pp-post-card">
                                    <div class="pp-cover"
                                        style="background-image:url('https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800');">
                                        <span class="pp-category">Engineering</span></div>
                                    <div class="pp-card-body">
                                        <div class="pp-byline"><span class="pp-avatar-sm">RS</span><span>Ravi Shah · 3h
                                                ago</span></div>
                                        <h2 class="pp-post-title">Writing code that other humans can read</h2>
                                        <p class="pp-excerpt">Boring is a feature. Seven small habits that turn messy
                                            scripts into maintainable systems.</p>
                                        <div class="pp-card-footer">
                                            <div class="d-flex gap-3"><span class="pp-meta"><i class="bi bi-heart"></i>
                                                    842</span><span class="pp-meta"><i class="bi bi-chat"></i> 52</span>
                                            </div><a href="#" class="pp-read-more">Read <i
                                                    class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-md-6 col-xl-4">
                                <div class="pp-post-card">
                                    <div class="pp-cover"
                                        style="background-image:url('https://images.unsplash.com/photo-1495197359483-d092478c170a?w=800');background-position:bottom;">
                                        <span class="pp-category">Design</span></div>
                                    <div class="pp-card-body">
                                        <div class="pp-byline"><span class="pp-avatar-sm">EC</span><span>Elena Cruz · 5h
                                                ago</span></div>
                                        <h2 class="pp-post-title">The golden ratio is a myth you can ignore</h2>
                                        <p class="pp-excerpt">What if the design rules you learned were just folklore? A
                                            designer's honest take on intuition vs dogma.</p>
                                        <div class="pp-card-footer">
                                            <div class="d-flex gap-3"><span class="pp-meta"><i class="bi bi-heart"></i>
                                                    2.4k</span><span class="pp-meta"><i class="bi bi-chat"></i> 312</span>
                                            </div><a href="#" class="pp-read-more">Read <i
                                                    class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-md-6 col-xl-4">
                                <div class="pp-post-card">
                                    <div class="pp-cover"
                                        style="background-image:url('https://images.unsplash.com/photo-1493770348161-369560ae357d?w=800');">
                                        <span class="pp-category">Food</span></div>
                                    <div class="pp-card-body">
                                        <div class="pp-byline"><span class="pp-avatar-sm">HO</span><span>Hana Okafor · 1d
                                                ago</span></div>
                                        <h2 class="pp-post-title">The lazy cook's guide to perfect weeknight dinners</h2>
                                        <p class="pp-excerpt">Six pantry recipes under 25 minutes, no fancy tools required.
                                            Tasty, cheap, repeatable.</p>
                                        <div class="pp-card-footer">
                                            <div class="d-flex gap-3"><span class="pp-meta"><i class="bi bi-heart"></i>
                                                    567</span><span class="pp-meta"><i class="bi bi-chat"></i> 28</span>
                                            </div><a href="#" class="pp-read-more">Read <i
                                                    class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-md-6 col-xl-4">
                                <div class="pp-post-card">
                                    <div class="pp-cover"
                                        style="background-image:url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=800');">
                                        <span class="pp-category">Travel</span></div>
                                    <div class="pp-card-body">
                                        <div class="pp-byline"><span class="pp-avatar-sm">TP</span><span>Theo Park · 1d
                                                ago</span></div>
                                        <h2 class="pp-post-title">I quit my job to travel. Here's what they don't tell you.
                                        </h2>
                                        <p class="pp-excerpt">An honest, unglamorous reflection on burnout, reinvention, and
                                            the strange cost of freedom.</p>
                                        <div class="pp-card-footer">
                                            <div class="d-flex gap-3"><span class="pp-meta"><i class="bi bi-heart"></i>
                                                    3.1k</span><span class="pp-meta"><i class="bi bi-chat"></i> 421</span>
                                            </div><a href="#" class="pp-read-more">Read <i
                                                    class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-md-6 col-xl-4">
                                <div class="pp-post-card">
                                    <div class="pp-cover"
                                        style="background-image:url('https://images.unsplash.com/photo-1532619187608-e5375cab36aa?w=800');">
                                        <span class="pp-category">Art</span></div>
                                    <div class="pp-card-body">
                                        <div class="pp-byline"><span class="pp-avatar-sm">VN</span><span>Vera Nasser · 2d
                                                ago</span></div>
                                        <h2 class="pp-post-title">How to start making art when you're not an artist</h2>
                                        <p class="pp-excerpt">The hardest part is not skill — it is permission. A gentle
                                            guide to getting out of your own way.</p>
                                        <div class="pp-card-footer">
                                            <div class="d-flex gap-3"><span class="pp-meta"><i class="bi bi-heart"></i>
                                                    1.7k</span><span class="pp-meta"><i class="bi bi-chat"></i> 143</span>
                                            </div><a href="#" class="pp-read-more">Read <i
                                                    class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-md-6 col-xl-4">
                                <div class="pp-post-card">
                                    <div class="pp-cover"
                                        style="background-image:url('https://images.unsplash.com/photo-1507668077129-56e32842fceb?w=800');">
                                        <span class="pp-category">Business</span></div>
                                    <div class="pp-card-body">
                                        <div class="pp-byline"><span class="pp-avatar-sm">JD</span><span>Jordan Diaz · 2d
                                                ago</span></div>
                                        <h2 class="pp-post-title">Start small, stay small: a case for tiny businesses</h2>
                                        <p class="pp-excerpt">Why every venture does not need to be a unicorn. Sustainable,
                                            profitable, and yours forever.</p>
                                        <div class="pp-card-footer">
                                            <div class="d-flex gap-3"><span class="pp-meta"><i class="bi bi-heart"></i>
                                                    920</span><span class="pp-meta"><i class="bi bi-chat"></i> 61</span>
                                            </div><a href="#" class="pp-read-more">Read <i
                                                    class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-md-6 col-xl-4">
                                <div class="pp-post-card">
                                    <div class="pp-cover"
                                        style="background-image:url('https://images.unsplash.com/photo-1516302752625-fcc3c50ae61f?w=800');">
                                        <span class="pp-category">Health</span></div>
                                    <div class="pp-card-body">
                                        <div class="pp-byline"><span class="pp-avatar-sm">SW</span><span>Sam Wren · 3d
                                                ago</span></div>
                                        <h2 class="pp-post-title">Sleep faster: the 4 rituals I use every night</h2>
                                        <p class="pp-excerpt">No apps, no supplements. What a sleep researcher taught me
                                            about the brain's off-switch.</p>
                                        <div class="pp-card-footer">
                                            <div class="d-flex gap-3"><span class="pp-meta"><i class="bi bi-heart"></i>
                                                    450</span><span class="pp-meta"><i class="bi bi-chat"></i> 39</span>
                                            </div><a href="#" class="pp-read-more">Read <i
                                                    class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <article class="col-md-6 col-xl-4">
                                <div class="pp-post-card">
                                    <div class="pp-cover"
                                        style="background-image:url('https://images.unsplash.com/photo-1465101162946-4377e57745c3?w=800');">
                                        <span class="pp-category">Science</span></div>
                                    <div class="pp-card-body">
                                        <div class="pp-byline"><span class="pp-avatar-sm">MK</span><span>Dr. Mika K. · 4d
                                                ago</span></div>
                                        <h2 class="pp-post-title">The Hubble legacy in 5 breathtaking photos</h2>
                                        <p class="pp-excerpt">Thirty years of looking outward, and how one telescope rewrote
                                            what we thought we knew about the universe.</p>
                                        <div class="pp-card-footer">
                                            <div class="d-flex gap-3"><span class="pp-meta"><i class="bi bi-heart"></i>
                                                    2.0k</span><span class="pp-meta"><i class="bi bi-chat"></i> 178</span>
                                            </div><a href="#" class="pp-read-more">Read <i
                                                    class="bi bi-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </article> --}}
                        </div>
                        <nav class="d-flex justify-content-center align-items-center gap-2 mt-5 flex-wrap"
                            aria-label="Post pagination">
                            <a href="#" class="pp-page-btn"><i class="bi bi-chevron-left"></i></a>
                            <a href="#" class="pp-page-btn is-active">1</a>
                            <a href="#" class="pp-page-btn">2</a>
                            <a href="#" class="pp-page-btn">3</a>
                            <a href="#" class="pp-page-btn">4</a>
                            <span class="pp-muted px-2">...</span>
                            <a href="#" class="pp-page-btn">28</a>
                            <a href="#" class="pp-page-btn"><i class="bi bi-chevron-right"></i></a>
                        </nav>
                    </div>

                    <aside class="col-lg-4">
                        <div class="d-flex flex-column gap-4 sticky-top" style="top:90px;">
                            <div class="pp-sidebar-card pp-newsletter">
                                <h2 class="pp-sidebar-title"><i class="bi bi-envelope-paper-heart pp-accent"></i> Weekly
                                    Letter</h2>
                                <p class="pp-muted mb-3" style="font-size:.86rem;line-height:1.55;">Get the three best posts
                                    of the week, hand-picked. No spam, unsubscribe anytime.</p>
                                <div class="d-flex gap-2"><input type="email"
                                        class="form-control form-control-sm flex-grow-1"
                                        placeholder="your@email.com"><button class="pp-btn-accent"
                                        type="button">Join</button></div>
                            </div>
                            <div class="pp-sidebar-card">
                                <h2 class="pp-sidebar-title"><i class="bi bi-fire pp-accent"></i> Trending Now</h2>
                                <div class="pp-trend"><span class="pp-trend-num">01</span>
                                    <div>
                                        <p class="pp-trend-title">Why I left my Big Tech job after 7 years</p>
                                        <div class="pp-trend-meta">8.4k reads · today</div>
                                    </div>
                                </div>
                                <div class="pp-trend"><span class="pp-trend-num">02</span>
                                    <div>
                                        <p class="pp-trend-title">A short letter to the person I used to be</p>
                                        <div class="pp-trend-meta">6.1k reads · yesterday</div>
                                    </div>
                                </div>
                                <div class="pp-trend"><span class="pp-trend-num">03</span>
                                    <div>
                                        <p class="pp-trend-title">How I built an AI tool in public</p>
                                        <div class="pp-trend-meta">4.8k reads · 2d ago</div>
                                    </div>
                                </div>
                                <div class="pp-trend"><span class="pp-trend-num">04</span>
                                    <div>
                                        <p class="pp-trend-title">The unglamorous truth about building in public</p>
                                        <div class="pp-trend-meta">3.9k reads · 3d ago</div>
                                    </div>
                                </div>
                                <div class="pp-trend"><span class="pp-trend-num">05</span>
                                    <div>
                                        <p class="pp-trend-title">Cooking through my grandmother's notebook</p>
                                        <div class="pp-trend-meta">2.7k reads · 4d ago</div>
                                    </div>
                                </div>
                            </div>
                            <div class="pp-sidebar-card">
                                <h2 class="pp-sidebar-title"><i class="bi bi-hash pp-accent"></i> Popular Tags</h2>
                                <div class="d-flex flex-wrap gap-2"><span class="pp-tag">#writing</span><span
                                        class="pp-tag">#life</span><span class="pp-tag">#tech</span><span
                                        class="pp-tag">#design</span><span class="pp-tag">#travel</span><span
                                        class="pp-tag">#health</span><span class="pp-tag">#productivity</span><span
                                        class="pp-tag">#books</span><span class="pp-tag">#art</span><span
                                        class="pp-tag">#food</span><span class="pp-tag">#startups</span><span
                                        class="pp-tag">#ai</span></div>
                            </div>
                            <div class="pp-sidebar-card text-center">
                                <h2 class="pp-sidebar-title mb-2"><span class="pp-accent">Ink</span>well</h2>
                                <p class="pp-muted mb-3" style="font-size:.84rem;line-height:1.55;">A quiet corner of the
                                    internet for thoughtful writing. Built by readers, for readers.</p>
                                <div class="d-flex justify-content-center gap-2"><a class="pp-icon-btn" href="#"><i
                                            class="bi bi-twitter-x"></i></a><a class="pp-icon-btn" href="#"><i
                                            class="bi bi-instagram"></i></a><a class="pp-icon-btn" href="#"><i
                                            class="bi bi-rss"></i></a></div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </section>
    </main>
    <!-- ==================== END @yield('content') ==================== -->
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/explore.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/explore.js') }}"></script>
@endpush