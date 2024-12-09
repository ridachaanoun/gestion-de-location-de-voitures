<?php
include 'db_connection.php'; // Include database connection

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $clientId = $_GET['id'];

    // SQL query to delete the client by id
    $sql = "DELETE FROM Clients WHERE id = $clientId";

    if ($conn->query($sql) === TRUE) {
        echo "Client deleted successfully!";
        header("Location: view_clients.php"); // Redirect to clients list page after deletion
        exit;
    } else {
        echo "Error deleting client: " . $conn->error;
    }
} else {
    echo "Client ID is missing.";
}

$conn->close();
?>
