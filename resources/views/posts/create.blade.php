@extends('layouts.DashboardLayout')
@section('content')


    <div class="container page-shell">
        <div class="intro-bar d-flex flex-wrap justify-content-between align-items-start gap-3">
            <div>
                <h1 class="intro-title"><i class="bi bi-journal-richtext me-2"></i>Create Blog Post</h1>
                <p class="intro-subtitle">A clean blog editor layout with a real right-side settings switcher.</p>
            </div>
            <span class="status-pill">Draft saved</span>
        </div>
        <form id="post-form" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="row g-4 align-items-start">
                <div class="col-lg-8">
                    <div class="editor-card">
                        <h5 class="card-title"><i class="bi bi-type-h1"></i>Post Title</h5>
                        <input type="text" class="form-control big-title-input" name="title" id="title"
                            value="{{ old('title', $post->title ?? '') }}"
                            placeholder="Enter a compelling title for your blog post...">
                        <div class="char-row">
                            <span>Make it clear, specific, and click-worthy.</span>
                            <span>0 / 100 characters</span>
                        </div>
                    </div>

                    <div class="editor-card">
                        <h5 class="card-title">
                            <i class="bi bi-card-text"></i>Content
                            <span class="card-badge">Editor View</span>
                        </h5>

                        {{-- <div class="editor-toolbar">
                            <button type="button" class="toolbar-btn"><i class="bi bi-type-bold"></i></button>
                            <button type="button" class="toolbar-btn"><i class="bi bi-type-italic"></i></button>
                            <button type="button" class="toolbar-btn"><i class="bi bi-type-underline"></i></button>
                            <button type="button" class="toolbar-btn"><i class="bi bi-list-ul"></i></button>
                            <button type="button" class="toolbar-btn"><i class="bi bi-list-ol"></i></button>
                            <button type="button" class="toolbar-btn"><i class="bi bi-link-45deg"></i></button>
                            <button type="button" class="toolbar-btn"><i class="bi bi-image"></i></button>
                            <button type="button" class="toolbar-btn"><i class="bi bi-quote"></i></button>
                            <select class="toolbar-select ms-auto">
                                <option>Paragraph</option>
                                <option>Heading 2</option>
                                <option>Heading 3</option>
                                <option>Quote</option>
                            </select>
                        </div> --}}

                        <div class="editor-area" id="editor"></div>
                        <input type="hidden" name="body" value="{{ old('body', $post->body ?? '') }}" id="body">

                        <div class="meta-row">
                            <span><strong style="color: var(--accent);">127</strong> words</span>
                            <span><strong style="color: var(--accent);">789</strong> characters</span>
                            <span><strong style="color: var(--accent);">~1 min</strong> read time</span>
                        </div>
                    </div>

                    <div class="editor-card">
                        <h5 class="card-title"><i class="bi bi-text-paragraph"></i>Excerpt / Summary</h5>
                        <textarea class="form-control" rows="4" name="excerpt"
                            value="{{ old('excerpt', $post->excerpt ?? '') }}"
                            placeholder="Write a short summary for blog listings and previews..."></textarea>
                        <div class="char-row">
                            <span>Recommended length: 50–160 characters.</span>
                            <span>0 / 160 characters</span>
                        </div>
                    </div>

                    <div class="editor-card">
                        <h5 class="card-title"><i class="bi bi-image"></i>Featured Image</h5>
                        <input type="file" id="featuredFileInput" name="featured_image"
                            value="{{ old('featured_image', $post->featured_image ?? '') }}"
                            accept="image/png,image/jpeg,image/webp" hidden>
                        <div class="upload-zone" data-target="featuredFileInput" style="cursor:pointer;">
                            <i class="bi bi-cloud-arrow-up"></i>
                            <div class="upload-title">Drop your cover image here</div>
                            <p class="upload-subtitle">Click or drag • PNG, JPG, WEBP • 1200×630 recommended</p>
                            <input type="file" class="upload-input" accept="image/png,image/jpeg,image/webp" hidden>
                        </div>
                        <div class="image-preview" id="featuredImagePreview">
                            <img id="featuredPreviewImg"
                                src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=1200&h=675&fit=crop"
                                alt="Featured preview">
                            <button type="button" class="remove-preview-btn" id="removeFeatured"
                                aria-label="Remove image"><i class="bi bi-x-lg"></i></button>
                        </div>
                    </div>

                    <div class="editor-card">
                        <h5 class="card-title">
                            <i class="bi bi-collection"></i>Additional Media
                            <span class="card-badge">Optional</span>
                        </h5>
                        <div class="upload-zone" style="cursor:pointer;">
                            <i class="bi bi-images"></i>
                            <div class="upload-title">Add supporting images</div>
                            <p class="upload-subtitle">Click or drag to add more</p>
                            <input type="file" class="upload-input" name="additionalImages[]"
                                    accept="image/png,image/jpeg,image/webp" multiple hidden>
                        </div>
                        <div class="additional-preview-grid" id="additionalPreviewGrid"></div>
                    </div>
                </div>

                <div class="col-lg-4 sidebar-column">
                    <div class="sidebar-stack">
                        <div class="editor-card">
                            <h5 class="card-title"><i class="bi bi-send-check"></i>Publish Settings</h5>

                            <label class="form-label">Visibility</label>
                            <div class="radio-group mb-3">
                                <label class="radio-option">
                                    <input type="radio" name="visibility" value="public" {{  old('visibility', $post->visibility ?? '') === 'public' ? 'checked' : '' }}>
                                    <i class="bi bi-globe2"></i>
                                    <strong>Public</strong>
                                    <span>Visible to everyone</span>
                                </label>

                                <label class="radio-option">
                                    <input type="radio" name="visibility" value="unlisted" {{  old('visibility', $post->visibility ?? '') === 'unlisted' ? 'checked' : '' }}>
                                    <i class="bi bi-link-45deg"></i>
                                    <strong>Unlisted</strong>
                                    <span>Only with link</span>
                                </label>

                                <label class="radio-option">
                                    <input type="radio" name="visibility" value="private" {{  old('visibility', $post->visibility ?? '') === 'private' ? 'checked' : '' }}>
                                    <i class="bi bi-lock"></i>
                                    <strong>Private</strong>
                                    <span>Only you can view</span>
                                </label>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Publish Date</label>
                                <input type="datetime-local" name="publishDate"
                                    value="{{ old('publishDate') ? old('publishDate') : now()->format('Y-m-d\TH:i') }}"
                                    class="form-control">
                            </div>

                            <div class="switch-row">
                                <span>Enable comments</span>
                                <div class="form-check form-switch m-0">
                                    <input class="form-check-input" name="enable_comments" type="checkbox" {{ old('enable_comments', $post->enable_comments ?? false) ? 'checked' : '' }}>
                                </div>
                            </div>
                            <div class="switch-row">
                                <span>Show share buttons</span>
                                <div class="form-check form-switch m-0">
                                    <input class="form-check-input" type="checkbox" name="show_share_buttons" value="on"
                                        {{ old('show_share_buttons', $post->show_share_buttons ?? false) ? 'checked' : '' }}>
                                </div>
                            </div>
                            <div class="switch-row">
                                <span>Mark as featured post</span>
                                <div class="form-check form-switch m-0">
                                    <input class="form-check-input" type="checkbox" name="is_featured" value="on"
                                        {{ old('is_featured', $post->is_featured ?? false) ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>

                        <div class="editor-card">
                            <h5 class="card-title"><i class="bi bi-tags"></i>Categories & Tags</h5>

                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select class="form-select" name="category"
                                    value="{{ old('category', $post->category ?? '') }}">
                                    <option selected>Select a category...</option>
                                    <option value="web-development">Web Development</option>
                                    <option value="design">Design</option>
                                    <option value="technology">Technology</option>
                                    <option value="tutorials">Tutorials</option>
                                    <option value="opinion">Opinion</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Sub-category</label>
                                <select class="form-select" name="subcategory"
                                    value="{{ old('subcategory', $post->subcategory ?? '') }}">
                                    <option selected>Select a sub-category...</option>
                                    <option value="frontend">Frontend</option>
                                    <option value="backend">Backend</option>
                                    <option value="full-stack">Full Stack</option>
                                    <option value="ui-ux">UI / UX</option>
                                </select>
                            </div>

                            <div>
                                <label class="form-label">Tags <span class="muted"
                                        style="font-weight:500;font-size:.75rem;">(<span
                                            id="tagCount">4</span>/10)</span></label>
                                <div class="tag-list" id="tagList">
                                    <span class="tag-pill">HTML <i class="bi bi-x tag-remove" role="button"
                                            aria-label="Remove"></i></span>
                                    <span class="tag-pill">CSS <i class="bi bi-x tag-remove" role="button"
                                            aria-label="Remove"></i></span>
                                    <span class="tag-pill">Bootstrap <i class="bi bi-x tag-remove" role="button"
                                            aria-label="Remove"></i></span>
                                    <span class="tag-pill">Blogging <i class="bi bi-x tag-remove" role="button"
                                            aria-label="Remove"></i></span>
                                </div>

                                <div class="tag-input-wrap">
                                    <input type="text" class="form-control" id="tagInput"
                                        placeholder="Add a new tag and press Enter..." maxlength="30">
                                    <div id="tagHiddenInputs"></div>
                                    <button type="button" class="btn-add" id="tagAddBtn"><i class="bi bi-plus-lg"></i>
                                        Add</button>
                                </div>

                                <div class="tag-suggestions" id="tagSuggestions">
                                    <small>Suggestions:</small>
                                    <span data-tag="Web Development">+Web Development</span>
                                    <span data-tag="Tutorial">+Tutorial</span>
                                    <span data-tag="JavaScript">+JavaScript</span>
                                    <span data-tag="Frontend">+Frontend</span>
                                    <span data-tag="UI Design">+UI Design</span>
                                </div>
                            </div>
                        </div>

                        <div class="post-settings-switcher">
                            <input class="setting-input" type="radio" name="post-settings" id="set-seo" checked>
                            <input class="setting-input" type="radio" name="post-settings" id="set-social">
                            <input class="setting-input" type="radio" name="post-settings" id="set-author">
                            <input class="setting-input" type="radio" name="post-settings" id="set-toc">
                            <input class="setting-input" type="radio" name="post-settings" id="set-checks">

                            <div class="editor-card settings-card">
                                <h5 class="card-title"><i class="bi bi-sliders"></i>Post Settings</h5>

                                <div class="settings-nav">
                                    <label class="settings-btn" for="set-seo"><i class="bi bi-search"></i>SEO</label>
                                    <label class="settings-btn" for="set-social"><i class="bi bi-share"></i>Social</label>
                                    <label class="settings-btn" for="set-author"><i
                                            class="bi bi-person-badge"></i>Author</label>
                                    <label class="settings-btn" for="set-toc"><i class="bi bi-list-nested"></i>TOC</label>
                                    <label class="settings-btn" for="set-checks"><i
                                            class="bi bi-check2-square"></i>Checks</label>
                                </div>

                                <div class="settings-content">
                                    <div class="settings-panel panel-seo">
                                        <div class="mb-3">
                                            <label class="form-label">SEO Title</label>
                                            <input type="text" class="form-control" name="seoTitle"
                                                value="{{ old('seoTitle', $post->seoTitle ?? '') }}"
                                                placeholder="Optimized title for search engines...">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">URL Slug</label>
                                            <input type="text" class="form-control" name="urlSlug" id="urlSlug"
                                                value="{{ old('urlSlug', $post->urlSlug ?? '') }}"
                                                placeholder="your-post-url-slug">
                                            <div class="url-preview">yoursite.com/blog/<strong>your-post-url-slug</strong>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Meta Description</label>
                                            <textarea class="form-control" rows="3" name="Description"
                                                placeholder="Write a concise description for search engines...">{{ old('Description', $post->Description ?? '') }}</textarea>
                                        </div>
                                        <div class="switch-row">
                                            <span>No index</span>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input" type="checkbox" name="noIndex" {{ old('noIndex', $post->noIndex ?? '') ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                        <div class="switch-row mt-2">
                                            <span>Use canonical URL</span>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input" type="checkbox" name="useCanonical" {{ old('useCanonical', $post->useCanonical ?? '') ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                        <div class="seo-preview mt-3">
                                            <div class="seo-url">yoursite.com › blog › your-post-url-slug</div>
                                            <div class="seo-title">Getting Started with Web Development in 2026</div>
                                            <div class="seo-desc">The landscape of web development continues to evolve
                                                rapidly. Discover the tools and workflow ideas that matter this year.</div>
                                        </div>
                                    </div>

                                    <div class="settings-panel panel-social">
                                        <div class="mb-3">
                                            <label class="form-label">Social Title</label>
                                            <input type="text" class="form-control" name="socialTitle"
                                                value="{{ old('socialTitle', $post->socialTitle ?? '') }}"
                                                placeholder="Title used when shared on social media...">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Social Description</label>
                                            <textarea class="form-control" rows="3" name="socialDescription"
                                                placeholder="Short description for social cards...">{{ old('socialDescription', $post->socialDescription ?? '') }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Social Image</label>
                                            <div class="upload-zone py-4" style="cursor:pointer;">
                                                <i class="bi bi-image"></i>
                                                <div class="upload-title">Upload social sharing image</div>
                                                <p class="upload-subtitle">Recommended 1200×630</p>
                                                <input type="file" class="upload-input" name="socialImage"
    accept="image/png,image/jpeg,image/webp" hidden>
                                            </div>
                                            <div class="social-preview" id="socialImagePreviewWrap"
                                                style="margin-top:.75rem;display:none;">
                                                <img id="socialPreviewImg" src="" alt="Social preview"
                                                    style="width:100%;display:block;border-radius:12px;">
                                            </div>
                                        </div>
                                        <div class="social-preview">
                                            <div class="social-preview-top">
                                                <i class="bi bi-image"></i>
                                            </div>
                                            <div class="social-preview-body">
                                                <small>yoursite.com</small>
                                                <strong>Getting Started with Web Development in 2026</strong>
                                                <p>The landscape of web development continues to evolve...</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="settings-panel panel-author">
                                        <div class="mb-3">
                                            <label class="form-label">Author</label>
                                            <select class="form-select" name="author"
                                                value="{{ old('author', $post->author ?? '') }}">
                                                <option>Abhishek Gupta (Primary Author)</option>
                                                <option>Jane Smith</option>
                                                <option>Alex Johnson</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            {{-- <label class="form-label">Reading Time Override</label>--}}
                                            <input type="number" hidden class="form-control" name="reading_time"
                                                value="{{ old('reading_time', $post->reading_time ?? '') }}"
                                                placeholder="Auto calculated" min="1">
                                        </div> 
                                        <div>
                                            <label class="form-label">Custom CSS Class</label>
                                            <input class="form-control" type="text" name="customCssClass"
                                                value="{{ old('customCssClass', $post->custom_css_class ?? '') }}">
                                        </div>
                                    </div>

                                    <div class="settings-panel panel-toc">
                                        <div class="switch-row mb-3">
                                            <span>Show table of contents</span>
                                            <div class="form-check form-switch m-0">
                                                <input class="form-check-input" 
                                                    name="table_of_contents"
                                                    type="checkbox" 
                                                    value="on"
                                                    {{ old('table_of_contents', $post->table_of_contents ?? false) ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                        <div class="mini-panel">
                                            <div class="toc-item">
                                                <span class="toc-dot"><i class="bi bi-dot"></i></span>
                                                <span>Getting Started with Web Development in 2026</span>
                                            </div>
                                            <div class="toc-item">
                                                <span class="toc-dot"><i class="bi bi-dot"></i></span>
                                                <span>Why this matters</span>
                                            </div>
                                            <div class="toc-item">
                                                <span class="toc-dot"><i class="bi bi-dot"></i></span>
                                                <span>Building a better publishing flow</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="settings-panel panel-checks">
                                        <div class="check-item">
                                            <span class="check-dot done"><i class="bi bi-check"></i></span>
                                            <span>Title is written and looks strong</span>
                                        </div>
                                        <div class="check-item">
                                            <span class="check-dot done"><i class="bi bi-check"></i></span>
                                            <span>Featured image is ready</span>
                                        </div>
                                        <div class="check-item">
                                            <span class="check-dot done"><i class="bi bi-check"></i></span>
                                            <span>Category is selected</span>
                                        </div>
                                        <div class="check-item">
                                            <span class="check-dot pending"><i class="bi bi-dash"></i></span>
                                            <span>SEO data is complete</span>
                                        </div>
                                        <div class="check-item">
                                            <span class="check-dot pending"><i class="bi bi-dash"></i></span>
                                            <span>Social card image is uploaded</span>
                                        </div>
                                        <div class="check-item">
                                            <span class="check-dot pending"><i class="bi bi-dash"></i></span>
                                            <span>Post is proofread</span>
                                        </div>
                                        <div class="check-progress"><span></span></div>
                                        <div class="char-row mt-2">
                                            <span>3 of 6 complete</span>
                                            <span style="color: var(--accent);">43%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-actions">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="status-pill">Auto-saved 2 min ago</span>
                </div>
                <div class="d-flex gap-2 flex-wrap">
                    <button type="button" class="btn btn-ghost" id="openPreviewBtn"><i
                            class="bi bi-eye me-2"></i>Preview</button>
                    <button type="submit" name="action" value="draft" class="btn btn-outline-accent"><i
                            class="bi bi-file-earmark me-2"></i>Save
                        Draft</button>
                    <button type="submit" name="action" value="publish" class="btn btn-accent"><i
                            class="bi bi-send me-2"></i>Publish Now</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Preview Modal -->
    <div class="preview-overlay" id="previewOverlay" role="dialog" aria-modal="true" aria-label="Blog post preview">
        <div class="preview-shell">
            <!-- Radios as direct children so CSS sibling selectors control .preview-canvas -->
            <input type="radio" name="pv-device" id="pv-desktop" checked hidden>
            <input type="radio" name="pv-device" id="pv-tablet" hidden>
            <input type="radio" name="pv-device" id="pv-mobile" hidden>

            <div class="preview-topbar">
                <span class="preview-mode"><i class="bi bi-eye-fill"></i> Live Preview</span>
                <div class="preview-device-tabs">
                    <label for="pv-desktop"><i class="bi bi-display"></i><span>Desktop</span></label>
                    <label for="pv-tablet"><i class="bi bi-tablet"></i><span>Tablet</span></label>
                    <label for="pv-mobile"><i class="bi bi-phone"></i><span>Mobile</span></label>
                </div>
                <button type="button" class="preview-close" id="closePreviewBtn" aria-label="Close preview"><i
                        class="bi bi-x-lg"></i></button>
            </div>

            <div class="preview-canvas">
                <article class="preview-article">
                    <div class="preview-meta">
                        <span class="meta-chip"><i class="bi bi-tag-fill"></i> <span id="pvCategory">Web
                                Development</span></span>
                        <span class="meta-chip"><i class="bi bi-calendar3"></i> <span id="pvDate">Today</span></span>
                        <span class="meta-chip"><i class="bi bi-clock"></i> <span id="pvReadTime">~1 min read</span></span>
                    </div>

                    <h1 class="preview-title" id="pvTitle">Getting Started with Web Development in 2026</h1>

                    <p class="preview-excerpt" id="pvExcerpt">A clean blog editor with a polished publishing workflow.</p>

                    <div class="preview-author-row">
                        <div class="preview-author-avatar" id="pvAvatar">J</div>
                        <div class="preview-author-info">
                            <strong id="pvAuthor">John Doe</strong>
                            <span>Published <span id="pvPubDate">just now</span></span>
                        </div>
                    </div>

                    <div class="preview-cover" id="pvCoverWrap">
                        <img id="pvCover"
                            src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=1200&h=675&fit=crop"
                            alt="Cover">
                    </div>

                    <div class="preview-body" id="pvBody">
                        <p>Loading preview...</p>
                    </div>

                    <div class="preview-tags-section">
                        <h6>Tagged With</h6>
                        <div class="preview-tags" id="pvTags">
                            <span>HTML</span>
                        </div>
                    </div>

                    <div class="preview-share">
                        <span><i class="bi bi-heart me-2"></i>Enjoyed this post?</span>
                        <div class="share-icons">
                            <a href="#" aria-label="Twitter"><i class="bi bi-twitter-x"></i></a>
                            <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" aria-label="LinkedIn"><i class="bi bi-linkedin"></i></a>
                            <a href="#" aria-label="Copy link"><i class="bi bi-link-45deg"></i></a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>


@endsection


@push('styles')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
@endpush


@push('scripts')
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script src="{{ asset('js/create.js') }}" defer></script>
@endpush