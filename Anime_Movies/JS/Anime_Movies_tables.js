new DataTable('#Anime_Movies');


// Event listener for opening the modal
$('#animemoviesModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var name = button.data('name');
    var summary = button.data('summary');
    var genre = button.data('genre');
    var rating = button.data('rating');
    var year = button.data('year');
    var img = button.data('img');
    var episodes = button.data('duration');
    var studio = button.data('studio');

    // Update the modal's content
    var modal = $(this);
    modal.find('#animemoviesName').text(name);
    modal.find('#animemoviesSummary').text(summary);
    modal.find('#animemoviesGenre').text(genre);
    modal.find('#animemoviesRating').text(rating);
    modal.find('#animemoviesYear').text(year);
    modal.find('#animemoviesImage').attr('src', img);
    modal.find('#animemoviesDuration').text(episodes);
    modal.find('#animemoviesStudio').text(studio);
});