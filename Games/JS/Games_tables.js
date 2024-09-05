document.addEventListener('DOMContentLoaded', function() {
    const filterInput = document.getElementById('filter-search');
    const entriesDropdown = document.getElementById('entries-dropdown');
    const alphabeticalDropdown = document.getElementById('entries-Alpahabetical');
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');
    const gamesContainer = document.getElementById('games-container');
    const gamesCards = document.querySelectorAll('.games-card');
    let currentPage = 1;
    let entriesPerPage = parseInt(entriesDropdown.value);
    let filteredCards = Array.from(gamesCards); // Initialize filteredCards

    function filterGames() {
        const filterValue = filterInput.value.toLowerCase();
        const alphabeticalValue = alphabeticalDropdown.value.toLowerCase();

        return Array.from(gamesCards).filter(card => {
            const title = card.querySelector('.text-title').textContent.toLowerCase();
            const year = card.querySelector('.text-year').textContent.toLowerCase();
            const studio = card.querySelector('.text-studio').textContent.toLowerCase();
            const matchesSearch = title.includes(filterValue) || year.includes(filterValue) || studio.includes(filterValue);
            const matchesAlphabetical = alphabeticalValue === 'all' || title.startsWith(alphabeticalValue) ;

            return matchesSearch && matchesAlphabetical;
        });
    }

    function renderPage() {
        filteredCards = filterGames(); // Update filteredCards based on the current filters
        const totalPages = Math.ceil(filteredCards.length / entriesPerPage);
        currentPage = Math.min(currentPage, totalPages || 1);

        gamesCards.forEach(card => card.style.display = 'none'); // Hide all cards initially

        filteredCards.slice((currentPage - 1) * entriesPerPage, currentPage * entriesPerPage)
            .forEach(card => card.style.display = 'block'); // Show the relevant cards for the current page

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

    renderPage(); // Initial rendering of the page

    });