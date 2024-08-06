$(document).ready(function() {
    $('#Manga').DataTable();
});

   
// Event listener for opening the modal
$('#mangaModal').on('show.bs.modal', function (event) {
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
    modal.find('#mangaTitle').text(title);
    modal.find('#mangaAuthor').text(author);
    modal.find('#mangaGenre').text(genre);
    modal.find('#mangaStatus').text(status);
    modal.find('#mangaRelease_Date').text(release_date);
    modal.find('#mangaImage').attr('src', img);
    modal.find('#mangaDescription').text(description);
    modal.find('#mangaRating').text(rating);
});