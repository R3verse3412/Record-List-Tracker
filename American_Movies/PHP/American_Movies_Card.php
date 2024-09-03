<?php
                        // Card for American Movies                   
                        // ... (previous code remains the same)
        
                        function truncateTitle($title, $limit = 50) {
                            if (strlen($title) > $limit) {
                                return substr($title, 0, $limit) . '...';
                            }
                            return $title;
                        }
        
                        // ... (database connection and query code remains the same)
        
                        // Inside the loop where we generate the cards:
                        if ($result->num_rows > 0) {
                            echo '<div class="row row-cols-1 row-cols-md-2 row-cols-lg-5 g-4">';
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="col movie-card">
                                    <div class="card h-100 shadow">
                                        <div class="card-img-top d-flex justify-content-center align-items-center" style="height: 250px;">
                                            <img src="' . htmlspecialchars($row['img']) . '" alt="" class="img-fluid movie-poster" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                        </div>
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title text-title" title="' . htmlspecialchars($row['name']) . '">' . truncateTitle($row['name']) . '</h5>
                                            <p class="card-text text-year">' . htmlspecialchars($row['year']) . '</p>
                                       <p class="text-director">'. htmlspecialchars($row['director']) .'</p>
                                            <div class="mt-auto d-flex justify-content-evenly">
                                                <a href="edit.php?id=' . $row['id'] . '" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="details.php?id=' . $row['id'] . '" class="btn btn-success btn-sm">See</a>
                                                <a href="delete.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                            }
                            echo '</div>';
                        }
                        ?>
