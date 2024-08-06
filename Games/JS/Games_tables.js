$(document).ready(function() {
    $('#Games').DataTable();
});


// Event listener for opening the modal
$('#gamesModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var name = button.data('name');
    var summary = button.data('summary');
    var genre = button.data('genre');
    var rating = button.data('rating');
    var year = button.data('year');
    var img = button.data('img');
    var publisher = button.data('publisher');
    var studio = button.data('studio');
    var device = button.data('device');

    // Update the modal's content
    var modal = $(this);
    modal.find('#gamesName').text(name);
    modal.find('#gamesSummary').text(summary);
    modal.find('#gamesGenre').text(genre);
    modal.find('#gamesRating').text(rating);
    modal.find('#gamesYear').text(year);
    modal.find('#gamesImage').attr('src', img);
    modal.find('#gamesPublisher').text(publisher);
    modal.find('#gamesStudio').text(studio);
    modal.find('#gamesDevice').text(device);
});