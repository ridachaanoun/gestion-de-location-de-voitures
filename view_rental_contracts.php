<?php
include 'db_connection.php';

$sql = "SELECT RentalContracts.id, RentalContracts.client_id, RentalContracts.car_id, RentalContracts.rental_date, RentalContracts.return_date, RentalContracts.total_amount, Clients.name AS client_name
        FROM RentalContracts
        JOIN Clients ON RentalContracts.client_id = Clients.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Rental Contracts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar Section -->
    <nav class="bg-blue-600 text-white p-4 shadow">
        <ul class="flex justify-around">
            <li><a href="add_rental_contract.php" class="hover:text-gray-200">Add Rental Contract</a></li>
            <li><a href="view_rental_contracts.php" class="hover:text-gray-200">View Rental Contracts</a></li>
        </ul>
    </nav>

    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold text-gray-700 text-center mb-6">Rental Contracts List</h1>

        <table class="min-w-full bg-white shadow-md rounded">
            <thead>
                <tr>
                    <th class="py-2 px-4 border">ID</th>
                    <th class="py-2 px-4 border">Client Name</th> <!-- Show client name -->
                    <th class="py-2 px-4 border">Car ID</th>
                    <th class="py-2 px-4 border">Rental Date</th>
                    <th class="py-2 px-4 border">Return Date</th>
                    <th class="py-2 px-4 border">Total Amount</th>
                    <th class="py-2 px-4 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td class='py-2 px-4 border'>{$row['id']}</td>
                                <td class='py-2 px-4 border'>{$row['client_name']}</td> <!-- Display client name -->
                                <td class='py-2 px-4 border'>{$row['car_id']}</td>
                                <td class='py-2 px-4 border'>{$row['rental_date']}</td>
                                <td class='py-2 px-4 border'>{$row['return_date']}</td>
                                <td class='py-2 px-4 border'>{$row['total_amount']}</td>
                                <td class='py-2 px-4 border'>
                                    <a href='edit_rental_contract.php?id={$row['id']}' class='bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600'>Edit</a>
                                    <a href='delete_rental_contract.php?id={$row['id']}' class='bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600'>Delete</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center py-4'>No rental contracts found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>

<?php
$conn->close();
?>
