<?php include "../PHP/Cartoon_Movies_edit.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD - Edit American Movie</title>
    <?php
    include "../../header.php"
    ?>
</head>
<body>
<?php
include "../../nav_user.php"
?>
    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit American Movie</h3>
            <p class="text-muted">Update the details of the American movie</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" enctype="multipart/form-data" style="width: 50vw; min-width: 300px;">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($name); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Summary</label>
                    <textarea class="form-control" name="summary" rows="3"><?php echo htmlspecialchars($summary); ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Genre</label>
                    <input type="text" class="form-control" name="genre" value="<?php echo htmlspecialchars($genre); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Year</label>
                    <input type="number" class="form-control" name="year" value="<?php echo htmlspecialchars($year); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Rating</label>
                    <input type="number" class="form-control" name="rating" value="<?php echo htmlspecialchars($rating); ?>" min="1" max="10">
                </div>
                <div class="mb-3">
                    <label class="form-label">Director</label>
                    <input type="text" class="form-control" name="director" value="<?php echo htmlspecialchars($director); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Current Image</label><br>
                    <?php if (!empty($img)): ?>
                    <img src="<?php echo htmlspecialchars($img); ?>" alt="Current Image" style="max-width: 200px;"><br>
                    <?php endif; ?>
                    <label class="form-label">Update Image</label>
                    <input type="file" class="form-control-file" name="img">
                    <input type="hidden" name="current_img" value="<?php echo htmlspecialchars($img); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Cast</label>
                    <div id="cast-container">
                        <?php foreach ($cast_names as $index => $cast_name): ?>
                        <div class="cast-member mb-3">
                            <input type="text" class="form-control mb-2" name="cast_name[]" value="<?php echo htmlspecialchars($cast_name); ?>">
                            <?php if (!empty($cast_imgs[$index])): ?>
                            <img src="<?php echo htmlspecialchars($cast_imgs[$index]); ?>" alt="Cast Image" style="max-width: 100px;"><br>
                            <?php endif; ?>
                            <input type="file" class="form-control-file mb-2" name="cast_img[]">
                            <input type="hidden" name="current_cast_img[]" value="<?php echo htmlspecialchars($cast_imgs[$index]); ?>">
                            <button type="button" class="btn btn-danger" onclick="removeCastMember(this)">Delete</button>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="addCastMember()">Add Cast Member</button>
                </div>
                <div class="mb-5 d-flex justify-content-center">
                    <div class="col-md-auto">
                    <button type="submit" class="btn btn-success" name="submit">Update</button>
                    <a href="Cartoon_Movies.php" class="btn btn-danger">Cancel</a>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    include "../../Footer.php"
?>

    <script src="../JS/Cartoon_Movies_Edit.js"></script>
</body>
</html>

