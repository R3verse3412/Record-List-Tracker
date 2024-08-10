document.addEventListener('DOMContentLoaded', function() {
    const filterInput = document.getElementById('filter-search');
    const entriesDropdown = document.getElementById('entries-dropdown');
    const prevButton = document.getElementById('prev-button');
    const nextButton = document.getElementById('next-button');
    const seriesContainer = document.getElementById('cartoon-movies-container');
    const seriesCards = document.querySelectorAll('.cartoon-movies-card');
    let currentPage = 1;
    let entriesPerPage = parseInt(entriesDropdown.value);
    let filteredCards = Array.from(seriesCards);

    function filterMovies() {
        const filterValue = filterInput.value.toLowerCase();
        filteredCards = Array.from(seriesCards).filter(card => {
            const title = card.querySelector('.text-title').textContent.toLowerCase();
            const year = card.querySelector('.text-year').textContent.toLowerCase();
            return title.includes(filterValue) || year.includes(filterValue);
        });
    }

    function renderPage() {
        filterMovies();
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
    var cartoonmoviesModal = document.getElementById('cartoonmoviesModal')
    cartoonmoviesModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget
        
        var name = button.getAttribute('data-name')
        var summary = button.getAttribute('data-summary')
        var genre = button.getAttribute('data-genre')
        var director = button.getAttribute('data-director')
        var rating = button.getAttribute('data-rating')
        var year = button.getAttribute('data-year')
        var img = button.getAttribute('data-img')
        var cast = button.getAttribute('data-cast')

        var modalTitle = cartoonmoviesModal.querySelector('.modal-title')
        var modalBodyName = cartoonmoviesModal.querySelector('#cartoonmoviesName')
        var modalBodySummary = cartoonmoviesModal.querySelector('#cartoonmoviesSummary')
        var modalBodyGenre = cartoonmoviesModal.querySelector('#cartoonmoviesGenre')
        var modalBodyDirector = cartoonmoviesModal.querySelector('#cartoonmoviesDirector')
        var modalBodyRating = cartoonmoviesModal.querySelector('#cartoonmoviesRating')
        var modalBodyYear = cartoonmoviesModal.querySelector('#cartoonmoviesYear')
        var modalBodyImage = cartoonmoviesModal.querySelector('#cartoonmoviesImage')
        var modalBodyCast = cartoonmoviesModal.querySelector('#cartoonmoviesCast')

        modalTitle.textContent = 'Cartoon Movie Details: ' + name
        modalBodyName.textContent = name
        modalBodySummary.textContent = summary
        modalBodyGenre.textContent = genre
        modalBodyDirector.textContent = director
        modalBodyRating.textContent = rating
        modalBodyYear.textContent = year
        modalBodyImage.src = img
        modalBodyCast.textContent = cast

        var castArray = cast.split(';');
        var carouselInner = cartoonmoviesModal.querySelector('#cartoonmoviesCastCarousel');
        carouselInner.innerHTML = '';
        castArray.forEach(function(castMember, index) {
            var [castName, castImg] = castMember.split('|');
            if (castName && castImg) {
                var div = document.createElement('div');
                div.className = index === 0 ? 'carousel-item active' : 'carousel-item';
                div.innerHTML = `
                    <div>
                        <p><strong>Name:</strong> ${castName}</p>
                        <img src="${castImg}" alt="Cast Image" style="max-width: 100px; border: 2px solid black; border-radius: 50px;">
                    </div>
                `;
                carouselInner.appendChild(div);
            }
        });
    })
});