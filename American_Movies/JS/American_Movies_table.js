
new DataTable('#American_Movies');



$('#movieModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var name = button.data('name');
    var summary = button.data('summary');
    var genre = button.data('genre');
    var director = button.data('director');
    var rating = button.data('rating');
    var year = button.data('year');
    var img = button.data('img');
    var cast = button.data('cast');

    var modal = $(this);
    modal.find('#movieName').text(name);
    modal.find('#movieSummary').text(summary);
    modal.find('#movieGenre').text(genre);
    modal.find('#movieDirector').text(director);
    modal.find('#movieRating').text(rating);
    modal.find('#movieYear').text(year);
    modal.find('#movieImage').attr('src', img);

    modal.find('#movieCastCarousel').empty();

    if (cast) {
        var castArray = cast.split(';');
        castArray.forEach(function (castMember, index) {
            var [castName, castImg] = castMember.split('|');
            if (castName && castImg) {
                var activeClass = index === 0 ? 'active' : '';
                var castElement = `
                    <div class="carousel-item ${activeClass}">
                        <div>
                            <p><strong>Name:</strong> ${castName}</p>
                            <img src="${castImg}" alt="Cast Image" style="max-width: 100px; border: 2px solid black; border-radius: 50px;">
                        </div>
                    </div>
                `;
                modal.find('#movieCastCarousel').append(castElement);
            }
        });
    }
});
