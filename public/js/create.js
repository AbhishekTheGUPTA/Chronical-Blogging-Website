const editorArea = document.querySelector('.editor-area');
const hiddenBodyInput = document.getElementById('body');
const titleInput = document.querySelector('.big-title-input');
const postForm = document.getElementById('post-form');

// Tooltips on hover for every toolbar button
const tooltips = {
    '.ql-bold':                  'Bold (Ctrl+B)',
    '.ql-italic':                'Italic (Ctrl+I)',
    '.ql-underline':             'Underline (Ctrl+U)',
    '.ql-strike':                'Strikethrough (Ctrl+D)',
    '.ql-script[value="sub"]':   'Subscript (Ctrl+,)',
    '.ql-script[value="super"]': 'Superscript (Ctrl+.)',
    '.ql-color':                 'Text Color',
    '.ql-background':            'Background Color',
    '.ql-font':                  'Font Family',
    '.ql-header':                'Heading (Ctrl+Alt+1~6)',
    '.ql-size':                  'Font Size',
    '.ql-list[value="ordered"]': 'Ordered List (Ctrl+O)',
    '.ql-list[value="bullet"]':  'Bullet List (Ctrl+L)',
    '.ql-indent[value="-1"]':    'Decrease Indent (Ctrl+[)',
    '.ql-indent[value="+1"]':    'Increase Indent (Ctrl+])',
    '.ql-align':                 'Align (Ctrl+Alt+Arrows)',
    '.ql-blockquote':            'Blockquote (Ctrl+Q)',
    '.ql-code-block':            'Code Block (Ctrl+E)',
    '.ql-link':                  'Insert Link (Ctrl+K)',
    '.ql-image':                 'Insert Image',
    '.ql-video':                 'Insert Video',
    '.ql-clean':                 'Remove Formatting (Ctrl+\\)',
};

// Apply after toolbar renders
setTimeout(() => {
    Object.entries(tooltips).forEach(([selector, tip]) => {
        document.querySelectorAll(`.ql-toolbar ${selector}`).forEach(el => {
            el.setAttribute('title', tip);
        });
    });
}, 100);


// Quill — initialize FIRST so it's available everywhere below
const quill = new Quill('#editor', {
    theme: 'snow',
    placeholder: 'Write your post...',
    modules: {
        toolbar: {
            container: [
                [{ 'font': [] }],
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                [{ 'size': ['small', false, 'large', 'huge'] }],

                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'script': 'sub' }, { 'script': 'super' }],

                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'indent': '-1' }, { 'indent': '+1' }],
                [{ 'align': [] }],

                ['blockquote', 'code-block'],
                ['link', 'image', 'video'],

                ['clean']
            ],
        },
        keyboard: {
            bindings: {
                // Text formatting
                bold: { key: 'B', shortKey: true, handler() { quill.format('bold', !quill.getFormat().bold); } },
                italic: { key: 'I', shortKey: true, handler() { quill.format('italic', !quill.getFormat().italic); } },
                underline: { key: 'U', shortKey: true, handler() { quill.format('underline', !quill.getFormat().underline); } },
                strike: { key: 'D', shortKey: true, handler() { quill.format('strike', !quill.getFormat().strike); } },

                // Script
                subscript: { key: ',', shortKey: true, handler() { quill.format('script', quill.getFormat().script === 'sub' ? false : 'sub'); } },
                superscript: { key: '.', shortKey: true, handler() { quill.format('script', quill.getFormat().script === 'super' ? false : 'super'); } },

                // Headings
                h1: { key: '1', shortKey: true, altKey: true, handler() { quill.format('header', quill.getFormat().header === 1 ? false : 1); } },
                h2: { key: '2', shortKey: true, altKey: true, handler() { quill.format('header', quill.getFormat().header === 2 ? false : 2); } },
                h3: { key: '3', shortKey: true, altKey: true, handler() { quill.format('header', quill.getFormat().header === 3 ? false : 3); } },
                h4: { key: '4', shortKey: true, altKey: true, handler() { quill.format('header', quill.getFormat().header === 4 ? false : 4); } },
                h5: { key: '5', shortKey: true, altKey: true, handler() { quill.format('header', quill.getFormat().header === 5 ? false : 5); } },
                h6: { key: '6', shortKey: true, altKey: true, handler() { quill.format('header', quill.getFormat().header === 6 ? false : 6); } },

                // Lists
                orderedList: { key: 'O', shortKey: true, handler() { quill.format('list', quill.getFormat().list === 'ordered' ? false : 'ordered'); } },
                bulletList: { key: 'L', shortKey: true, handler() { quill.format('list', quill.getFormat().list === 'bullet' ? false : 'bullet'); } },

                // Indent
                indentIncrease: { key: ']', shortKey: true, handler() { quill.format('indent', '+1'); } },
                indentDecrease: { key: '[', shortKey: true, handler() { quill.format('indent', '-1'); } },

                // Align
                alignLeft: { key: 'ArrowLeft', shortKey: true, altKey: true, handler() { quill.format('align', false); } },
                alignCenter: { key: 'ArrowUp', shortKey: true, altKey: true, handler() { quill.format('align', 'center'); } },
                alignRight: { key: 'ArrowRight', shortKey: true, altKey: true, handler() { quill.format('align', 'right'); } },
                alignJustify: { key: 'ArrowDown', shortKey: true, altKey: true, handler() { quill.format('align', 'justify'); } },

                // Blocks
                blockquote: { key: 'Q', shortKey: true, handler() { quill.format('blockquote', !quill.getFormat().blockquote); } },
                codeBlock: {
                    key: 'E', shortKey: true,
                    handler() {
                        const fmt = quill.getFormat();
                        if (fmt.blockquote) quill.format('blockquote', false);
                        quill.format('code-block', !fmt['code-block']);
                    }
                },

                // Clean
                clean: { key: '\\', shortKey: true, handler() { quill.removeFormat(quill.getSelection()?.index ?? 0, quill.getSelection()?.length ?? 0); } },

                // Link — opens the toolbar link prompt
                link: {
                    key: 'K', shortKey: true,
                    handler() {
                        const range = quill.getSelection();
                        if (range && range.length > 0) {
                            const url = prompt('Enter URL:');
                            if (url) quill.format('link', url);
                        }
                    }
                },
            }
        },
        clipboard: { matchVisual: false },
        // codeBlock: {
        //     key: 'E', shortKey: true,
        //     handler() {
        //         const current = quill.getFormat();
        //         // Must remove blockquote first if active
        //         if (current.blockquote) quill.format('blockquote', false);
        //         quill.format('code-block', !current['code-block']);
        //     }
        // },
        // clean: {
        //     key: 'M', shortKey: true,
        //     handler() {
        //         const range = quill.getSelection();
        //         if (!range || range.length === 0) return;
        //         quill.removeFormat(range.index, range.length);
        //     }
        // },
    }
});

quill.clipboard.addMatcher(Node.ELEMENT_NODE, function (node, delta) {
    return delta;
});



// Sync Quill content to hidden input on every keystroke
quill.on('text-change', function () {
    hiddenBodyInput.value = quill.root.innerHTML;
});

// Tag Input Manager
(function () {
    const tagList = document.getElementById('tagList');
    const tagInput = document.getElementById('tagInput');
    const addBtn = document.getElementById('tagAddBtn');
    const suggestions = document.getElementById('tagSuggestions');
    const tagCount = document.getElementById('tagCount');
    const MAX_TAGS = 10;

    if (!tagList || !tagInput || !addBtn) return;

    function getExistingTags() {
        return Array.from(tagList.querySelectorAll('.tag-pill'))
            .map(p => p.firstChild.textContent.trim().toLowerCase());
    }

    function updateCount() {
        if (tagCount) tagCount.textContent = tagList.querySelectorAll('.tag-pill').length;
        syncSuggestions();
    }

    function syncSuggestions() {
        if (!suggestions) return;
        const existing = getExistingTags();
        suggestions.querySelectorAll('span[data-tag]').forEach(s => {
            s.classList.toggle('used', existing.includes(s.dataset.tag.toLowerCase()));
        });
    }

    function createPill(name) {
        const pill = document.createElement('span');
        pill.className = 'tag-pill';
        pill.appendChild(document.createTextNode(name + ' '));
        const x = document.createElement('i');
        x.className = 'bi bi-x tag-remove';
        x.setAttribute('role', 'button');
        x.setAttribute('aria-label', 'Remove');
        pill.appendChild(x);
        return pill;
    }

    function addTag(raw) {
        const name = (raw || '').trim().replace(/,+$/, '').trim();
        if (!name) return false;
        const existing = getExistingTags();
        if (existing.includes(name.toLowerCase())) { flashInput('Tag already added'); return false; }
        if (existing.length >= MAX_TAGS) { flashInput('Max ' + MAX_TAGS + ' tags'); return false; }

        const hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'tags[]';
        hidden.value = name;
        hidden.dataset.tag = name;
        document.getElementById('tagHiddenInputs').appendChild(hidden);

        tagList.appendChild(createPill(name));
        updateCount();
        return true;
    }

    function flashInput(msg) {
        const original = tagInput.placeholder;
        tagInput.placeholder = msg;
        tagInput.style.borderColor = 'var(--accent)';
        setTimeout(() => { tagInput.placeholder = original; tagInput.style.borderColor = ''; }, 1400);
    }

    addBtn.addEventListener('click', () => { if (addTag(tagInput.value)) tagInput.value = ''; tagInput.focus(); });

    tagInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            if (addTag(tagInput.value)) tagInput.value = '';
        } else if (e.key === 'Backspace' && tagInput.value === '') {
            const pills = tagList.querySelectorAll('.tag-pill');
            if (pills.length) { pills[pills.length - 1].remove(); updateCount(); }
        }
    });

    tagList.addEventListener('click', (e) => {
        if (e.target.classList.contains('tag-remove')) {
            const pill = e.target.closest('.tag-pill');
            const tagName = pill.firstChild.textContent.trim();
            const hiddenTag = document.querySelector(`#tagHiddenInputs input[data-tag="${tagName}"]`);
            if (hiddenTag) hiddenTag.remove();
            pill.remove();
            updateCount();
        }
    });

    if (suggestions) {
        suggestions.addEventListener('click', (e) => {
            const s = e.target.closest('span[data-tag]');
            if (!s || s.classList.contains('used')) return;
            addTag(s.dataset.tag);
        });
    }

    // Repopulate pills from old() on validation fail
    document.querySelectorAll('#tagHiddenInputs input[type="hidden"]').forEach(input => {
        tagList.appendChild(createPill(input.value));
    });

    updateCount();
})();

// Preview Modal
(function () {
    const openBtn = document.getElementById('openPreviewBtn');
    const closeBtn = document.getElementById('closePreviewBtn');
    const overlay = document.getElementById('previewOverlay');
    if (!openBtn || !overlay) return;

    const excerptInput = document.querySelector('.editor-card textarea.form-control');
    const coverImg = document.querySelector('.image-preview img');
    const categorySelect = document.querySelector('.editor-card select.form-select');
    const authorSelect = document.querySelector('.panel-author select.form-select');

    function fillPreview() {
        const t = (titleInput && titleInput.value.trim()) || 'Getting Started with Web Development in 2026';
        document.getElementById('pvTitle').textContent = t;

        const ex = (excerptInput && excerptInput.value.trim()) || 'A clean blog editor...';
        document.getElementById('pvExcerpt').textContent = ex;

        if (coverImg && coverImg.src) {
            document.getElementById('pvCover').src = coverImg.src;
            document.getElementById('pvCoverWrap').style.display = 'block';
        } else {
            document.getElementById('pvCoverWrap').style.display = 'none';
        }

        const livePills = document.querySelectorAll('#tagList .tag-pill');
        const tagsHost = document.getElementById('pvTags');
        tagsHost.innerHTML = '';
        if (livePills.length === 0) {
            tagsHost.innerHTML = '<span style="border-style:dashed;color:var(--text2);">No tags added</span>';
        } else {
            livePills.forEach(t => {
                const s = document.createElement('span');
                s.textContent = (t.firstChild && t.firstChild.textContent || '').trim();
                tagsHost.appendChild(s);
            });
        }

        if (categorySelect && categorySelect.selectedIndex > 0) {
            document.getElementById('pvCategory').textContent = categorySelect.options[categorySelect.selectedIndex].text;
        } else {
            document.getElementById('pvCategory').textContent = 'Uncategorized';
        }

        if (authorSelect) {
            const name = authorSelect.options[authorSelect.selectedIndex].text.replace(/\s*\(.*\)/, '').trim();
            document.getElementById('pvAuthor').textContent = name;
            document.getElementById('pvAvatar').textContent = (name.charAt(0) || 'A').toUpperCase();
        }

        const now = new Date();
        const dateStr = now.toLocaleDateString(undefined, { month: 'short', day: 'numeric', year: 'numeric' });
        document.getElementById('pvDate').textContent = dateStr;
        document.getElementById('pvPubDate').textContent = dateStr;

        const text = quill ? quill.getText() : '';
        const words = text.trim().split(/\s+/).filter(Boolean).length;
        const minutes = Math.max(1, Math.round(words / 220));
        document.getElementById('pvReadTime').textContent = '~' + minutes + ' min read';
    }

    openBtn.addEventListener('click', () => { fillPreview(); overlay.classList.add('open'); document.body.classList.add('preview-open'); });
    closeBtn.addEventListener('click', () => { overlay.classList.remove('open'); document.body.classList.remove('preview-open'); });
    overlay.addEventListener('click', (e) => { if (e.target === overlay) { overlay.classList.remove('open'); document.body.classList.remove('preview-open'); } });
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && overlay.classList.contains('open')) { overlay.classList.remove('open'); document.body.classList.remove('preview-open'); } });
})();

// Slug creation
const slugInput = document.getElementById('urlSlug');
let userEditedSlug = false;

if (slugInput) slugInput.addEventListener('input', () => userEditedSlug = true);

if (titleInput && slugInput) {
    titleInput.addEventListener('input', () => {
        if (!userEditedSlug) {
            slugInput.value = titleInput.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
        }
    });
}

// Visibility Radio Buttons
(function () {
    const group = document.querySelector('.radio-group');
    if (!group) return;
    const options = group.querySelectorAll('.radio-option');
    options.forEach(opt => {
        opt.style.cursor = 'pointer';
        opt.addEventListener('click', () => {
            options.forEach(o => o.classList.remove('active'));
            opt.classList.add('active');
        });
    });
})();

// File Uploads
(function () {
    const zones = document.querySelectorAll('.upload-zone');

    zones.forEach(zone => {
        const input = zone.querySelector('.upload-input');
        if (!input) return;

        // Determine zone type by input name
        const zoneName = input.name || '';
        const isFeatured = zone.dataset.target === 'featuredFileInput';

        // Click handler
        zone.addEventListener('click', (e) => {
            if (e.target.closest('.remove-preview-btn')) return;
            if (isFeatured) {
                document.getElementById('featuredFileInput').click();
            } else {
                input.click();
            }
        });

        // Featured input change
        if (isFeatured) {
            const featuredInput = document.getElementById('featuredFileInput');
            if (featuredInput) {
                featuredInput.addEventListener('change', () => {
                    if (!featuredInput.files?.length) return;
                    handleFeaturedFile(featuredInput.files[0], zone);
                });
            }
        }

        // Regular input change
        if (!isFeatured) {
            input.addEventListener('change', () => {
                if (!input.files?.length) return;
                if (zoneName.includes('additionalImages')) {
                    Array.from(input.files).forEach(f => handleAdditionalFile(f));
                } else {
                    handleSocialFile(input.files[0], zone);
                }
            });
        }

        // Drag and drop
        zone.addEventListener('dragover', (e) => { e.preventDefault(); zone.classList.add('hover-active'); });
        zone.addEventListener('dragleave', () => zone.classList.remove('hover-active'));
        zone.addEventListener('drop', (e) => {
            e.preventDefault();
            zone.classList.remove('hover-active');
            const files = Array.from(e.dataTransfer.files).filter(f => f.type.startsWith('image/'));
            if (!files.length) return;
            if (isFeatured) {
                handleFeaturedFile(files[0], zone);
            } else if (zoneName.includes('additionalImages')) {
                files.forEach(f => handleAdditionalFile(f));
            } else {
                handleSocialFile(files[0], zone);
            }
        });
    });

    // Featured image handler
    function handleFeaturedFile(file, zone) {
        if (!file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = (ev) => {
            const src = ev.target.result;
            const previewImg = document.getElementById('featuredPreviewImg');
            const previewWrap = document.querySelector('.image-preview');
            const removeBtn = document.getElementById('removeFeatured');
            const title = zone.querySelector('.upload-title');
            const subtitle = zone.querySelector('.upload-subtitle');
            const icon = zone.querySelector('i');

            if (previewImg) previewImg.src = src;
            if (previewWrap) previewWrap.style.display = 'block';
            if (removeBtn) removeBtn.style.display = 'inline-flex';
            if (title) title.textContent = file.name;
            if (subtitle) subtitle.textContent = (file.size / 1024).toFixed(0) + ' KB';
            if (icon) icon.className = 'bi bi-check-circle-fill';
            zone.classList.add('has-file');
        };
        reader.readAsDataURL(file);
    }

    // Social image handler
    function handleSocialFile(file, zone) {
        if (!file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = (ev) => {
            const socialImg = document.getElementById('socialPreviewImg');
            const socialWrap = document.getElementById('socialImagePreviewWrap');
            if (socialImg) socialImg.src = ev.target.result;
            if (socialWrap) socialWrap.style.display = 'block';
            zone.classList.add('has-file');
        };
        reader.readAsDataURL(file);
    }

    // Additional images handler
    function handleAdditionalFile(file) {
        if (!file.type.startsWith('image/')) return;
        const reader = new FileReader();
        reader.onload = (ev) => {
            const grid = document.getElementById('additionalPreviewGrid');
            if (!grid) return;
            const item = document.createElement('div');
            item.className = 'additional-preview-item';
            const img = document.createElement('img');
            img.src = ev.target.result;
            img.alt = 'Uploaded';
            item.appendChild(img);
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'remove-preview-btn';
            btn.innerHTML = '<i class="bi bi-x"></i>';
            btn.setAttribute('aria-label', 'Remove');
            btn.addEventListener('click', (e) => { e.stopPropagation(); item.remove(); });
            item.appendChild(btn);
            grid.appendChild(item);
        };
        reader.readAsDataURL(file);
    }

    // Remove featured
    const removeFeatured = document.getElementById('removeFeatured');
    if (removeFeatured) {
        removeFeatured.addEventListener('click', () => {
            const previewImg = document.getElementById('featuredPreviewImg');
            const fileInput = document.getElementById('featuredFileInput');
            if (previewImg) previewImg.src = 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=1200&h=675&fit=crop';
            if (fileInput) fileInput.value = '';
            removeFeatured.style.display = 'none';
        });
    }
})();

// Form submit — sync Quill content to hidden input
if (postForm) {
    postForm.addEventListener('submit', function () {
        hiddenBodyInput.value = quill.root.innerHTML;
    });
}

