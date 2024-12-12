<?php
session_start();

if (!isset($_SESSION['token'])) {
    header("Location: login.php");
    exit();
}

include 'db_connection.php';

$token = $_SESSION['token'];

// Validate token
$sql = "SELECT users.username FROM personal_access_tokens 
        JOIN users ON personal_access_tokens.user_id = users.id 
        WHERE personal_access_tokens.token = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $username = $user['username'];
} else {
    session_destroy();
    header("Location: login.php");
    exit();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Navbar Section -->
    <nav class="bg-blue-600 text-white p-4 shadow">
        <ul class="flex justify-around">
        <li><a href="adduser.html" class="hover:text-gray-200">Add Client</a></li>
            <li><a href="view_clients.php" class="hover:text-gray-200">View Clients</a></li>
            <li><a href="view_cars.php" class="hover:text-gray-200">View Cars</a></li>
            <li><a href="add_car.php" class="hover:text-gray-200">Add Cars</a></li>
            <li><a href="add_rental_contract.php" class="hover:text-gray-200">Add Rental Contracts</a></li>
            <li><a href="add_rental_contract.php" class="hover:text-gray-200">Add Rental Contract</a></li>
            <li><a href="view_rental_contracts.php" class="hover:text-gray-200">View Rental Contracts</a></li>
            <li><a href="logout.php" class="hover:text-gray-200">Logout</a></li>
        </ul>
    </nav>

    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold text-gray-700 text-center">Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        <p class="text-center mt-4">You are now logged in. Use the navigation bar to explore the application.</p>
    </div>
</body>
</html>
