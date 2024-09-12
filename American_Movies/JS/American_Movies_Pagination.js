document.addEventListener('DOMContentLoaded', function () {
    const entriesDropdown = document.getElementById('entries-dropdown');

    entriesDropdown.addEventListener('change', function () {
        const limit = this.value;
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('limit', limit);
        currentUrl.searchParams.set('page', 1); // Reset to the first page
        window.location.href = currentUrl; // Reload with new parameters
    });

    document.querySelectorAll('.pagination .page-link').forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            window.location.href = this.getAttribute('href'); // Navigate to the selected page
        });
    });
});
