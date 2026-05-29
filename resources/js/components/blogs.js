import { initAjaxTable } from '../utils/ajax-table.js';

export function initBlogs() {
    initAjaxTable({
        tableSelector:   '#blogs-table',
        resultsSelector: '#blogs-results',
        filters: [
            { selector: '#blog-search',   param: 'search',      event: 'input'  },
            { selector: '#blog-category', param: 'category_id', event: 'change' },
            { selector: '#blog-status',   param: 'status',      event: 'change' },
        ],
    });
}
