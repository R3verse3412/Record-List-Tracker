


// Event listener for opening the modal
$('#animeseriesModal').on('show.bs.modal', function (event) {
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
    modal.find('#animeseriesName').text(name);
    modal.find('#animeseriesSummary').text(summary);
    modal.find('#animeseriesGenre').text(genre);
    modal.find('#animeseriesRating').text(rating);
    modal.find('#animeseriesYear').text(year);
    modal.find('#animeseriesImage').attr('src', img);
    modal.find('#animeseriesEpisodes').text(episodes);
    modal.find('#animeseriesStudio').text(studio);
});