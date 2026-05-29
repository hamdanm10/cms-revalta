import './bootstrap';
import Alpine from 'alpinejs';

// Quill
import Quill from 'quill';
import 'quill/dist/quill.snow.css';

window.Alpine = Alpine;

Alpine.data('quillEditor', (config = {}) => ({
    quill: null,
    init() {
        this.quill = new Quill(this.$refs.editor, {
            theme: 'snow',
            placeholder: config.placeholder ?? 'Write something...',
            modules: {
                toolbar: [
                    [{ header: [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['link'],
                    ['clean'],
                ],
            },
        });

        if (config.value) {
            this.quill.root.innerHTML = config.value;
        }

        this.$refs.input.value = config.value ?? '';

        this.quill.on('text-change', () => {
            this.$refs.input.value = this.quill.root.innerHTML;
        });
    },
}));

Alpine.data('quillEditorImages', (config = {}) => {
    let quillInstance = null;
    let lastRange = { index: 0, length: 0 };

    function imageHandler() {
        const savedRange = { ...lastRange };
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/*';
        input.click();
        input.onchange = async () => {
            const file = input.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append('image', file);
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

            try {
                const res = await fetch(config.uploadUrl, { method: 'POST', body: formData });
                if (!res.ok) return;
                const data = await res.json();
                if (!data.url) return;
                quillInstance.insertEmbed(savedRange.index, 'image', data.url);
                quillInstance.setSelection(savedRange.index + 1);
            } catch {
                // upload failed silently
            }
        };
    }

    return {
        init() {
            quillInstance = new Quill(this.$refs.editor, {
                theme: 'snow',
                placeholder: config.placeholder ?? 'Write something...',
                modules: {
                    toolbar: {
                        container: [
                            [{ header: [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ list: 'ordered' }, { list: 'bullet' }],
                            ['link', 'image'],
                            ['clean'],
                        ],
                        handlers: { image: imageHandler },
                    },
                },
            });

            if (config.value) {
                quillInstance.root.innerHTML = config.value;
            }

            this.$refs.input.value = config.value ?? '';

            quillInstance.on('selection-change', (range) => {
                if (range) lastRange = range;
            });

            quillInstance.on('text-change', () => {
                this.$refs.input.value = quillInstance.root.innerHTML;
            });
        },
    };
});

Alpine.start();

// Initialize components on DOM ready
document.addEventListener('DOMContentLoaded', () => {
    // Job openings search & filter
    if (document.querySelector('#job-openings-table')) {
        import('./components/job-openings').then(module => module.initJobOpenings());
    }

    // Portfolio categories search
    if (document.querySelector('#portfolio-categories-table')) {
        import('./components/portfolio-categories').then(module => module.initPortfolioCategories());
    }

    // Portfolios search & filter
    if (document.querySelector('#portfolios-table')) {
        import('./components/portfolios').then(module => module.initPortfolios());
    }

    // Blog categories search
    if (document.querySelector('#blog-categories-table')) {
        import('./components/blog-categories').then(module => module.initBlogCategories());
    }

    // Blogs search & filter
    if (document.querySelector('#blogs-table')) {
        import('./components/blogs').then(module => module.initBlogs());
    }
});
