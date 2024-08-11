document.addEventListener('DOMContentLoaded', function() {
    const filterInput = document.getElementById('filter-search');
    const entriesDropdown = document.getElementById('entries-dropdown');
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');
    const manhwaContainer = document.getElementById('manhwa-container');
    const manhwaCards = document.querySelectorAll('.manhwa-card');
    let currentPage = 1;
    let entriesPerPage = parseInt(entriesDropdown.value);

    function filterManhwa() {
        const filterValue = filterInput.value.toLowerCase();
        return Array.from(manhwaCards).filter(card => {
            const title = card.querySelector('.text-title').textContent.toLowerCase();
            const year = card.querySelector('.text-year').textContent.toLowerCase();
            return title.includes(filterValue) || year.includes(filterValue);
        });
    }

    function renderPage() {
        const filteredCards = filterManhwa();
        const totalPages = Math.ceil(filteredCards.length / entriesPerPage);
        currentPage = Math.min(currentPage, totalPages || 1);

        manhwaCards.forEach(card => card.style.display = 'none');
        
        filteredCards.slice((currentPage - 1) * entriesPerPage, currentPage * entriesPerPage)
            .forEach(card => card.style.display = 'block');

        prevButton.disabled = currentPage === 1;
        nextButton.disabled = currentPage === totalPages || totalPages === 0;
    }

    filterInput.addEventListener('input', function() {
        currentPage = 1;
        renderPage();
    });

    entriesDropdown.addEventListener('change', function() {
        entriesPerPage = parseInt(this.value);
        currentPage = 1;
        renderPage();
    });

    prevButton.addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            renderPage();
        }
    });

    nextButton.addEventListener('click', function() {
        const filteredCards = filterManhwa();
        const totalPages = Math.ceil(filteredCards.length / entriesPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            renderPage();
        }
    });

    renderPage(); // Call renderPage initially to set up the initial view

    // Event listener for opening the modal
    $('#manhwaModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var title = button.data('title');
        var author = button.data('author');
        var description = button.data('description');
        var genre = button.data('genre');
        var rating = button.data('rating');
        var release_date = button.data('release_date');
        var img = button.data('img');
        var status = button.data('status');

        var modal = $(this);
        modal.find('#manhwaTitle').text(title);
        modal.find('#manhwaAuthor').text(author);
        modal.find('#manhwaDescription').text(description);
        modal.find('#manhwaGenre').text(genre);
        modal.find('#manhwaRating').text(rating);
        modal.find('#manhwaRelease_Date').text(release_date);
        modal.find('#manhwaImage').attr('src', img);
        modal.find('#manhwaStatus').text(status);
    });
});