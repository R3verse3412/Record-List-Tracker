document.addEventListener('DOMContentLoaded', function() {
    const filterInput = document.getElementById('filter-search');
    const entriesDropdown = document.getElementById('entries-dropdown');
    const alphabeticalDropdown = document.getElementById('entries-Alpahabetical');
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');
    const seriesContainer = document.getElementById('series-container');
    const seriesCards = document.querySelectorAll('.anime-series-card');
    let currentPage = 1;
    let entriesPerPage = parseInt(entriesDropdown.value);

    function filterMovies() {
        const filterValue = filterInput.value.toLowerCase();
        const alphabeticalValue = alphabeticalDropdown.value.toLowerCase();

        return Array.from(seriesCards).filter(card => {
            const title = card.querySelector('.text-title').textContent.toLowerCase();
            const year = card.querySelector('.text-year').textContent.toLowerCase();
            const studio = card.querySelector('.text-studio').textContent.toLowerCase();
            const matchesSearch = title.includes(filterValue) || year.includes(filterValue) ||studio.includes(filterValue);
            const matchesAlphabetical = alphabeticalValue === 'all' || title.startsWith(alphabeticalValue);

            return matchesSearch && matchesAlphabetical;
        });
    }

    function renderPage() {
        const filteredCards = filterMovies();
        const totalPages = Math.ceil(filteredCards.length / entriesPerPage);
        currentPage = Math.min(currentPage, totalPages || 1);

        seriesCards.forEach(card => card.style.display = 'none');

        filteredCards.slice((currentPage - 1) * entriesPerPage, currentPage * entriesPerPage)
            .forEach(card => card.style.display = 'block');

        prevButton.disabled = currentPage === 1;
        nextButton.disabled = currentPage === totalPages || totalPages === 0;
    }

    filterInput.addEventListener('input', function() {
        currentPage = 1;
        renderPage();
    });

    alphabeticalDropdown.addEventListener('change', function() {
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
        const filteredCards = filterMovies();
        const totalPages = Math.ceil(filteredCards.length / entriesPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            renderPage();
        }
    });

    renderPage();

    // Modal functionality
    const movieModal = document.getElementById('movieModal');
    movieModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;

        const movieName = button.getAttribute('data-name');
        const movieSummary = button.getAttribute('data-summary');
        const movieGenre = button.getAttribute('data-genre');
        const movieRating = button.getAttribute('data-rating');
        const movieYear = button.getAttribute('data-year');
        const movieEpisodes = button.getAttribute('data-episodes');
        const movieStudio = button.getAttribute('data-studio');
        const movieImage = button.getAttribute('data-img');

        const modalTitle = movieModal.querySelector('.modal-title');
        const modalBodyName = movieModal.querySelector('#movieName');
        const modalBodySummary = movieModal.querySelector('#movieSummary');
        const modalBodyGenre = movieModal.querySelector('#movieGenre');
        const modalBodyRating = movieModal.querySelector('#movieRating');
        const modalBodyYear = movieModal.querySelector('#movieYear');
        const modalBodyEpisodes = movieModal.querySelector('#movieEpisodes');
        const modalBodyStudio = movieModal.querySelector('#movieStudio');
        const modalBodyImage = movieModal.querySelector('#movieImage');

        modalTitle.textContent = 'Anime Series Details: ' + movieName;
        modalBodyName.textContent = movieName;
        modalBodySummary.textContent = movieSummary;
        modalBodyGenre.textContent = movieGenre;
        modalBodyRating.textContent = movieRating;
        modalBodyYear.textContent = movieYear;
        modalBodyEpisodes.textContent = movieEpisodes;
        modalBodyStudio.textContent = movieStudio;
        modalBodyImage.src = movieImage;
    });
});
