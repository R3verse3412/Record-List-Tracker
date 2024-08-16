document.addEventListener('DOMContentLoaded', function() {
    const filterInput = document.getElementById('filter-search');
    const entriesDropdown = document.getElementById('entries-dropdown');
    const alphabeticalDropdown = document.getElementById('entries-Alpahabetical'); // Update this ID if necessary
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');
    const seriesContainer = document.getElementById('american-tv-series-container');
    const seriesCards = document.querySelectorAll('.american-tv-series-card');
    let currentPage = 1;
    let entriesPerPage = parseInt(entriesDropdown.value);
    let filteredCards = Array.from(seriesCards);

    function filterSeries() {
        const filterValue = filterInput.value.toLowerCase();
        const alphabeticalValue = alphabeticalDropdown.value.toLowerCase();
        
        filteredCards = Array.from(seriesCards).filter(card => {
            const title = card.querySelector('.text-title').textContent.toLowerCase();
            const year = card.querySelector('.text-year').textContent.toLowerCase();
            const matchesSearch = title.includes(filterValue) || year.includes(filterValue);
            const matchesAlphabetical = alphabeticalValue === 'all' || title.startsWith(alphabeticalValue);

            return matchesSearch && matchesAlphabetical;
        });
    }

    function renderPage() {
        filterSeries();
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

    // Modal functionality
    var seriesModal = document.getElementById('seriesModal');
    seriesModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        
        var seriesName = button.getAttribute('data-name');
        var seriesSummary = button.getAttribute('data-summary');
        var seriesGenre = button.getAttribute('data-genre');
        var seriesDirector = button.getAttribute('data-director');
        var seriesSeason = button.getAttribute('data-season');
        var seriesCast = button.getAttribute('data-cast');
        var seriesRating = button.getAttribute('data-rating');
        var seriesYear = button.getAttribute('data-year');
        var seriesImage = button.getAttribute('data-img');

        var modalTitle = seriesModal.querySelector('.modal-title');
        var modalBodyName = seriesModal.querySelector('#seriesName');
        var modalBodySummary = seriesModal.querySelector('#seriesSummary');
        var modalBodyGenre = seriesModal.querySelector('#seriesGenre');
        var modalBodyDirector = seriesModal.querySelector('#seriesDirector');
        var modalBodySeason = seriesModal.querySelector('#seriesSeason');
        var modalBodyCast = seriesModal.querySelector('#seriesCast');
        var modalBodyRating = seriesModal.querySelector('#seriesRating');
        var modalBodyYear = seriesModal.querySelector('#seriesYear');
        var modalBodyImage = seriesModal.querySelector('#seriesImage');

        modalTitle.textContent = 'TV Series Details: ' + seriesName;
        modalBodyName.textContent = seriesName;
        modalBodySummary.textContent = seriesSummary;
        modalBodyGenre.textContent = seriesGenre;
        modalBodyDirector.textContent = seriesDirector;
        modalBodySeason.textContent = seriesSeason;
        modalBodyCast.textContent = seriesCast;
        modalBodyRating.textContent = seriesRating;
        modalBodyYear.textContent = seriesYear;
        modalBodyImage.src = seriesImage;

        var castString = button.getAttribute('data-cast');
        var castMembers = castString.split('|');
        var carouselInner = seriesModal.querySelector('#seriesCastCarousel');
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
