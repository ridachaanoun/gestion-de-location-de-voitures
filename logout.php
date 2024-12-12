<?php
session_start();

if (isset($_SESSION['token'])) {
    include 'db_connection.php';

    $token = $_SESSION['token'];

    // Delete the token from the database
    $sql = "DELETE FROM personal_access_tokens WHERE token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}

// Destroy the session
session_destroy();
header("Location: login.php");
exit();
?>
