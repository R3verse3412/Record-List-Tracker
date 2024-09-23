<style>
    @media (max-width: 768px) {
    /* Adjust the pagination item size */
    .pagination .page-link {
        padding: 0.5rem 0.75rem; /* Smaller padding for smaller screens */
        font-size: 14px; /* Reduce font size */
    }

    /* Stack pagination items vertically (optional) */
    .pagination {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    /* Hide ellipsis on small screens */


    /* Hide some page numbers for compactness */
    .pagination .page-item:nth-child(n+3):nth-last-child(n+3) {
        display: none;
    }

    /* Ensure that 'Previous' and 'Next' buttons are visible */
    .pagination .page-item:first-child,
    .pagination .page-item:last-child {
        display: inline-block;
    }

    /* Add some spacing */
    .pagination .page-item {
        margin: 2px;
    }
}

</style>
<nav aria-label="Pagination">
    <ul class="pagination">
        <!-- Get current query string and append it to the pagination links -->
        <?php
        $query_string = $_SERVER['QUERY_STRING'];
        // Remove any existing page parameter from the query string
        $query_string = preg_replace('/([&?]page=\d+)/', '', $query_string);
        $query_string = $query_string ? '&' . $query_string : '';

        // Previous Button
        ?>
        <li class="page-item <?php if ($current_page == 1) echo 'disabled'; ?>">
            <a class="page-link" href="American_TV_Series.php?page=<?php echo max(1, $current_page - 1) . $query_string; ?>">Previous</a>
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
            echo '<li class="page-item"><a class="page-link" href="American_TV_Series.php?page=1' . $query_string . '">1</a></li>';
            if ($start_page > 2) {
                echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
            }
        }

        // Show range of pages around the current page
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
        ?>

        <!-- Next Button -->
        <li class="page-item <?php if ($current_page == $total_pages) echo 'disabled'; ?>">
            <a class="page-link" href="American_TV_Series.php?page=<?php echo min($total_pages, $current_page + 1) . $query_string; ?>">Next</a>
        </li>
    </ul>
</nav>
