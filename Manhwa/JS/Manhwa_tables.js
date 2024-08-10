document.addEventListener('DOMContentLoaded', function() {
    const filterInput = document.getElementById('filter-search');
    const entriesDropdown = document.getElementById('entries-dropdown');
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');
    const moviesContainer = document.getElementById('manhwa-container');
    const movieCards = document.querySelectorAll('manhwa-card');
    let currentPage = 1;
    let entriesPerPage = parseInt(entriesDropdown.value);

    function filterManhwa() {
        const filterValue = filterInput.value.toLowerCase();
        return Array.from(movieCards).filter(card => {
            const title = card.querySelector('.text-title').textContent.toLowerCase();
            const year = card.querySelector('.text-year').textContent.toLowerCase();
            return title.includes(filterValue) || year.includes(filterValue);
        });
    }

    function renderPage() {
        const filteredCards = filterManhwa();
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
        const filteredCards = filterManhwa();
        const totalPages = Math.ceil(filteredCards.length / entriesPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            renderPage();
        }
    });

    renderPage();
// Event listener for opening the modal
$('#manhwaModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var name = button.data('name');
    var author = button.data('author');
    var summary = button.data('summary');
    var genre = button.data('genre');
    var rating = button.data('rating');
    var year = button.data('year');
    var img = button.data('img');
    var device = button.data('device');
    var studio = button.data('studio');

    // Update the modal's content
    var modal = $(this);
    modal.find('#manhwaName').text(name);
    modal.find('#manhwaAuthor').text(author);
    modal.find('#manhwaSummary').text(summary);
    modal.find('#manhwaGenre').text(genre);
    modal.find('#manhwaRating').text(rating);
    modal.find('#manhwaYear').text(year);
    modal.find('#manhwaImage').attr('src', img);
    modal.find('#manhwaDevice').text(device);
    modal.find('#manhwaStudio').text(studio);
});
});