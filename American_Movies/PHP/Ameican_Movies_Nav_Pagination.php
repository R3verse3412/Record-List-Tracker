<nav aria-label="Pagination">
    <ul class="pagination">
        <!-- Previous Button -->
        <li class="page-item <?php if ($current_page == 1) echo 'disabled'; ?>">
            <a class="page-link" href="?page=<?php echo max(1, $current_page - 1); ?>&limit=<?php echo $limit; ?>">Previous</a>
        </li>

        <!-- Page Numbers -->
        <?php
        // Define how many page numbers to show
        $page_range = 5;
        $start_page = max(1, $current_page - floor($page_range / 2));
        $end_page = min($total_pages, $start_page + $page_range - 1);

        // Adjust start_page if at the end of the page range
        if ($end_page - $start_page + 1 < $page_range) {
            $start_page = max(1, $end_page - $page_range + 1);
        }

        // Show first page and ellipsis if needed
        if ($start_page > 1) {
            echo '<li class="page-item"><a class="page-link" href="?page=1&limit=' . $limit . '">1</a></li>';
            if ($start_page > 2) {
                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }
        }

        // Show range of pages around the current page
        for ($i = $start_page; $i <= $end_page; $i++) {
            echo '<li class="page-item ' . ($i == $current_page ? 'active' : '') . '">
                    <a class="page-link" href="?page=' . $i . '&limit=' . $limit . '">' . $i . '</a>
                  </li>';
        }

        // Show ellipsis and last page if needed
        if ($end_page < $total_pages) {
            if ($end_page < $total_pages - 1) {
                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }
            echo '<li class="page-item"><a class="page-link" href="?page=' . $total_pages . '&limit=' . $limit . '">' . $total_pages . '</a></li>';
        }
        ?>

        <!-- Next Button -->
        <li class="page-item <?php if ($current_page == $total_pages) echo 'disabled'; ?>">
            <a class="page-link" href="?page=<?php echo min($total_pages, $current_page + 1); ?>&limit=<?php echo $limit; ?>">Next</a>
        </li>
    </ul>
</nav>