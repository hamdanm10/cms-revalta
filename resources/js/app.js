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
