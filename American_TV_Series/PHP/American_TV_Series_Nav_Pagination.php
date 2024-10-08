<nav aria-label="Pagination">
    <ul class="pagination">
        <?php
        // Get current query string and remove the 'page' parameter if present
        parse_str($_SERVER['QUERY_STRING'], $query_params);
        unset($query_params['page']); // Remove existing 'page' parameter if any
        $query_string = http_build_query($query_params);
        $query_string = $query_string ? '&' . $query_string : '';

        // Previous Button (Disabled if on the first page)
        ?>
        <li class="page-item <?php if ($current_page == 1) echo 'disabled'; ?>">
            <a class="page-link" href="American_TV_Series.php?page=<?php echo max(1, $current_page - 1) . $query_string; ?>">Previous</a>
        </li>

        <?php
        // Define range for visible page numbers
        $page_range = 5;
        $start_page = max(1, $current_page - floor($page_range / 2));
        $end_page = min($total_pages, $start_page + $page_range - 1);

        // Adjust start_page if at the end of the page range
        if ($end_page - $start_page + 1 < $page_range) {
            $start_page = max(1, $end_page - $page_range + 1);
        }

        // Show the first page and ellipsis if needed
        if ($start_page > 1) {
            echo '<li class="page-item"><a class="page-link" href="American_TV_Series.php?page=1' . $query_string . '">1</a></li>';
            if ($start_page > 2) {
                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }
        }

        // Display the range of page numbers
        for ($i = $start_page; $i <= $end_page; $i++) {
            echo '<li class="page-item ' . ($i == $current_page ? 'active' : '') . '">
                    <a class="page-link" href="American_TV_Series.php?page=' . $i . $query_string . '">' . $i . '</a>
                  </li>';
        }

        // Show ellipsis and last page if needed
        if ($end_page < $total_pages) {
            if ($end_page < $total_pages - 1) {
                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }
            echo '<li class="page-item"><a class="page-link" href="American_TV_Series.php?page=' . $total_pages . $query_string . '">' . $total_pages . '</a></li>';
        }

        // Next Button (Disabled if on the last page)
        ?>
        <li class="page-item <?php if ($current_page == $total_pages) echo 'disabled'; ?>">
            <a class="page-link" href="American_TV_Series.php?page=<?php echo min($total_pages, $current_page + 1) . $query_string; ?>">Next</a>
        </li>
    </ul>
</nav>
