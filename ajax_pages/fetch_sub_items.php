<?php
// Database connection
include '../backend/conn.php';

if (isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];

    // Fetch sub-items for the selected item
    $sql_sub_items = "SELECT * FROM tbl_sub_items WHERE item_id = ?";
    $stmt = $conn->prepare($sql_sub_items);
    $stmt->bind_param("i", $item_id); // Bind the item ID as an integer
    $stmt->execute();
    $result = $stmt->get_result();

    // Generate sub-item options
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<option value="' . $row['sub_name'] . '">' . $row['sub_name'] . '</option>';
        }
    } else {
        echo '<option value="">No Sub Items Found</option>';
    }

    $stmt->close();
}
?>
