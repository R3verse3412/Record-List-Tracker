<?php

if (isset($_SESSION['success_message'])) {
    echo '<div id="successAlert" class="alert alert-success alert-dismissible fade show mt-3 text-center" role="alert">
            ' . $_SESSION['success_message'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    unset($_SESSION['success_message']); // Clear the message after displaying
}

// Add this new block for delete messages
if (isset($_SESSION['delete_message'])) {
    echo '<div id="deleteAlert" class="alert alert-danger alert-dismissible fade show mt-3 text-center" role="alert">
            ' . $_SESSION['delete_message'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    unset($_SESSION['delete_message']); // Clear the message after displaying
}
?>