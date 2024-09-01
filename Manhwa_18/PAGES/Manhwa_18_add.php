<?php include "../PHP/Manhwa_18_add.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD</title>
    <?php include "../../header.php" ?>
</head>
<body>
<?php include "../../nav_user.php" ?>

<div class="container">
    <div class="text-center mb-4">
        <h3>Add New Manhwa 18</h3>
        <p class="text-muted">Complete the form below to add a new Manhwa 18</p>
    </div>

    <div class="container d-flex justify-content-center">
        <form action="" method="post" enctype="multipart/form-data" style="width: 50vw; min-width: 300px;">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="Title" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Author</label>
                    <input type="text" class="form-control" name="author" placeholder="Author" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Genre</label>
                <input type="text" class="form-control" name="genre" placeholder="Genre" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Release Date</label>
                <input type="number" class="form-control" name="release_date" placeholder="Year" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Rating</label>
                <input type="number" class="form-control" name="rating" min="1" max="10">
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="Complete">Complete</option>
                    <option value="Ongoing">Ongoing</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Choose Image</label>
                <input type="file" class="form-control-file" id="img" name="img" required>
            </div>
            <div class="mb-5 d-flex justify-content-center">
                <div class="">
                <button type="submit" class="btn btn-success" name="submit">Save</button>
                <a href="Manhwa_18.php" class="btn btn-danger">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include "../../Footer.php" ?>
</body>
</html>
