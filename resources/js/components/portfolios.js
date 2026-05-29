import { initAjaxTable } from '../utils/ajax-table.js';

export function initPortfolios() {
    initAjaxTable({
        tableSelector:   '#portfolios-table',
        resultsSelector: '#portfolios-results',
        filters: [
            { selector: '#portfolio-search',   param: 'search',      event: 'input'  },
            { selector: '#portfolio-category', param: 'category_id', event: 'change' },
            { selector: '#portfolio-status',   param: 'status',      event: 'change' },
        ],
    });
}
