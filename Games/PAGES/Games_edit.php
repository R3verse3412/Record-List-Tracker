<?php include "../PHP/Games_Edit.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD - Edit Anime Series</title>
    <?php include "../../header.php"?>
</head>

<body>
    <?php include "../../nav_user.php"?>
    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit Games</h3>
            <p class="text-muted">Update the details of the anime series</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" enctype="multipart/form-data" style="width: 50vw; min-width: 300px;">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($name); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Summary</label>
                    <textarea class="form-control" name="summary"
                        rows="3"><?php echo htmlspecialchars($summary); ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Genre</label>
                    <input type="text" class="form-control" name="genre"
                        value="<?php echo htmlspecialchars($genre); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Year</label>
                    <input type="number" class="form-control" name="year"
                        value="<?php echo htmlspecialchars($year); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Rating</label>
                    <input type="number" class="form-control" name="rating"
                        value="<?php echo htmlspecialchars($rating); ?>" min="1" max="10">
                </div>
                <div class="mb-3">
                    <label class="form-label">Publisher</label>
                    <input type="text" class="form-control" name="publisher"
                        value="<?php echo htmlspecialchars($publisher); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Studio</label>
                    <input type="text" class="form-control" name="studio"
                        value="<?php echo htmlspecialchars($studio); ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Device</label>
                    <select class="form-control" name="device">
                        <option value="Mobile Phone" <?php if ($device == 'Mobile Phone') echo 'selected'; ?>>Mobile
                            Phone</option>
                        <option value="PC" <?php if ($device == 'PC') echo 'selected'; ?>>PC</option>
                        <option value="Playstation" <?php if ($device == 'Playstation') echo 'selected'; ?>>Playstation
                        </option>
                        <option value="Xbox" <?php if ($device == 'Xbox') echo 'selected'; ?>>Xbox</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Current Image</label><br>
                    <?php if (!empty($img)): ?>
                    <img src="<?php echo htmlspecialchars($img); ?>" alt="Current Image" style="max-width: 200px;"><br>
                    <?php endif; ?>
                    <label class="form-label">Update Image</label>
                    <input type="file" class="form-control" name="img">
                    <input type="hidden" name="current_img" value="<?php echo htmlspecialchars($img); ?>">
                </div>
                <div class="mb-5 d-flex justify-content-center">
                    <div class="">
                    <button type="submit" class="btn btn-success" name="submit">Update</button>
                    <a href="Games.php" class="btn btn-danger">Cancel</a>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    include "../../Footer.php"
?>
</body>

</html>