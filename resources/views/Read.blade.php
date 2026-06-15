@extends('layouts.Home')
@section('content')
    <!-- ==================== PAGE CONTENT (goes inside @yield('content')) ==================== -->

    <!-- Reading Progress Bar -->
    <div class="reading-progress"></div>

    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="bi bi-house-fill"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Blog</a></li>
                    <li class="breadcrumb-item"><a href="#">Architecture</a></li>
                    <li class="breadcrumb-item active" aria-current="page">The Art of Modern Architecture</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container py-4">
        <div class="row g-4">

            <!-- ── Article Column ── -->
            <div class="col-lg-8">

                <!-- Hero Image -->
                <div class="hero-image-wrap">
                    @php
                        $featured = $posts->getFirstMediaUrl('featured_image');
                        $featured = $featured ?: 'https://images.pexels.com/photos/5002996/pexels-photo-5002996.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=627&w=1200';
                        $additional = $posts->getMedia('additional_images');

                        // Merge featured + additional into one array for the carousel
                        $allImages = collect([$featured])->merge($additional->map(fn($img) => $img->getUrl()));
                    @endphp

                    @if($allImages->count() > 1)
                        {{-- Carousel if there are additional images --}}
                        <div id="postCarousel" class="carousel slide h-100" data-bs-ride="carousel">
                            <div class="carousel-inner h-100">
                                @foreach($allImages as $index => $url)
                                    @php $encodedUrl = str_replace(['(', ')'], ['%28', '%29'], $url); @endphp
                                    <div class="carousel-item h-100 {{ $index === 0 ? 'active' : '' }}">
                                        <img src="{{ $encodedUrl }}" class="d-block w-100 h-100" style="object-fit: cover;"
                                            alt="Post image {{ $index + 1 }}">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#postCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#postCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>
                    @else
                        {{-- Single image, same as before --}}
                        @php $encodedUrl = str_replace(['(', ')'], ['%28', '%29'], $featured); @endphp
                        <img src="{{ $encodedUrl }}" alt="Post image">
                    @endif

                    <div class="hero-overlay">
                        <span class="badge-cat">{{ $posts->categories->first()->name }}</span>
                    </div>
                </div>

                <!-- Article Header -->
                <article class="mt-4">
                    <h1 class="article-title">{{ $posts->title }}</h1>
                    <p class="article-subtitle">{{ $posts->Description }}</p>

                    <!-- Author Bar -->
                    <div class="author-bar">
                        <img src="https://images.pexels.com/photos/28442318/pexels-photo-28442318.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                            alt="Marcus Chen">
                        <div class="author-info">
                            <div class="author-name">{{ $posts->author }}</div>
                            <div class="author-meta">Senior Architecture Correspondent</div>
                        </div>
                        <div class="meta-right">
                            <span><i class="bi bi-calendar3"></i> {{ $posts->created_at->format('M d, Y') }}</span>
                            <span><i class="bi bi-clock"></i> {{ $posts->reading_time }} min read</span>
                            <span><i class="bi bi-eye"></i> {{ $posts->views }} views</span>
                            <span><i class="bi bi-chat-dots"></i> {{ $posts->comments->count() + $posts->comments->sum(fn($c) => $c->replies->count()) }}</span>
                        </div>
                    </div>

                    <!-- Reactions -->
                    <div class="reactions-bar">
                        <span class="reaction-btn"><span class="emoji">❤️</span> 247</span>
                        <span class="reaction-btn"><span class="emoji">👏</span> 89</span>
                        <span class="reaction-btn"><span class="emoji">💡</span> 56</span>
                        <span class="reaction-btn"><span class="emoji">🔥</span> 34</span>
                    </div>

                    <!-- Article Body -->
                    <div class="article-content">
                        {!! $posts->body !!}
                        {{--
                        <p>Architecture is far more than the construction of buildings — it is the art of shaping human
                            experience through space, light, and material. In an era of rapid urbanization and climate
                            change, modern architecture stands at a pivotal crossroads where innovation must meet
                            responsibility.</p>

                        <p>From the soaring glass towers of Shanghai to the sustainable micro-homes of Scandinavia,
                            architects around the world are reimagining what it means to create spaces that serve both
                            people and planet. This article explores the key movements, technologies, and philosophies
                            driving the future of architectural design.</p>

                        <h2 id="section-1">The Evolution of Architectural Thought</h2>

                        <p>Modern architecture didn't emerge overnight. It evolved through centuries of experimentation,
                            cultural shifts, and technological breakthroughs. The transition from classical ornamentation to
                            modernist minimalism in the early 20th century marked one of the most profound shifts in design
                            philosophy.</p>

                        <p>Pioneers like Le Corbusier, Ludwig Mies van der Rohe, and Frank Lloyd Wright challenged
                            conventional ideas about form, function, and the relationship between buildings and their
                            environment. Their legacy continues to influence architects today, though contemporary
                            practitioners are pushing boundaries even further.</p>

                        <blockquote>
                            "Architecture is the learned game, correct and magnificent, of forms assembled in the light. Our
                            eyes are made to see forms in light; light and shade reveal these forms."
                            <cite>— Le Corbusier</cite>
                        </blockquote>

                        <p>The post-modern era brought renewed appreciation for context, narrative, and cultural identity in
                            architecture. Today, we see a synthesis of these movements — buildings that are simultaneously
                            functional, beautiful, culturally resonant, and environmentally conscious.</p>

                        <h2 id="section-2">Sustainable Design: Building for Tomorrow</h2>

                        <p>Perhaps the most significant shift in contemporary architecture is the embrace of sustainability
                            as a core design principle rather than an afterthought. Green building isn't just a trend — it's
                            becoming the standard by which all new construction is measured.</p>

                        <img src="https://images.pexels.com/photos/33022916/pexels-photo-33022916.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=627&w=1200"
                            alt="Modern sustainable building" class="img-fluid w-100">
                        <p class="img-caption">A modern residential complex demonstrating passive solar design principles in
                            urban settings.</p>

                        <div class="highlight-box">
                            <h4><i class="bi bi-lightbulb-fill"></i> Key Sustainability Metrics in Modern Architecture</h4>
                            <ul>
                                <li><strong>Net-Zero Energy:</strong> Buildings that produce as much energy as they consume
                                    annually</li>
                                <li><strong>Biophilic Design:</strong> Incorporating natural elements to improve occupant
                                    wellbeing</li>
                                <li><strong>Circular Materials:</strong> Using recycled and recyclable building materials
                                </li>
                                <li><strong>Water Neutrality:</strong> Rainwater harvesting and greywater recycling systems
                                </li>
                                <li><strong>Adaptive Reuse:</strong> Repurposing existing structures rather than demolishing
                                    them</li>
                            </ul>
                        </div>

                        <p>Leading firms like Bjarke Ingels Group (BIG), Heatherwick Studio, and Kengo Kuma & Associates are
                            demonstrating that sustainability and stunning design aren't mutually exclusive. Their projects
                            prove that environmentally responsible buildings can also be the most visually compelling.</p>

                        <h2 id="section-3">Technology's Role in Shaping Space</h2>

                        <p>Digital technology has revolutionized every aspect of architectural practice, from initial
                            conceptualization to final construction. Building Information Modeling (BIM), parametric design,
                            and computational analysis allow architects to explore forms and solutions that would have been
                            impossible just decades ago.</p>

                        <h3>Parametric Design and Generative Architecture</h3>

                        <p>Parametric design uses algorithms and data-driven processes to generate complex geometries and
                            optimize structural performance. Firms like Zaha Hadid Architects have made this approach
                            iconic, creating flowing, organic forms that seem to defy conventional construction logic.</p>

                        <img src="https://images.pexels.com/photos/19381902/pexels-photo-19381902.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=627&w=1200"
                            alt="Geometric modern building facade" class="img-fluid w-100">
                        <p class="img-caption">Parametric facade patterns create dynamic visual effects while optimizing
                            natural light penetration.</p>

                        <h3>3D Printing and Robotic Construction</h3>

                        <p>The emergence of large-scale 3D printing technology is beginning to disrupt traditional
                            construction methods. Companies are now printing entire houses in a matter of days, dramatically
                            reducing waste, labor costs, and construction timelines. Robotic fabrication is enabling
                            intricate brick-laying patterns and complex timber joinery that would take human workers weeks
                            to complete.</p>

                        <p>While these technologies are still maturing, their potential to address housing shortages, reduce
                            construction waste, and enable new aesthetic possibilities is immense.</p>

                        <h2 id="section-4">The Human Element: Designing for Wellbeing</h2>

                        <p>As our understanding of environmental psychology deepens, architects are increasingly designing
                            for human wellbeing. Research consistently shows that the spaces we inhabit profoundly affect
                            our mental health, productivity, creativity, and social connections.</p>

                        <blockquote>
                            "We shape our buildings, and afterwards our buildings shape us."
                            <cite>— Winston Churchill</cite>
                        </blockquote>

                        <p>The WELL Building Standard and similar frameworks are formalizing these insights, providing
                            measurable criteria for designing spaces that support physical and mental health. Key
                            considerations include:</p>

                        <ol>
                            <li><strong>Natural Light Optimization:</strong> Maximizing daylight exposure to support
                                circadian rhythms and reduce energy consumption</li>
                            <li><strong>Acoustic Comfort:</strong> Managing sound environments to reduce stress and improve
                                concentration</li>
                            <li><strong>Air Quality:</strong> Advanced ventilation and filtration systems for healthier
                                indoor environments</li>
                            <li><strong>Thermal Comfort:</strong> Intelligent climate control that adapts to occupant
                                preferences</li>
                            <li><strong>Biophilic Elements:</strong> Integration of plants, water features, and natural
                                materials</li>
                        </ol>

                        <h2 id="section-5">Cultural Identity and Contextual Design</h2>

                        <p>In a globalized world, there's a growing tension between universal design principles and local
                            cultural identity. The best contemporary architects navigate this tension skillfully, creating
                            buildings that are unmistakably modern yet deeply rooted in their cultural and geographic
                            context.</p>

                        <img src="https://images.pexels.com/photos/33643463/pexels-photo-33643463.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=627&w=1200"
                            alt="City skyline architecture" class="img-fluid w-100">
                        <p class="img-caption">Urban skylines tell the story of a city's cultural evolution through
                            architectural language.</p>

                        <p>Projects like the Elbphilharmonie in Hamburg, the Louvre Abu Dhabi, and the National Museum of
                            African American History and Culture in Washington demonstrate how architecture can honor
                            tradition while embracing innovation. These buildings serve not just as functional spaces but as
                            cultural landmarks that define identity and inspire community pride.</p>

                        <h2 id="section-6">Looking Forward: The Next Decade</h2>

                        <p>As we look ahead, several trends are poised to reshape the architectural landscape:</p>

                        <div class="highlight-box">
                            <h4><i class="bi bi-rocket-takeoff-fill"></i> Emerging Trends to Watch</h4>
                            <ul>
                                <li><strong>Mass Timber Construction:</strong> Engineered wood products enabling taller,
                                    more sustainable buildings</li>
                                <li><strong>Living Architecture:</strong> Buildings integrated with living organisms for air
                                    purification and insulation</li>
                                <li><strong>Digital Twins:</strong> Virtual replicas of buildings for ongoing optimization
                                    and maintenance</li>
                                <li><strong>Climate Adaptive Design:</strong> Structures that actively respond to changing
                                    weather patterns</li>
                                <li><strong>Community-Centered Planning:</strong> Participatory design processes that give
                                    residents voice in shaping their environments</li>
                            </ul>
                        </div>

                        <p>The challenges facing architecture are immense — climate change, urbanization, inequality, and
                            rapidly shifting social needs demand creative, responsible, and inclusive solutions. But the
                            tools, knowledge, and ambition within the profession have never been greater.</p>

                        <p>Architecture, at its best, is an act of optimism. Every new building is a statement of faith in
                            the future — a belief that through thoughtful design, we can create spaces that elevate the
                            human experience and honor the natural world that sustains us all.</p> --}}

                    </div>

                    <!-- Tags -->
                    <div class="tags-section">
                        <span style="font-weight:600; font-size:.9rem; color:var(--text2); margin-right:.5rem;"><i
                                class="bi bi-tags-fill" style="color:var(--accent)"></i> Tags: </span>
                        @foreach($posts->tags as $tag)
                            <a href="#" class="tag-pill">
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </div>

                    <!-- Share Bar -->
                    <div class="share-bar">
                        <span class="share-label"><i class="bi bi-share-fill" style="color:var(--accent)"></i> Share:</span>
                        {{-- <a href="#" class="share-btn" title="Twitter"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="share-btn" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="share-btn" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="share-btn" title="Reddit"><i class="bi bi-reddit"></i></a>
                        <a href="#" class="share-btn" title="Copy Link"><i class="bi bi-link-45deg"></i></a>
                        <a href="#" class="share-btn" title="Bookmark"><i class="bi bi-bookmark"></i></a> --}}
                        {{-- Share Buttons --}}
                        @if($posts->show_share_buttons)
                            @php
                                $url = urlencode(route('read', $posts->slug));
                                $title = urlencode($posts->title);
                            @endphp
                            <a href="https://twitter.com/intent/tweet?url={{ $url }}&text={{ $title }}"
                                target="_blank" class="share-btn"><i class="bi bi-twitter-x"></i></a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank" class="share-btn"><i class="bi bi-facebook"></i></a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $url }}"
                                target="_blank" class="share-btn"><i class="bi bi-linkedin"></i></a>
                            <a href="https://wa.me/?text={{ $title }}%20{{ $url }}" target="_blank" class="share-btn"><i class="bi bi-whatsapp"></i></a>
                        @endif
                    </div>

                    <!-- Author Bio Card -->
                    <div class="author-bio-card">
                        <div class="d-flex gap-3 align-items-start flex-wrap">
                            <img src="https://images.pexels.com/photos/28442318/pexels-photo-28442318.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                                alt="Marcus Chen">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <span class="bio-name">Marcus Chen</span>
                                    <span class="bio-role">Senior Architecture Correspondent</span>
                                </div>
                                <p class="bio-text mt-2 mb-2">Marcus is an award-winning architecture journalist with over
                                    15 years of experience covering design, urban planning, and sustainable building
                                    practices. He has written for Architectural Digest, Dezeen, and The Guardian, and has
                                    visited over 200 significant architectural sites across 40 countries.</p>
                                <div class="d-flex gap-2">
                                    <a href="#" class="social-link" title="Twitter"><i class="bi bi-twitter-x"></i></a>
                                    <a href="#" class="social-link" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                                    <a href="#" class="social-link" title="Website"><i class="bi bi-globe2"></i></a>
                                    <a href="#" class="social-link" title="Email"><i class="bi bi-envelope"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Prev / Next Article Nav -->
                    <div class="row g-3 my-3">
                        <div class="col-sm-6">
                            <a href="#" class="d-block p-3 rounded-3"
                                style="background:var(--surface); border:1px solid var(--border); text-decoration:none; transition:all .2s;">
                                <small style="color:var(--text2);"><i class="bi bi-arrow-left"></i> Previous Article</small>
                                <div
                                    style="font-weight:600; font-size:.92rem; color:var(--text); margin-top:.25rem; line-height:1.4;">
                                    Reimagining Public Spaces in a Post-Pandemic World</div>
                            </a>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <a href="#" class="d-block p-3 rounded-3"
                                style="background:var(--surface); border:1px solid var(--border); text-decoration:none; transition:all .2s;">
                                <small style="color:var(--text2);">Next Article <i class="bi bi-arrow-right"></i></small>
                                <div
                                    style="font-weight:600; font-size:.92rem; color:var(--text); margin-top:.25rem; line-height:1.4;">
                                    Why Mass Timber is the Future of Skyscrapers</div>
                            </a>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    @if($posts->enable_comments)
                        <div class="comments-section">
                            <div class="section-title">
                                <i class="bi bi-chat-square-text-fill"></i> Comments ({{ $posts->comments->count() + $posts->comments->sum(fn($c) => $c->replies->count())  }})
                            </div>

                            @auth
                                {{-- Comments List --}}
                                @forelse($posts->comments as $comment)
                                    <div class="comment-item">
                                        <img src="https://images.pexels.com/photos/33799456/pexels-photo-33799456.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                                            alt="{{ $comment->user->name }}">
                                        <div class="flex-grow-1">
                                            <div>
                                                <span class="comment-author">{{ $comment->user->name }}</span>
                                                @if($comment->Fk_userId === $posts->Fk_userId)
                                                    <span
                                                        style="font-size:.7rem; background:var(--accent); color:var(--bg); padding:.15rem .5rem; border-radius:10px; font-weight:600; margin-left:.35rem;">Author</span>
                                                @endif
                                                <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>

                                                @if(auth()->id() === $comment->Fk_userId)
                                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST"
                                                        class="d-inline ms-2">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-link text-danger p-0"
                                                            onclick="return confirm('Delete this comment?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>

                                            <p class="comment-text">{{ $comment->body }}</p>

                                            <div class="comment-actions">
                                                <a href="#" onclick="toggleReplyForm({{ $comment->id }}); return false;">
                                                    <i class="bi bi-reply"></i> Reply
                                                </a>
                                            </div>

                                            {{-- Inline Reply Form --}}
                                            <div id="reply-form-{{ $comment->id }}" style="display:none;" class="mt-3">
                                                <form action="{{ route('comments.reply', $comment) }}" method="POST">
                                                    @csrf
                                                    <div class="row g-2">
                                                        <div class="col-12">
                                                            <textarea class="form-control" name="body" rows="2"
                                                                placeholder="Write a reply..." required></textarea>
                                                        </div>
                                                        <div class="col-12">
                                                            <button type="submit" class="btn-accent btn-sm">
                                                                <i class="bi bi-send-fill"></i> Post Reply
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-link"
                                                                onclick="toggleReplyForm({{ $comment->id }})">Cancel</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            {{-- Replies --}}
                                            @foreach($comment->replies as $reply)
                                                <div class="comment-reply mt-3">
                                                    <div class="comment-item" style="border-bottom:none; padding-bottom:0;">
                                                        <img src="https://images.pexels.com/photos/28442318/pexels-photo-28442318.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                                                            alt="{{ $reply->user->name }}">
                                                        <div>
                                                            <span class="comment-author">{{ $reply->user->name }}</span>
                                                            @if($reply->Fk_userId === $posts->Fk_userId)
                                                                <span
                                                                    style="font-size:.7rem; background:var(--accent); color:var(--bg); padding:.15rem .5rem; border-radius:10px; font-weight:600; margin-left:.35rem;">Author</span>
                                                            @endif
                                                            <span class="comment-date">{{ $reply->created_at->diffForHumans() }}</span>

                                                            @if(auth()->id() === $reply->Fk_userId)
                                                                <form action="{{ route('comments.destroy', $reply) }}" method="POST"
                                                                    class="d-inline ms-2">
                                                                    @csrf @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-link text-danger p-0"
                                                                        onclick="return confirm('Delete this reply?')">
                                                                        <i class="bi bi-trash"></i>
                                                                    </button>
                                                                </form>
                                                            @endif

                                                            <p class="comment-text">{{ $reply->body }}</p>
                                                            <div class="comment-actions">
                                                                <a href="#" onclick="toggleReplyForm({{ $comment->id }}); return false;">
                                                                    <i class="bi bi-reply"></i> Reply
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted">No comments yet. Be the first to comment!</p>
                                @endforelse

                                {{-- Comment Form --}}
                                <div class="comment-form">
                                    <h6 style="font-weight:700; margin-bottom:1rem; color:var(--text);">
                                        <i class="bi bi-pencil-square" style="color:var(--accent)"></i> Leave a Comment
                                    </h6>
                                    <form action="{{ route('comments.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $posts->id }}">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <textarea class="form-control" name="body" rows="4"
                                                    placeholder="Write your comment..." required>{{ old('body') }}</textarea>
                                                @error('body') <small class="text-danger">{{ $message }}</small> @enderror
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn-accent">
                                                    <i class="bi bi-send-fill"></i> Post Comment
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            @else
                                <p>Please <a href="{{ route('login') }}">log in</a> to view and post comments.</p>
                            @endauth
                        </div>

                        <script>
                            function toggleReplyForm(id) {
                                const form = document.getElementById('reply-form-' + id);
                                form.style.display = form.style.display === 'none' ? 'block' : 'none';
                            }
                        </script>
                    @endif

                </article>
            </div>

            <!-- ── Sidebar Column ── -->
            <div class="col-lg-4">
                <div class="sidebar-sticky">

                    <!-- Table of Contents -->
                    <div class="sidebar-card">
                        <div class="card-heading"><i class="bi bi-list-ul"></i> Table of Contents</div>
                        <ul class="toc-list">
                            {{-- <li class="active"><a href="#section-1">The Evolution of Architectural Thought</a></li>
                            <li><a href="#section-2">Sustainable Design: Building for Tomorrow</a></li>
                            <li><a href="#section-3">Technology's Role in Shaping Space</a></li>
                            <li><a href="#section-4">The Human Element: Designing for Wellbeing</a></li>
                            <li><a href="#section-5">Cultural Identity and Contextual Design</a></li>
                            <li><a href="#section-6">Looking Forward: The Next Decade</a></li> --}}
                            {{-- Table of Contents --}}
                            @if($posts->table_of_contents)
                            
                                @php
                                    preg_match_all('/<h([1-3])[^>]*id="([^"]*)"[^>]*>(.*?)<\/h[1-3]>/i', $posts->body, $matches, PREG_SET_ORDER);
                                @endphp
                                @if(!empty($matches))
                                    @foreach($matches as $match)
                                        <li style="padding-left: {{ (intval($match[1]) - 1) }}rem">
                                            <a href="#{{ $match[2] }}">{{ strip_tags($match[3]) }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            @endif
                        </ul>
                    </div>

                    <!-- Popular Posts -->
                    <div class="sidebar-card">
                        <div class="card-heading"><i class="bi bi-fire"></i> Popular Posts</div>
                        <div class="related-mini">
                            <img src="https://images.pexels.com/photos/33643463/pexels-photo-33643463.jpeg?auto=compress&cs=tinysrgb&dpr=1&fit=crop&h=200&w=280"
                                alt="">
                            <div>
                                <div class="rm-title">How Smart Cities Are Redefining Urban Infrastructure</div>
                                <div class="rm-date"><i class="bi bi-clock"></i> Nov 28, 2025</div>
                            </div>
                        </div>
                        <div class="related-mini">
                            <img src="https://images.pexels.com/photos/34140/pexels-photo.jpg?auto=compress&cs=tinysrgb&dpr=1&fit=crop&h=200&w=280"
                                alt="">
                            <div>
                                <div class="rm-title">The Rise of Digital Nomad-Friendly Workspaces</div>
                                <div class="rm-date"><i class="bi bi-clock"></i> Nov 12, 2025</div>
                            </div>
                        </div>
                        <div class="related-mini">
                            <img src="https://images.pexels.com/photos/7504746/pexels-photo-7504746.jpeg?auto=compress&cs=tinysrgb&dpr=1&fit=crop&h=200&w=280"
                                alt="">
                            <div>
                                <div class="rm-title">Computational Design: When Algorithms Meet Aesthetics</div>
                                <div class="rm-date"><i class="bi bi-clock"></i> Oct 30, 2025</div>
                            </div>
                        </div>
                        <div class="related-mini">
                            <img src="https://images.pexels.com/photos/33022916/pexels-photo-33022916.jpeg?auto=compress&cs=tinysrgb&dpr=1&fit=crop&h=200&w=280"
                                alt="">
                            <div>
                                <div class="rm-title">Passive House Standard: The Gold Standard of Efficiency</div>
                                <div class="rm-date"><i class="bi bi-clock"></i> Oct 15, 2025</div>
                            </div>
                        </div>
                    </div>

                    <!-- Newsletter -->
                    <div class="sidebar-card newsletter-card">
                        <div class="card-heading"><i class="bi bi-envelope-paper-fill"></i> Newsletter</div>
                        <p>Get the latest architecture insights delivered to your inbox every week. Join 12,000+ readers.
                        </p>
                        <div class="mb-2">
                            <input type="email" class="form-control" placeholder="Enter your email">
                        </div>
                        <button class="btn-accent w-100"><i class="bi bi-send-fill"></i> Subscribe</button>
                        <small class="d-block mt-2" style="color:var(--text2); font-size:.75rem;">No spam. Unsubscribe
                            anytime.</small>
                    </div>

                    <!-- Categories -->
                    <div class="sidebar-card">
                        <div class="card-heading"><i class="bi bi-folder2-open"></i> Categories</div>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="#" class="tag-pill">Architecture <span style="color:var(--accent)">24</span></a>
                            <a href="#" class="tag-pill">Sustainability <span style="color:var(--accent)">18</span></a>
                            <a href="#" class="tag-pill">Technology <span style="color:var(--accent)">15</span></a>
                            <a href="#" class="tag-pill">Urban Design <span style="color:var(--accent)">12</span></a>
                            <a href="#" class="tag-pill">Interiors <span style="color:var(--accent)">9</span></a>
                            <a href="#" class="tag-pill">History <span style="color:var(--accent)">7</span></a>
                            <a href="#" class="tag-pill">Innovation <span style="color:var(--accent)">11</span></a>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Related Posts Grid -->
        <section class="related-section">
            <div class="section-title"><i class="bi bi-grid-3x3-gap-fill"></i> Related Articles</div>
            <div class="row g-4">
                <div class="col-md-4">
                    <a href="#" class="related-card d-block" style="text-decoration:none;">
                        <img src="https://images.pexels.com/photos/33022916/pexels-photo-33022916.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=627&w=1200"
                            alt="">
                        <div class="rc-body">
                            <div class="rc-cat">Sustainability</div>
                            <div class="rc-title">Net-Zero Buildings: From Concept to Reality in 2026</div>
                            <div class="rc-meta"><i class="bi bi-calendar3"></i> Dec 10, 2025 · <i class="bi bi-clock"></i>
                                8 min</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="related-card d-block" style="text-decoration:none;">
                        <img src="https://images.pexels.com/photos/7504746/pexels-photo-7504746.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=627&w=1200"
                            alt="">
                        <div class="rc-body">
                            <div class="rc-cat">Technology</div>
                            <div class="rc-title">How AI Is Transforming Architectural Design Workflows</div>
                            <div class="rc-meta"><i class="bi bi-calendar3"></i> Dec 5, 2025 · <i class="bi bi-clock"></i>
                                10 min</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="#" class="related-card d-block" style="text-decoration:none;">
                        <img src="https://images.pexels.com/photos/19381902/pexels-photo-19381902.jpeg?auto=compress&cs=tinysrgb&fit=crop&h=627&w=1200"
                            alt="">
                        <div class="rc-body">
                            <div class="rc-cat">Urban Design</div>
                            <div class="rc-title">The 15-Minute City: Rethinking Urban Mobility and Access</div>
                            <div class="rc-meta"><i class="bi bi-calendar3"></i> Nov 22, 2025 · <i class="bi bi-clock"></i>
                                7 min</div>
                        </div>
                    </a>
                </div>
            </div>
        </section>

    </main>

    <!-- ==================== END @yield('content') ==================== -->
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/read.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/read.js') }}"></script>
@endpush