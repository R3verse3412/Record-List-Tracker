document.addEventListener('DOMContentLoaded', function() {
    const filterInput = document.getElementById('filter-search');
    const entriesDropdown = document.getElementById('entries-dropdown');
    const alphabeticalDropdown = document.getElementById('entries-Alpahabetical');
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');
    const seriesContainer = document.getElementById('cartoon-movies-container');
    const seriesCards = document.querySelectorAll('.cartoon-movies-card');
    let currentPage = 1;
    let entriesPerPage = parseInt(entriesDropdown.value);
    let filteredCards = Array.from(seriesCards);

    function filterMovies() {
        const filterValue = filterInput.value.toLowerCase();
        const alphabeticalValue = alphabeticalDropdown.value.toLowerCase();

        return Array.from(seriesCards).filter(card => {
            const title = card.querySelector('.text-title').textContent.toLowerCase();
            const year = card.querySelector('.text-year').textContent.toLowerCase();
            const genre = card.querySelector('.text-genre').textContent.toLowerCase();
            const matchesSearch = title.includes(filterValue) || year.includes(filterValue) || genre.includes(filterValue);
            const matchesAlphabetical = alphabeticalValue === 'all' || title.startsWith(alphabeticalValue);

            return matchesSearch && matchesAlphabetical;
        });
    }

    function renderPage() {
        filteredCards = filterMovies();
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
        const totalPages = Math.ceil(filteredCards.length / entriesPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            renderPage();
        }
    });

    renderPage();

});
