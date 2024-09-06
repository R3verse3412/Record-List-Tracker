
    document.addEventListener('DOMContentLoaded', function() {
        const filterInput = document.getElementById('filter-search');
        const entriesDropdown = document.getElementById('entries-dropdown');
        const alphabeticalDropdown = document.getElementById('entries-Alpahabetical');
        const prevButton = document.getElementById('prev-button');
        const nextButton = document.getElementById('next-button');
        const moviesContainer = document.getElementById('movies-container');
        const movieCards = document.querySelectorAll('.movie-card');
        const pageButtons = document.querySelectorAll('.pagination .page-link[data-page]');
        let currentPage = 1;
        let entriesPerPage = parseInt(entriesDropdown.value);

        function filterMovies() {
            const filterValue = filterInput.value.toLowerCase();
            const alphabeticalValue = alphabeticalDropdown.value.toLowerCase();

            return Array.from(movieCards).filter(card => {
                const title = card.querySelector('.text-title').textContent.toLowerCase();
                const year = card.querySelector('.text-year').textContent.toLowerCase();
                const director = card.querySelector('.text-director').textContent.toLowerCase();

                const matchesSearch = title.includes(filterValue) || year.includes(filterValue) || director.includes(filterValue);
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

            updatePaginationButtons(totalPages);
        }

        function updatePaginationButtons(totalPages) {
            prevButton.disabled = currentPage === 1;
            nextButton.disabled = currentPage === totalPages || totalPages === 0;

            pageButtons.forEach(button => {
                const pageNum = parseInt(button.dataset.page);
                button.classList.toggle('active', pageNum === currentPage);
                button.style.display = pageNum <= totalPages ? 'block' : 'none';
            });
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

        pageButtons.forEach(button => {
            button.addEventListener('click', function() {
                currentPage = parseInt(this.dataset.page);
                renderPage();
            });
        });

        renderPage();
    });
