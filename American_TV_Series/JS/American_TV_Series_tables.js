new DataTable('#American_TV_Series');

$('#tvModal').on('show.bs.modal', function (event) {
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
    modal.find('#tvName').text(name);
    modal.find('#tvSummary').text(summary);
    modal.find('#tvGenre').text(genre);
    modal.find('#tvDirector').text(director);
    modal.find('#tvRating').text(rating);
    modal.find('#tvYear').text(year);
    modal.find('#tvImage').attr('src', img);

    // Clear previous cast details in the carousel
    modal.find('#tvCastCarousel').empty();

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
                modal.find('#tvCastCarousel').append(castElement);
            }
        });
    }
});