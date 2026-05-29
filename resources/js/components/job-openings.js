import { initAjaxTable } from '../utils/ajax-table.js';

export function initJobOpenings() {
    initAjaxTable({
        tableSelector:   '#job-openings-table',
        resultsSelector: '#job-openings-results',
        filters: [
            { selector: '#job-search',    param: 'search',    event: 'input'  },
            { selector: '#job-work-type', param: 'work_type', event: 'change' },
            { selector: '#job-status',    param: 'status',    event: 'change' },
        ],
    });
}
