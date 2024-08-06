new DataTable('#Cartoon_Movies');

$('#cartoonmoviesModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var name = button.data('name');
    var summary = button.data('summary');
    var genre = button.data('genre');
    var director = button.data('director');
    var rating = button.data('rating');
    var year = button.data('year');
    var img = button.data('img');
    var cast = button.data('cast');

    // Update the modal's content
    var modal = $(this);
    modal.find('#cartoonmoviesName').text(name);
    modal.find('#cartoonmoviesSummary').text(summary);
    modal.find('#cartoonmoviesGenre').text(genre);
    modal.find('#cartoonmoviesDirector').text(director);
    modal.find('#cartoonmoviesRating').text(rating);
    modal.find('#cartoonmoviesYear').text(year);
    modal.find('#cartoonmoviesImage').attr('src', img);

    // Clear previous cast details in the carousel
    modal.find('#cartoonmoviesCastCarousel').empty();

    // Parse and display cast members in the carousel
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
                modal.find('#cartoonmoviesCastCarousel').append(castElement);
            }
        });
    }
});