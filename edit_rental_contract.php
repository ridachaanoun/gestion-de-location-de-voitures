<?php
include 'db_connection.php'; // Include database connection

// Check if 'id' is passed in the URL
if (isset($_GET['id'])) {
    $contractId = $_GET['id'];

    // Fetch the rental contract details from the database
    $sql = "SELECT rc.*, c.name AS client_name, cr.make AS car_make, cr.model AS car_model FROM RentalContracts rc
            JOIN Clients c ON rc.client_id = c.id
            JOIN Cars cr ON rc.car_id = cr.id
            WHERE rc.id = $contractId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $contract = $result->fetch_assoc();
    } else {
        echo "Rental contract not found.";
        exit;
    }
} else {
    echo "Contract ID is missing.";
    exit;
}

// Update rental contract details if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $clientId = $_POST['client_id'];
    $carId = $_POST['car_id'];
    $rentalDate = $_POST['rental_date'];
    $returnDate = $_POST['return_date'];
    $totalAmount = $_POST['total_amount'];

    // Simple update query
    $updateSql = "UPDATE RentalContracts SET client_id = '$clientId', car_id = '$carId', rental_date = '$rentalDate', return_date = '$returnDate', total_amount = '$totalAmount' WHERE id = $contractId";

    if ($conn->query($updateSql) === TRUE) {
        header("Location: view_rental_contracts.php"); // Redirect to the rental contracts list page
        exit;
    } else {
        echo "Error updating rental contract: " . $conn->error;
    }
}

// Fetch clients and cars for dropdown options
$clientsResult = $conn->query("SELECT id, name FROM Clients");
$carsResult = $conn->query("SELECT id, make, model FROM Cars");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Rental Contract</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar Section -->
    <nav class="bg-blue-600 text-white p-4 shadow">
        <ul class="flex justify-around">
            <li><a href="add_client_form.php" class="hover:text-gray-200">Add Client</a></li>
            <li><a href="view_clients.php" class="hover:text-gray-200">View Clients</a></li>
            <li><a href="add_car.php" class="hover:text-gray-200">Add Car</a></li>
            <li><a href="view_cars.php" class="hover:text-gray-200">View Cars</a></li>
            <li><a href="add_rental_contract.php" class="hover:text-gray-200">Add Rental Contract</a></li>
            <li><a href="view_rental_contracts.php" class="hover:text-gray-200">View Rental Contracts</a></li>
        </ul>
    </nav>

    <!-- Edit Rental Contract Form -->
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold text-gray-700 text-center mb-6">Edit Rental Contract</h1>

        <form action="edit_rental_contract.php?id=<?php echo $contractId; ?>" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 max-w-lg mx-auto">
            <div class="mb-4">
                <label for="client_id" class="block text-gray-700 text-sm font-bold mb-2">Client:</label>
                <select name="client_id" id="client_id" class="shadow appearance-none border rounded w-full py-2 px-3">
                    <?php while ($client = $clientsResult->fetch_assoc()) { ?>
                        <option value="<?php echo $client['id']; ?>" <?php echo ($client['id'] == $contract['client_id']) ? 'selected' : ''; ?>>
                            <?php echo $client['name']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="car_id" class="block text-gray-700 text-sm font-bold mb-2">Car:</label>
                <select name="car_id" id="car_id" class="shadow appearance-none border rounded w-full py-2 px-3">
                    <?php while ($car = $carsResult->fetch_assoc()) { ?>
                        <option value="<?php echo $car['id']; ?>" <?php echo ($car['id'] == $contract['car_id']) ? 'selected' : ''; ?>>
                            <?php echo $car['make'] . ' ' . $car['model']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="rental_date" class="block text-gray-700 text-sm font-bold mb-2">Rental Date:</label>
                <input type="date" id="rental_date" name="rental_date" value="<?php echo $contract['rental_date']; ?>" required class="shadow appearance-none border rounded w-full py-2 px-3">
            </div>

            <div class="mb-4">
                <label for="return_date" class="block text-gray-700 text-sm font-bold mb-2">Return Date:</label>
                <input type="date" id="return_date" name="return_date" value="<?php echo $contract['return_date']; ?>" class="shadow appearance-none border rounded w-full py-2 px-3">
            </div>

            <div class="mb-4">
                <label for="total_amount" class="block text-gray-700 text-sm font-bold mb-2">Total Amount:</label>
                <input type="number" id="total_amount" name="total_amount" value="<?php echo $contract['total_amount']; ?>" required class="shadow appearance-none border rounded w-full py-2 px-3">
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update Contract</button>
                <a href="view_rental_contracts.php" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Cancel</a>
            </div>
        </form>
    </div>

</body>
</html>
