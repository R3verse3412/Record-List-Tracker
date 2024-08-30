document.addEventListener('DOMContentLoaded', function() {
    const filterInput = document.getElementById('filter-search');
    const entriesDropdown = document.getElementById('entries-dropdown');
    const alphabeticalDropdown = document.getElementById('entries-Alpahabetical');
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');
    const cartoonseriesContainer = document.getElementById('cartoon-series-container');
    const cartoonseriesCards = document.querySelectorAll('.cartoon-series-card');
    let currentPage = 1;
    let entriesPerPage = parseInt(entriesDropdown.value);
    let filteredCards = Array.from(cartoonseriesCards);

    function filterCartoonSeries() {
        const filterValue = filterInput.value.toLowerCase();
        const alphabeticalValue = alphabeticalDropdown.value.toLowerCase();

        return Array.from(cartoonseriesCards).filter(card => {
            const title = card.querySelector('.text-title').textContent.toLowerCase();
            const year = card.querySelector('.text-year').textContent.toLowerCase();
            const matchesSearch = title.includes(filterValue) || year.includes(filterValue);
            const matchesAlphabetical = alphabeticalValue === 'all' || title.startsWith(alphabeticalValue);

            return matchesSearch && matchesAlphabetical;
        });
    }

    function renderPage() {
        filteredCards = filterCartoonSeries();
        const totalPages = Math.ceil(filteredCards.length / entriesPerPage);
        currentPage = Math.min(currentPage, totalPages || 1);

        cartoonseriesCards.forEach(card => card.style.display = 'none');

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

    // Modal functionality using jQuery
    $('#cartoonseriesModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var name = button.data('name');
        var summary = button.data('summary');
        var genre = button.data('genre');
        var rating = button.data('rating');
        var year = button.data('year');
        var img = button.data('img');
        var episodes = button.data('episodes');
        var studio = button.data('studio');

        // Update the modal's content
        var modal = $(this);
        modal.find('#cartoonseriesName').text(name);
        modal.find('#cartoonseriesSummary').text(summary);
        modal.find('#cartoonseriesGenre').text(genre);
        modal.find('#cartoonseriesRating').text(rating);
        modal.find('#cartoonseriesYear').text(year);
        modal.find('#cartoonseriesImage').attr('src', img);
        modal.find('#cartoonseriesEpisodes').text(episodes);
        modal.find('#cartoonseriesStudio').text(studio);
    });
});
