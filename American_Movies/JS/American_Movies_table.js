document.addEventListener('DOMContentLoaded', function() {
    const filterInput = document.getElementById('filter-search');
    const entriesDropdown = document.getElementById('entries-dropdown');
    const alphabeticalDropdown = document.getElementById('entries-Alpahabetical');
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');
    const moviesContainer = document.getElementById('movies-container');
    const movieCards = document.querySelectorAll('.movie-card');
    let currentPage = 1;
    let entriesPerPage = parseInt(entriesDropdown.value);

    function filterMovies() {
    const filterValue = filterInput.value.toLowerCase();
    const alphabeticalValue = alphabeticalDropdown.value.toLowerCase();

    return Array.from(movieCards).filter(card => {
        const title = card.querySelector('.text-title').textContent.toLowerCase();
        const year = card.querySelector('.text-year').textContent.toLowerCase();
        const matchesSearch = title.includes(filterValue) || year.includes(filterValue);

        // Check if the movie card should be shown based on the alphabetical filter
        const matchesAlphabetical = alphabeticalValue === 'all' || title.startsWith(alphabeticalValue);

        return matchesSearch && matchesAlphabetical;
    });
}



    function renderPage() {
        let filteredCards = filterMovies();

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
        const totalPages = Math.ceil(filterMovies().length / entriesPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            renderPage();
        }
    });

    renderPage();

    // Modal functionality
    var movieModal = document.getElementById('movieModal');
    movieModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;

        var movieName = button.getAttribute('data-name');
        var movieSummary = button.getAttribute('data-summary');
        var movieGenre = button.getAttribute('data-genre');
        var movieDirector = button.getAttribute('data-director');
        var movieCast = button.getAttribute('data-cast');
        var movieRating = button.getAttribute('data-rating');
        var movieYear = button.getAttribute('data-year');
        var movieImage = button.getAttribute('data-img');

        var modalTitle = movieModal.querySelector('.modal-title');
        var modalBodyName = movieModal.querySelector('#movieName');
        var modalBodySummary = movieModal.querySelector('#movieSummary');
        var modalBodyGenre = movieModal.querySelector('#movieGenre');
        var modalBodyDirector = movieModal.querySelector('#movieDirector');
        var modalBodyCast = movieModal.querySelector('#movieCast');
        var modalBodyRating = movieModal.querySelector('#movieRating');
        var modalBodyYear = movieModal.querySelector('#movieYear');
        var modalBodyImage = movieModal.querySelector('#movieImage');

        modalTitle.textContent = 'Movie Details: ' + movieName;
        modalBodyName.textContent = movieName;
        modalBodySummary.textContent = movieSummary;
        modalBodyGenre.textContent = movieGenre;
        modalBodyDirector.textContent = movieDirector;
        modalBodyCast.textContent = movieCast;
        modalBodyRating.textContent = movieRating;
        modalBodyYear.textContent = movieYear;
        modalBodyImage.src = movieImage;

        var castString = button.getAttribute('data-cast');
        var castMembers = castString.split('|');
        var carouselInner = movieModal.querySelector('#movieCastCarousel');
        carouselInner.innerHTML = '';
        castMembers.forEach(function(member, index) {
            var [name, imgUrl] = member.split(',');
            var div = document.createElement('div');
            div.className = index === 0 ? 'carousel-item active' : 'carousel-item';
            div.innerHTML = `
                <h5>${name}</h5>
                <img src="${imgUrl}" alt="${name}" style="max-width: 200px; max-height: 200px;">
            `;
            carouselInner.appendChild(div);
        });
    });
});

