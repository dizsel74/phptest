<?php
include "connect.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM `items` WHERE id=$id";
    $conn->query($sql);
   
    // Check for sucessful on deletion 
    if ($conn->affected_rows > 0) {
        
        header('location:/phptest/items.php');
        exit;
    } else {
        // If not deletion show error
        echo "Error deleting item: " . $conn->error;
    }
} else {
    // no ID cgo back to 
    header('location:/phptest/items.php');
    exit;
}
//close conection
$conn->close();

?>