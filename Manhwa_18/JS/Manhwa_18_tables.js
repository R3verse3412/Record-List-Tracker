$(document).ready(function() {
    $('#Manhwa_18').DataTable();
});

  // Event listener for opening the modal
  $('#manhwa_18Modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var title = button.data('title');
    var author = button.data('author');
    var genre = button.data('genre');
    var status = button.data('status');
    var release_date = button.data('release_date');
    var img = button.data('img');
    var description = button.data('description');
    var rating = button.data('rating');

    // Update the modal's content
    var modal = $(this);
    modal.find('#manhwa_18Title').text(title);
    modal.find('#manhwa_18Author').text(author);
    modal.find('#manhwa_18Genre').text(genre);
    modal.find('#manhwa_18Status').text(status);
    modal.find('#manhwa_18Release_Date').text(release_date);
    modal.find('#manhwa_18Image').attr('src', img);
    modal.find('#manhwa_18Description').text(description);
    modal.find('#manhwa_18Rating').text(rating);
});