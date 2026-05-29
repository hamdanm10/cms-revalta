import { initAjaxTable } from '../utils/ajax-table.js';

export function initBlogCategories() {
    initAjaxTable({
        tableSelector:   '#blog-categories-table',
        resultsSelector: '#blog-categories-results',
        filters: [
            { selector: '#blog-category-search', param: 'search', event: 'input' },
        ],
    });
}
