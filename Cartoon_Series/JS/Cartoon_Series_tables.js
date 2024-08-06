new DataTable('#Cartoon_Series');

// Event listener for opening the modal
$('#cartoonseriesModal').on('show.bs.modal', function (event) {
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