<?php
// Pagination setup
$limit = isset($_GET['limit']) ? $_GET['limit'] : 20;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Search functionality
$search_query = "";
if (isset($_GET['query'])) {
    $search_query = trim($_GET['query']);
    $sql = "SELECT * FROM anime_series 
            WHERE name LIKE ? OR year LIKE ? OR studio LIKE ? OR genre LIKE ?
            LIMIT ?, ?";
    $stmt = $conn->prepare($sql);
    $search_term = "%" . $search_query . "%";
    $stmt->bind_param('ssssii', $search_term, $search_term, $search_term, $search_term, $start, $limit);
} else {
    // Default query without search
    $sql = "SELECT * FROM anime_series LIMIT ?, ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $start, $limit);
}

// Execute and fetch data
$stmt->execute();
$result = $stmt->get_result();
$total_records = $result->num_rows;
?>
