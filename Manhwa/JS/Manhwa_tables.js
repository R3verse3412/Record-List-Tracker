$(document).ready(function() {
    $('#Manhwa').DataTable();
});

   
// Event listener for opening the modal
$('#manhwaModal').on('show.bs.modal', function (event) {
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
    modal.find('#manhwaTitle').text(title);
    modal.find('#manhwaAuthor').text(author);
    modal.find('#manhwaGenre').text(genre);
    modal.find('#manhwaStatus').text(status);
    modal.find('#manhwaRelease_Date').text(release_date);
    modal.find('#manhwaImage').attr('src', img);
    modal.find('#manhwaDescription').text(description);
    modal.find('#manhwaRating').text(rating);
});