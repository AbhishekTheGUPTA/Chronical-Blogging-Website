@extends('layouts.DashboardLayout')
@section('content')

    <!-- CONTENT -->
    <main class="content">
        <h1 class="page-title">Good morning, {{ auth()->user()->name }}</h1>
        <p class="page-sub">Here's what's happening with your publication today.</p>

        <!-- STATS -->
        <div class="row g-3 mb-4">
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card-x">
                    <div class="stat-icon"><i class="bi bi-eye"></i></div>
                    <div class="stat-value">84.2k</div>
                    <div class="stat-label">Total Views</div>
                    <div class="stat-trend trend-up mt-2"><i class="bi bi-arrow-up-right"></i> 12.5% this week</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card-x">
                    <div class="stat-icon"><i class="bi bi-file-earmark-text"></i></div>
                    <div class="stat-value">128</div>
                    <div class="stat-label">Published Posts</div>
                    <div class="stat-trend trend-up mt-2"><i class="bi bi-arrow-up-right"></i> 6 new this week</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card-x">
                    <div class="stat-icon"><i class="bi bi-chat-square-dots"></i></div>
                    <div class="stat-value">1,204</div>
                    <div class="stat-label">Comments</div>
                    <div class="stat-trend trend-up mt-2"><i class="bi bi-arrow-up-right"></i> 8.1% this week</div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card-x">
                    <div class="stat-icon"><i class="bi bi-people"></i></div>
                    <div class="stat-value">9,860</div>
                    <div class="stat-label">Subscribers</div>
                    <div class="stat-trend trend-down mt-2"><i class="bi bi-arrow-down-right"></i> 1.2% this week</div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <!-- CHART -->
            <div class="col-12 col-xl-8">
                <div class="card-x">
                    <div class="section-head">
                        <div>
                            <h4>Traffic Overview</h4>
                            <span style="color:var(--text2);font-size:.82rem;">Page views vs. unique visitors</span>
                        </div>
                        <div class="chip-group">
                            <button class="chip">Day</button>
                            <button class="chip active">Week</button>
                            <button class="chip">Month</button>
                        </div>
                    </div>

                    <!-- Summary metrics -->
                    <div class="chart-summary">
                        <div class="cs-item">
                            <div class="cs-val">84,210</div>
                            <div class="cs-lbl"><span class="legend-swatch" style="background:var(--accent)"></span> Page
                                Views <span class="cs-delta trend-up">+12.5%</span></div>
                        </div>
                        <div class="cs-item">
                            <div class="cs-val">31,408</div>
                            <div class="cs-lbl"><span class="legend-swatch" style="background:#60a5fa"></span> Unique
                                Visitors <span class="cs-delta trend-up">+8.2%</span></div>
                        </div>
                        <div class="cs-item">
                            <div class="cs-val">3m 42s</div>
                            <div class="cs-lbl"><i class="bi bi-clock-history"></i> Avg. Time <span
                                    class="cs-delta trend-up">+4.1%</span></div>
                        </div>
                        <div class="cs-item">
                            <div class="cs-val">38.6%</div>
                            <div class="cs-lbl"><i class="bi bi-arrow-repeat"></i> Bounce Rate <span
                                    class="cs-delta trend-down">-2.3%</span></div>
                        </div>
                    </div>

                    <!-- SVG Chart -->
                    <div class="chart-wrap" id="chartWrap">
                        <div class="chart-tip" id="chartTip"></div>
                        <svg class="chart-svg" viewBox="0 0 700 240" preserveAspectRatio="none" id="trafficSvg">
                            <defs>
                                <linearGradient id="fillViews" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="var(--accent)" stop-opacity="0.35" />
                                    <stop offset="100%" stop-color="var(--accent)" stop-opacity="0" />
                                </linearGradient>
                                <linearGradient id="fillVisitors" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#60a5fa" stop-opacity="0.22" />
                                    <stop offset="100%" stop-color="#60a5fa" stop-opacity="0" />
                                </linearGradient>
                            </defs>

                            <!-- horizontal gridlines + y axis labels -->
                            <g class="chart-grid">
                                <line x1="38" y1="20" x2="690" y2="20" />
                                <line x1="38" y1="70" x2="690" y2="70" />
                                <line x1="38" y1="120" x2="690" y2="120" />
                                <line x1="38" y1="170" x2="690" y2="170" />
                                <line x1="38" y1="210" x2="690" y2="210" />
                            </g>
                            <g class="chart-axis-y" text-anchor="end">
                                <text x="30" y="24">16k</text>
                                <text x="30" y="74">12k</text>
                                <text x="30" y="124">8k</text>
                                <text x="30" y="174">4k</text>
                                <text x="30" y="214">0</text>
                            </g>

                            <!-- area fills -->
                            <path class="chart-area" fill="url(#fillViews)"
                                d="M38,150 L147,95 L256,165 L365,55 L474,110 L583,28 L690,72 L690,210 L38,210 Z" />
                            <path class="chart-area" fill="url(#fillVisitors)"
                                d="M38,180 L147,150 L256,190 L365,120 L474,160 L583,105 L690,140 L690,210 L38,210 Z" />

                            <!-- lines -->
                            <path class="chart-line line-views"
                                d="M38,150 L147,95 L256,165 L365,55 L474,110 L583,28 L690,72" />
                            <path class="chart-line line-visitors"
                                d="M38,180 L147,150 L256,190 L365,120 L474,160 L583,105 L690,140" />

                            <!-- data points -->
                            <g id="dots">
                                <circle class="dot dot-views" cx="38" cy="150" r="4" />
                                <circle class="dot dot-views" cx="147" cy="95" r="4" />
                                <circle class="dot dot-views" cx="256" cy="165" r="4" />
                                <circle class="dot dot-views" cx="365" cy="55" r="4" />
                                <circle class="dot dot-views" cx="474" cy="110" r="4" />
                                <circle class="dot dot-views" cx="583" cy="28" r="4" />
                                <circle class="dot dot-views" cx="690" cy="72" r="4" />
                                <circle class="dot dot-visitors" cx="38" cy="180" r="3.5" />
                                <circle class="dot dot-visitors" cx="147" cy="150" r="3.5" />
                                <circle class="dot dot-visitors" cx="256" cy="190" r="3.5" />
                                <circle class="dot dot-visitors" cx="365" cy="120" r="3.5" />
                                <circle class="dot dot-visitors" cx="474" cy="160" r="3.5" />
                                <circle class="dot dot-visitors" cx="583" cy="105" r="3.5" />
                                <circle class="dot dot-visitors" cx="690" cy="140" r="3.5" />
                            </g>

                            <!-- x axis labels -->
                            <g class="chart-axis-x" text-anchor="middle">
                                <text x="38" y="232">Mon</text>
                                <text x="147" y="232">Tue</text>
                                <text x="256" y="232">Wed</text>
                                <text x="365" y="232">Thu</text>
                                <text x="474" y="232">Fri</text>
                                <text x="583" y="232">Sat</text>
                                <text x="690" y="232">Sun</text>
                            </g>
                        </svg>
                    </div>

                    <div class="chart-legend">
                        <span class="li"><span class="sw" style="background:var(--accent)"></span> Page Views</span>
                        <span class="li"><span class="sw" style="background:#60a5fa"></span> Unique Visitors</span>
                    </div>
                </div>
            </div>

            <!-- ACTIVITY -->
            <div class="col-12 col-xl-4">
                <div class="card-x">
                    <div class="section-head">
                        <h4>Recent Activity</h4>
                    </div>
                    <div class="activity-item">
                        <div class="act-icon"><i class="bi bi-pencil"></i></div>
                        <div>
                            <div class="act-text">You published <b>"The Art of Slow Living"</b></div>
                            <div class="act-time">12 minutes ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="act-icon"><i class="bi bi-chat-dots"></i></div>
                        <div>
                            <div class="act-text">New comment from <b>Marcus T.</b></div>
                            <div class="act-time">1 hour ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="act-icon"><i class="bi bi-person-plus"></i></div>
                        <div>
                            <div class="act-text"><b>54 new subscribers</b> joined</div>
                            <div class="act-time">3 hours ago</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="act-icon"><i class="bi bi-heart"></i></div>
                        <div>
                            <div class="act-text">"Minimalism 101" hit <b>1k likes</b></div>
                            <div class="act-time">Yesterday</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="act-icon"><i class="bi bi-upload"></i></div>
                        <div>
                            <div class="act-text"><b>Liam</b> uploaded 8 media files</div>
                            <div class="act-time">Yesterday</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RECENT POSTS TABLE -->
            <div class="col-12 col-xl-8">
                <div class="card-x">
                    <div class="section-head">
                        <h4>Recent Posts <span id="filterTag"
                                style="display:none;font-family:'Inter',sans-serif;font-size:.8rem;font-weight:500;color:var(--accent);"></span>
                        </h4>
                        <a href="#" class="see-all">View all <i class="bi bi-arrow-right"></i></a>
                    </div>
                    <div class="table-responsive">
                        <table class="table-x">
                            <thead>
                                <tr>
                                    <th>Article</th>
                                    <th class="hide-sm">Status</th>
                                    <th class="hide-sm">Views</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="postsBody">
                                <tr data-cat="Lifestyle">
                                    <td>
                                        <div class="post-title-cell">
                                            <img class="post-thumb"
                                                src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=120&q=60"
                                                alt="">
                                            <div>
                                                <div class="pt">The Art of Slow Living</div>
                                                <div class="pc">Lifestyle</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hide-sm"><span class="pill pill-pub">Published</span></td>
                                    <td class="hide-sm">12.4k</td>
                                    <td>Mar 18</td>
                                    <td><button class="tbl-action"><i class="bi bi-three-dots"></i></button></td>
                                </tr>
                                <tr data-cat="Technology">
                                    <td>
                                        <div class="post-title-cell">
                                            <img class="post-thumb"
                                                src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=120&q=60"
                                                alt="">
                                            <div>
                                                <div class="pt">Writing for the Modern Web</div>
                                                <div class="pc">Technology</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hide-sm"><span class="pill pill-draft">Draft</span></td>
                                    <td class="hide-sm">—</td>
                                    <td>Mar 17</td>
                                    <td><button class="tbl-action"><i class="bi bi-three-dots"></i></button></td>
                                </tr>
                                <tr data-cat="Wellness">
                                    <td>
                                        <div class="post-title-cell">
                                            <img class="post-thumb"
                                                src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=120&q=60"
                                                alt="">
                                            <div>
                                                <div class="pt">Finding Calm in Nature</div>
                                                <div class="pc">Wellness</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hide-sm"><span class="pill pill-pub">Published</span></td>
                                    <td class="hide-sm">8.7k</td>
                                    <td>Mar 15</td>
                                    <td><button class="tbl-action"><i class="bi bi-three-dots"></i></button></td>
                                </tr>
                                <tr data-cat="Culture">
                                    <td>
                                        <div class="post-title-cell">
                                            <img class="post-thumb"
                                                src="https://images.unsplash.com/photo-1481349518771-20055b2a7b24?w=120&q=60"
                                                alt="">
                                            <div>
                                                <div class="pt">The Future of Reading</div>
                                                <div class="pc">Culture</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hide-sm"><span class="pill pill-review">In Review</span></td>
                                    <td class="hide-sm">—</td>
                                    <td>Mar 14</td>
                                    <td><button class="tbl-action"><i class="bi bi-three-dots"></i></button></td>
                                </tr>
                                <tr data-cat="Lifestyle">
                                    <td>
                                        <div class="post-title-cell">
                                            <img class="post-thumb"
                                                src="https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=120&q=60"
                                                alt="">
                                            <div>
                                                <div class="pt">Minimalism 101</div>
                                                <div class="pc">Lifestyle</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hide-sm"><span class="pill pill-pub">Published</span></td>
                                    <td class="hide-sm">21.0k</td>
                                    <td>Mar 11</td>
                                    <td><button class="tbl-action"><i class="bi bi-three-dots"></i></button></td>
                                </tr>
                                <tr data-cat="Technology">
                                    <td>
                                        <div class="post-title-cell">
                                            <img class="post-thumb"
                                                src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=120&q=60"
                                                alt="">
                                            <div>
                                                <div class="pt">Designing for Dark Mode</div>
                                                <div class="pc">Technology</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hide-sm"><span class="pill pill-pub">Published</span></td>
                                    <td class="hide-sm">15.2k</td>
                                    <td>Mar 09</td>
                                    <td><button class="tbl-action"><i class="bi bi-three-dots"></i></button></td>
                                </tr>
                                <tr data-cat="Travel">
                                    <td>
                                        <div class="post-title-cell">
                                            <img class="post-thumb"
                                                src="https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?w=120&q=60"
                                                alt="">
                                            <div>
                                                <div class="pt">Hidden Coastlines of Portugal</div>
                                                <div class="pc">Travel</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hide-sm"><span class="pill pill-pub">Published</span></td>
                                    <td class="hide-sm">9.4k</td>
                                    <td>Mar 07</td>
                                    <td><button class="tbl-action"><i class="bi bi-three-dots"></i></button></td>
                                </tr>
                                <tr data-cat="Wellness">
                                    <td>
                                        <div class="post-title-cell">
                                            <img class="post-thumb"
                                                src="https://images.unsplash.com/photo-1545205597-3d9d02c29597?w=120&q=60"
                                                alt="">
                                            <div>
                                                <div class="pt">The Morning Routine Reset</div>
                                                <div class="pc">Wellness</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hide-sm"><span class="pill pill-draft">Draft</span></td>
                                    <td class="hide-sm">—</td>
                                    <td>Mar 05</td>
                                    <td><button class="tbl-action"><i class="bi bi-three-dots"></i></button></td>
                                </tr>
                                <tr class="no-results" id="noResults" style="display:none;">
                                    <td colspan="5"><i class="bi bi-inbox"
                                            style="font-size:1.4rem;display:block;margin-bottom:.4rem;"></i>No posts found
                                        in this category.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- SIDE WIDGETS -->
            <div class="col-12 col-xl-4">
                <div class="card-x mb-3">
                    <div class="section-head">
                        <h4>Top Categories</h4>
                    </div>
                    <div id="catTags">
                        <span class="cat-tag active" data-cat="all">All <span class="n">128</span></span>
                        <span class="cat-tag" data-cat="Lifestyle">Lifestyle <span class="n">42</span></span>
                        <span class="cat-tag" data-cat="Technology">Technology <span class="n">31</span></span>
                        <span class="cat-tag" data-cat="Wellness">Wellness <span class="n">24</span></span>
                        <span class="cat-tag" data-cat="Culture">Culture <span class="n">18</span></span>
                        <span class="cat-tag" data-cat="Travel">Travel <span class="n">13</span></span>
                    </div>
                    <div class="divider"></div>
                    <div class="section-head">
                        <h4>Top Authors</h4>
                    </div>
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img class="avatar" src="https://i.pravatar.cc/80?img=32" alt="">
                        <div class="flex-grow-1">
                            <div style="font-weight:600;font-size:.9rem;">Marcus Reed</div>
                            <div style="color:var(--text2);font-size:.78rem;">38 articles</div>
                        </div>
                        <span class="pill pill-draft">★ 4.9</span>
                    </div>
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img class="avatar" src="https://i.pravatar.cc/80?img=45" alt="">
                        <div class="flex-grow-1">
                            <div style="font-weight:600;font-size:.9rem;">Sophia Lane</div>
                            <div style="color:var(--text2);font-size:.78rem;">29 articles</div>
                        </div>
                        <span class="pill pill-draft">★ 4.8</span>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <img class="avatar" src="https://i.pravatar.cc/80?img=15" alt="">
                        <div class="flex-grow-1">
                            <div style="font-weight:600;font-size:.9rem;">Liam Carter</div>
                            <div style="color:var(--text2);font-size:.78rem;">21 articles</div>
                        </div>
                        <span class="pill pill-draft">★ 4.7</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        // ===== Loader =====
        const loader = document.getElementById('pageLoader'),
            pct = document.getElementById('loaderPercent'),
            loaderStart = performance.now();
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
                    clearInterval(count);
                    pct.textContent = '100';
                    loader.classList.add('hidden');
                    setTimeout(() => {
                        loader.style.display = 'none';
                        document.body.classList.remove('loading');
                        document.body.classList.add('loaded');
                    }, 400);
                }, delay);
            };
            if (document.readyState === 'complete') finishLoader();
            else window.addEventListener('load', finishLoader, { once: true });
        }

        // ===== Sidebar toggle (mobile) =====
        const sidebar = document.getElementById('sidebar'),
            backdrop = document.getElementById('sidebarBackdrop'),
            menuToggle = document.getElementById('menuToggle');
        if (menuToggle) {
            menuToggle.addEventListener('click', () => { sidebar.classList.add('open'); backdrop.classList.add('show'); });
            backdrop.addEventListener('click', () => { sidebar.classList.remove('open'); backdrop.classList.remove('show'); });
        }

        // ===== Sidebar collapse / expand (desktop) =====
        const collapseBtn = document.getElementById('collapseBtn');
        if (collapseBtn) {
            collapseBtn.addEventListener('click', () => {
                if (window.matchMedia('(max-width: 991px)').matches) {
                    const open = sidebar.classList.toggle('open');
                    backdrop.classList.toggle('show', open);
                } else {
                    document.body.classList.toggle('sidebar-collapsed');
                }
            });
        }

        // ===== Theme toggle =====
        document.addEventListener('DOMContentLoaded', () => {
            const themeToggle = document.getElementById('themeToggle');
            const html = document.documentElement;
            if (themeToggle) {
                themeToggle.addEventListener('click', () => {
                    const next = html.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark';
                    html.setAttribute('data-bs-theme', next);
                    themeToggle.querySelector('i').className = next === 'dark' ? 'bi bi-sun' : 'bi bi-moon-stars';
                });
            }
        });

        // ===== Chart Data from PHP =====
        let currentViews = @json($pageViews->values());
        let currentVisitors = @json($uniqueVisitors->values());
        let currentLabels = @json($labels->values());

        // ===== SVG Chart Helpers =====
        const yMin = 20;
        const yMax = 210;

        function getXPositions(count) {
            const start = 38, end = 690;
            if (count === 1) return [start];
            return Array.from({ length: count }, (_, i) => start + (i / (count - 1)) * (end - start));
        }

        function toY(value, max) {
            if (max === 0) return yMax;
            return yMax - ((value / max) * (yMax - yMin));
        }

        function buildPath(data, max, xPos) {
            return data.map((v, i) => `${i === 0 ? 'M' : 'L'}${xPos[i]},${toY(v, max).toFixed(1)}`).join(' ');
        }

        function buildArea(data, max, xPos) {
            return buildPath(data, max, xPos) + ` L${xPos[xPos.length - 1]},${yMax} L${xPos[0]},${yMax} Z`;
        }

        function renderDots(views, visitors, maxVal, xPos) {
            const dotsGroup = document.getElementById('dots');
            dotsGroup.innerHTML = '';

            views.forEach((v, i) => {
                const c = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
                c.setAttribute('class', 'dot dot-views');
                c.setAttribute('cx', xPos[i]);
                c.setAttribute('cy', toY(v, maxVal).toFixed(1));
                c.setAttribute('r', '4');
                dotsGroup.appendChild(c);
            });

            visitors.forEach((v, i) => {
                const c = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
                c.setAttribute('class', 'dot dot-visitors');
                c.setAttribute('cx', xPos[i]);
                c.setAttribute('cy', toY(v, maxVal).toFixed(1));
                c.setAttribute('r', '3.5');
                dotsGroup.appendChild(c);
            });

            dotsGroup.querySelectorAll('.dot').forEach(dot => {
                dot.addEventListener('mouseenter', function () {
                    this.setAttribute('r', this.classList.contains('dot-views') ? 6 : 5.5);
                });
                dot.addEventListener('mouseleave', function () {
                    this.setAttribute('r', this.classList.contains('dot-views') ? 4 : 3.5);
                });
            });
        }

        function renderChart(views, visitors, lbls) {
            if (!Array.isArray(views) || !Array.isArray(visitors) || !Array.isArray(lbls)) return;

            currentViews = views;
            currentVisitors = visitors;
            currentLabels = lbls;

            const xPos = getXPositions(views.length);
            const maxVal = Math.max(...views, ...visitors, 1);

            // Paths
            document.querySelector('.chart-line.line-views').setAttribute('d', buildPath(views, maxVal, xPos));
            document.querySelector('.chart-line.line-visitors').setAttribute('d', buildPath(visitors, maxVal, xPos));
            document.querySelectorAll('.chart-area')[0].setAttribute('d', buildArea(views, maxVal, xPos));
            document.querySelectorAll('.chart-area')[1].setAttribute('d', buildArea(visitors, maxVal, xPos));

            // Dots
            renderDots(views, visitors, maxVal, xPos);

            // X axis labels
            const xAxisGroup = document.querySelector('.chart-axis-x');
            xAxisGroup.innerHTML = '';
            lbls.forEach((label, i) => {
                const text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
                text.setAttribute('x', xPos[i]);
                text.setAttribute('y', '232');
                text.setAttribute('text-anchor', 'middle');
                text.textContent = label;
                xAxisGroup.appendChild(text);
            });

            // Y axis labels
            const step = maxVal / 4;
            const yVals = [maxVal, step * 3, step * 2, step, 0];
            document.querySelectorAll('.chart-axis-y text').forEach((el, i) => {
                const val = yVals[i];
                el.textContent = val >= 1000
                    ? (val / 1000).toFixed(1) + 'k'
                    : val % 1 !== 0
                        ? val.toFixed(1)   // show decimal if not whole number
                        : Math.round(val);
            });

            // Summary totals
            const totalViews = views.reduce((a, b) => a + b, 0);
            const totalVisitors = visitors.reduce((a, b) => a + b, 0);
            document.querySelector('.cs-item:nth-child(1) .cs-val').textContent =
                totalViews >= 1000 ? (totalViews / 1000).toFixed(1) + 'k' : totalViews;
            document.querySelector('.cs-item:nth-child(2) .cs-val').textContent =
                totalVisitors >= 1000 ? (totalVisitors / 1000).toFixed(1) + 'k' : totalVisitors;
        }

        // Initial render
        renderChart(currentViews, currentVisitors, currentLabels);

        // ===== Chip buttons =====
        document.querySelectorAll('.chip-group .chip').forEach(chip => {
            chip.addEventListener('click', function () {
                this.parentElement.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
                this.classList.add('active');

                const range = this.textContent.trim().toLowerCase();
                fetch(`/analytics/traffic?range=${range}`)
                    .then(res => res.json())
                    .then(data => renderChart(data.pageViews, data.uniqueVisitors, data.labels));
            });
        });

        // ===== Tooltip =====
        const chartWrap = document.getElementById('chartWrap');
        const chartTip = document.getElementById('chartTip');

        if (chartWrap && chartTip) {
            chartWrap.addEventListener('mousemove', (e) => {
                const rect = chartWrap.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const idx = Math.min(currentViews.length - 1, Math.max(0, Math.round((x / rect.width) * (currentViews.length - 1))));

                chartTip.style.opacity = '1';
                chartTip.innerHTML =
                    `<div class="tt-day">${currentLabels[idx]}</div>` +
                    `<div class="tt-row"><span class="d" style="background:var(--accent)"></span> Views <b>${currentViews[idx].toLocaleString()}</b></div>` +
                    `<div class="tt-row"><span class="d" style="background:#60a5fa"></span> Visitors <b>${currentVisitors[idx].toLocaleString()}</b></div>`;

                let left = (idx / (currentViews.length - 1)) * rect.width + 12;
                if (left > rect.width - 150) left -= 162;
                chartTip.style.left = left + 'px';
                chartTip.style.top = '8px';
            });

            chartWrap.addEventListener('mouseleave', () => { chartTip.style.opacity = '0'; });
        }

        // ===== Top Category pills -> filter Recent Posts =====
        const catTags = document.querySelectorAll('#catTags .cat-tag');
        const postRows = document.querySelectorAll('#postsBody tr[data-cat]');
        const noResults = document.getElementById('noResults');
        const filterTag = document.getElementById('filterTag');

        catTags.forEach(tag => {
            tag.addEventListener('click', function () {
                catTags.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                const cat = this.getAttribute('data-cat');
                let visible = 0;
                postRows.forEach(row => {
                    const match = cat === 'all' || row.getAttribute('data-cat') === cat;
                    row.style.display = match ? '' : 'none';
                    if (match) visible++;
                });
                noResults.style.display = visible === 0 ? '' : 'none';
                if (cat === 'all') {
                    filterTag.style.display = 'none';
                } else {
                    filterTag.style.display = 'inline';
                    filterTag.innerHTML = '· ' + cat + ' (' + visible + ')';
                }
            });
        });
    </script>
@endpush