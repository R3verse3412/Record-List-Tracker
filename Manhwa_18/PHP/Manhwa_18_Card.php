<?php
            // ... (previous code remains the same)

            function truncateTitle($title, $limit = 25) {
                if (strlen($title) > $limit) {
                    return substr($title, 0, $limit) . '...';
                }
                return $title;
            }
            // Inside the loop where we generate the cards:
if ($result->num_rows > 0) {
    echo '<div class="row row-cols-1 row-cols-md-2 row-cols-lg-5 g-4">';
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col manhwa_18-card">
            <div class="card h-100 shadow">
                <div class="card-img-top d-flex justify-content-center align-items-center" style="height: 250px;">
                    <img src="' . htmlspecialchars($row['img']) . '" alt="" class="img-fluid movie-poster" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-title" title="' . htmlspecialchars($row['title']) . '">' . truncateTitle($row['title']) . '</h5>
                    <p class="card-text text-year">' . htmlspecialchars($row['release_date']) . '</p>
                    <div class="mt-auto d-flex justify-content-evenly">
                        <a href="Manhwa_18_edit.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm">Edit</a>
                        <a href="Manhwa_18_Details.php?id=' . $row['id'] . '" class="btn btn-success btn-sm">See</a>
                        <a href="Manhwa_18_delete.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm">Delete</a>
                    </div>
                </div>
            </div>
        </div>';
    }
    echo '</div>';
}
?>