<?php
include 'db_connection.php'; // Include database connection


if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql="DELETE FROM rentalcontracts where id= $id";
    if ($conn->query($sql)==TRUE) {
        header("Location: view_rental_contracts.php");
    }else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>