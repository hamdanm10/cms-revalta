export function initJobOpenings() {
    const tableEl = document.querySelector('#job-openings-table');
    if (!tableEl) return;

    const searchUrl      = tableEl.dataset.searchUrl;
    const searchInput    = tableEl.querySelector('#job-search');
    const workTypeSelect = tableEl.querySelector('#job-work-type');
    const statusSelect   = tableEl.querySelector('#job-status');
    const resultsEl      = tableEl.querySelector('#job-openings-results');

    let debounceTimer;

    function buildParams(overrides = {}) {
        const params = new URLSearchParams();
        if (searchInput.value)    params.set('search',    searchInput.value);
        if (workTypeSelect.value) params.set('work_type', workTypeSelect.value);
        if (statusSelect.value)   params.set('status',    statusSelect.value);
        Object.entries(overrides).forEach(([k, v]) => { if (v) params.set(k, v); });
        return params;
    }

    async function fetchResults(params) {
        try {
            const res = await fetch(`${searchUrl}?${params}`);
            resultsEl.innerHTML = await res.text();
        } catch (err) {
            console.error('Job openings fetch error:', err);
        }
    }

    function triggerFetch() {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => fetchResults(buildParams()), 400);
    }

    // Intercept pagination link clicks inside results
    resultsEl.addEventListener('click', (e) => {
        const link = e.target.closest('[data-pagination] a');
        if (!link) return;
        e.preventDefault();
        const params = new URLSearchParams(new URL(link.href).search);
        if (searchInput.value)    params.set('search',    searchInput.value);
        if (workTypeSelect.value) params.set('work_type', workTypeSelect.value);
        if (statusSelect.value)   params.set('status',    statusSelect.value);
        fetchResults(params);
    });

    searchInput.addEventListener('input', triggerFetch);
    workTypeSelect.addEventListener('change', triggerFetch);
    statusSelect.addEventListener('change', triggerFetch);
}
