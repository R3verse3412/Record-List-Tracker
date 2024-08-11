document.addEventListener('DOMContentLoaded', function() {
    const filterInput = document.getElementById('filter-search');
    const entriesDropdown = document.getElementById('entries-dropdown');
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');
    const moviesContainer = document.getElementById('manga-container');
    const movieCards = document.querySelectorAll('.manga-card');
    let currentPage = 1;
    let entriesPerPage = parseInt(entriesDropdown.value);

    function filterManga() {
        const filterValue = filterInput.value.toLowerCase();
        return Array.from(movieCards).filter(card => {
            const title = card.querySelector('.text-title').textContent.toLowerCase();
            const year = card.querySelector('.text-year').textContent.toLowerCase();
            return title.includes(filterValue) || year.includes(filterValue);
        });
    }

    function renderPage() {
        const filteredCards = filterManga();
        const totalPages = Math.ceil(filteredCards.length / entriesPerPage);
        currentPage = Math.min(currentPage, totalPages || 1);

        movieCards.forEach(card => card.style.display = 'none');
        
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
        const filteredCards = filterManga();
        const totalPages = Math.ceil(filteredCards.length / entriesPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            renderPage();
        }
    });

    renderPage();

    // Event listener for opening the modal
    $('#mangaModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var title = button.data('title');
        var author = button.data('author');
        var description = button.data('description');
        var genre = button.data('genre');
        var rating = button.data('rating');
        var release_date = button.data('release_date');
        var img = button.data('img');
        var status = button.data('status');

        // Update the modal's content
        var modal = $(this);
        modal.find('#mangaTitle').text(title);
        modal.find('#mangaAuthor').text(author);
        modal.find('#mangaDescription').text(description);
        modal.find('#mangaGenre').text(genre);
        modal.find('#mangaRating').text(rating);
        modal.find('#mangarelease_date').text(release_date);
        modal.find('#mangaImage').attr('src', img);
        modal.find('#mangaStatus').text(status);
    });
});