<?php
include 'conn.php';

$startDate = $_POST['startDate'] ?? null;
$endDate = $_POST['endDate'] ?? null;
$searchValue = $_POST['search']['value'] ?? null;

// Base Query
$query = "SELECT or_id, or_number, c_name, city, cod_amount, or_status, or_date, c_phone FROM tbl_orders_backup WHERE 1=1";

// Apply Filters
if (!empty($startDate)) {
    $query .= " AND or_date >= '$startDate'";
}
if (!empty($endDate)) {
    $query .= " AND or_date <= '$endDate'";
}

// Apply Search
if (!empty($searchValue)) {
    $query .= " AND (
        or_number LIKE '%$searchValue%' OR 
        c_name LIKE '%$searchValue%' OR 
        city LIKE '%$searchValue%' OR 
        cod_amount LIKE '%$searchValue%' OR 
        or_status LIKE '%$searchValue%' OR 
        or_date LIKE '%$searchValue%' OR 
        c_phone LIKE '%$searchValue%'
    )";
}

// Pagination and Ordering
$start = $_POST['start'] ?? 0;
$length = $_POST['length'] ?? 10;
$orderColumn = $_POST['order'][0]['column'] ?? 0;
$orderDir = $_POST['order'][0]['dir'] ?? 'asc';

$columns = ['or_id', 'or_number', 'c_name', 'city', 'cod_amount', 'or_status', 'or_date', 'c_phone'];
$orderColumn = $columns[$orderColumn] ?? 'or_id';

$query .= " ORDER BY $orderColumn $orderDir LIMIT $start, $length";

// Fetch Data
$result = $conn->query($query);
$data = $result->fetch_all(MYSQLI_ASSOC);

// Total Records
$totalRecords = $conn->query("SELECT COUNT(*) as total FROM tbl_orders_backup")->fetch_assoc()['total'];

// Total Filtered Records
$totalFilteredQuery = "SELECT COUNT(*) as total FROM tbl_orders_backup WHERE 1=1";

if (!empty($startDate)) {
    $totalFilteredQuery .= " AND or_date >= '$startDate'";
}
if (!empty($endDate)) {
    $totalFilteredQuery .= " AND or_date <= '$endDate'";
}

if (!empty($searchValue)) {
    $totalFilteredQuery .= " AND (
        or_number LIKE '%$searchValue%' OR 
        c_name LIKE '%$searchValue%' OR 
        city LIKE '%$searchValue%' OR 
        cod_amount LIKE '%$searchValue%' OR 
        or_status LIKE '%$searchValue%' OR 
        or_date LIKE '%$searchValue%' OR 
        c_phone LIKE '%$searchValue%'
    )";
}

$totalFiltered = $conn->query($totalFilteredQuery)->fetch_assoc()['total'];

// Prepare Response
$response = [
    "draw" => intval($_POST['draw']),
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalFiltered,
    "data" => $data
];

echo json_encode($response);
?>
