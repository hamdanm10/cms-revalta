import { initAjaxTable } from '../utils/ajax-table.js';

export function initPortfolioCategories() {
    initAjaxTable({
        tableSelector:   '#portfolio-categories-table',
        resultsSelector: '#portfolio-categories-results',
        filters: [
            { selector: '#portfolio-category-search', param: 'search', event: 'input' },
        ],
    });
}
