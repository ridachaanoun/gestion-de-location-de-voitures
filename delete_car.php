<?php
include 'db_connection.php';

if (isset($_GET['id'])) {
    $carId = $_GET['id'];

    $sql = "DELETE FROM cars WHERE id = $carId";
    if ($conn->query($sql) === TRUE) {
        header('Location: view_cars.php');
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
