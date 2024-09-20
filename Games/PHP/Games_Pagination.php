<?php
// Assuming database connection is established and stored in $conn

// Get the current page and entries per page from query parameters
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 20; // Default to 20 entries
$offset = ($current_page - 1) * $limit;

// Get the search keyword from the request
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Prepare the search query
$search_query = '';
if (!empty($search)) {
    // Modify the query to search by name, year, and director
    $search_query = "WHERE name LIKE '%" . $conn->real_escape_string($search) . "%' 
                     OR year LIKE '%" . $conn->real_escape_string($search) . "%' 
                     OR genre LIKE '%" . $conn->real_escape_string($search) . "%'";
}

// Fetch total number of records based on search
$count_query = "SELECT COUNT(*) AS total FROM games $search_query";
$count_result = $conn->query($count_query);
$total_records = $count_result->fetch_assoc()['total'];

// Fetch movies for the current page based on search
$query = "SELECT * FROM games $search_query LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

// Calculate total pages
$total_pages = ceil($total_records / $limit);
?>