<?php
include 'db_connection.php'; // Include database connection

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $clientId = $_GET['id'];

    // Fetch the client details from the database based on the provided id
    $sql = "SELECT * FROM Clients WHERE id = $clientId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Get the client data
        $client = $result->fetch_assoc();
    } else {
        echo "Client not found.";
        exit;
    }
} else {
    echo "Client ID is missing.";
    exit;
}

// Update client details if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];

    // Simple update query
    $updateSql = "UPDATE Clients SET name = '$name', address = '$address', phone_number = '$phone_number', email = '$email' WHERE id = $clientId";

    if ($conn->query($updateSql) === TRUE) {
        echo "Client updated successfully!";
        header("Location: view_clients.php"); // Redirect to the clients list page
        exit;
    } else {
        echo "Error updating client: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Client</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar Section -->
    <nav class="bg-blue-600 text-white p-4 shadow">
        <ul class="flex justify-around">
            <li><a href="index.html" class="hover:text-gray-200">Add Client</a></li>
            <li><a href="view_clients.php" class="hover:text-gray-200">View Clients</a></li>
            <li><a href="view_cars.php" class="hover:text-gray-200">View Cars</a></li>
            <li><a href="add_car.php" class="hover:text-gray-200">Add Cars</a></li>
            <li><a href="add_rental_contract.php" class="hover:text-gray-200">Add Rental Contracts</a></li>
            <li><a href="add_rental_contract.php" class="hover:text-gray-200">Add Rental Contract</a></li>
            <li><a href="view_rental_contracts.php" class="hover:text-gray-200">View Rental Contracts</a></li>
        </ul>
    </nav>

    <!-- Edit Client Content -->
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold text-gray-700 text-center mb-6">Edit Client</h1>

        <!-- Client Edit Form -->
        <form action="edit_client.php?id=<?php echo $clientId; ?>" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-lg mx-auto">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $client['name']; ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo $client['address']; ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-2">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" value="<?php echo $client['phone_number']; ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $client['email']; ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Client</button>
                <a href="view_clients.php" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Cancel</a>
            </div>
        </form>
    </div>

</body>
</html>
