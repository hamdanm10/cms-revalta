/**
 * Generic AJAX table with debounced search, filters, and pagination.
 *
 * Usage:
 *   initAjaxTable({
 *     tableSelector:   '#my-table',       // element with data-search-url
 *     resultsSelector: '#my-results',     // container replaced on each fetch
 *     filters: [
 *       { selector: '#my-search',  param: 'search',    event: 'input'  },
 *       { selector: '#my-status',  param: 'status',    event: 'change' },
 *     ],
 *   });
 */
export function initAjaxTable({ tableSelector, resultsSelector, filters = [], debounceMs = 400 }) {
    const tableEl = document.querySelector(tableSelector);
    if (!tableEl) return;

    const searchUrl = tableEl.dataset.searchUrl;
    const resultsEl = tableEl.querySelector(resultsSelector);

    const filterEls = filters
        .map(({ selector, param, event = 'input' }) => ({
            el: tableEl.querySelector(selector),
            param,
            event,
        }))
        .filter(({ el }) => el !== null);

    let debounceTimer;

    function buildParams(overrides = {}) {
        const params = new URLSearchParams();
        filterEls.forEach(({ el, param }) => {
            if (el.value) params.set(param, el.value);
        });
        Object.entries(overrides).forEach(([k, v]) => { if (v) params.set(k, v); });
        return params;
    }

    async function fetchResults(params) {
        try {
            const res = await fetch(`${searchUrl}?${params}`);
            resultsEl.innerHTML = await res.text();
        } catch (err) {
            console.error(`[ajax-table] ${tableSelector}:`, err);
        }
    }

    function triggerFetch() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => fetchResults(buildParams()), debounceMs);
    }

    resultsEl.addEventListener('click', (e) => {
        const link = e.target.closest('[data-pagination] a');
        if (!link) return;
        e.preventDefault();
        const params = new URLSearchParams(new URL(link.href).search);
        filterEls.forEach(({ el, param }) => {
            if (el.value) params.set(param, el.value);
        });
        fetchResults(params);
    });

    filterEls.forEach(({ el, event }) => el.addEventListener(event, triggerFetch));
}
