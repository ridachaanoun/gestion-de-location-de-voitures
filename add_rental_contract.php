<?php
include 'db_connection.php';

// Fetch all clients from the Clients table
$sql = "SELECT id, name FROM Clients";
$clientsResult = $conn->query($sql);

// Fetch all cars from the Cars table (if needed)
$carsResult = $conn->query("SELECT id, make, model FROM Cars");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $client_id = $_POST['client_id'];
    $car_id = $_POST['car_id'];
    $rental_date = $_POST['rental_date'];
    $return_date = $_POST['return_date'];
    $total_amount = $_POST['total_amount'];

    // Insert rental contract into database
    $insertSql = "INSERT INTO RentalContracts (client_id, car_id, rental_date, return_date, total_amount)
                  VALUES ('$client_id', '$car_id', '$rental_date', '$return_date', '$total_amount')";

    if ($conn->query($insertSql) === TRUE) {
        echo "Rental contract added successfully!";
        header("Location: view_rental_contracts.php");
        exit;
    } else {
        echo "Error adding rental contract: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Rental Contract</title>
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

    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold text-gray-700 text-center mb-6">Add Rental Contract</h1>

        <!-- Rental Contract Form -->
        <form action="add_rental_contract.php" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 max-w-lg mx-auto">
            <div class="mb-4">
                <label for="client_id" class="block text-gray-700 text-sm font-bold mb-2">Client:</label>
                <select name="client_id" id="client_id" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select Client</option>
                    <?php
                    if ($clientsResult->num_rows > 0) {
                        while ($client = $clientsResult->fetch_assoc()) {
                            echo "<option value='{$client['id']}'>{$client['name']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="car_id" class="block text-gray-700 text-sm font-bold mb-2">Car:</label>
                <select name="car_id" id="car_id" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Select Car</option>
                    <?php
                    if ($carsResult->num_rows > 0) {
                        while ($car = $carsResult->fetch_assoc()) {
                            echo "<option value='{$car['id']}'> {$car['make']} - {$car['model']} </option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="rental_date" class="block text-gray-700 text-sm font-bold mb-2">Rental Date:</label>
                <input type="date" name="rental_date" id="rental_date" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="return_date" class="block text-gray-700 text-sm font-bold mb-2">Return Date:</label>
                <input type="date" name="return_date" id="return_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <div class="mb-4">
                <label for="total_amount" class="block text-gray-700 text-sm font-bold mb-2">Total Amount:</label>
                <input type="number" name="total_amount" id="total_amount" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" step="0.01">
            </div>

            <div class="flex justify-between">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Rental Contract</button>
                <a href="view_rental_contracts.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
            </div>
        </form>
    </div>

</body>
</html>

<?php
$conn->close();
?>
