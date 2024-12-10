<?php
include 'db_connection.php';

$sql = "SELECT * FROM cars";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Cars</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

            <!-- Navbar Section -->
    <nav class="bg-blue-600 text-white p-4 shadow">
        <ul class="flex justify-around">
            <li><a href="index.html" class="hover:text-gray-200">Add Client</a></li>
            <li><a href="view_clients.php" class="hover:text-gray-200">View Clients</a></li>
            <li><a href="view_cars.php" class="hover:text-gray-200">View Cars</a></li>
            <li><a href="add_car.php" class="hover:text-gray-200">add Cars</a></li>
        </ul>
    </nav>

    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold text-gray-700 text-center mb-6">Cars List</h1>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4">ID</th>
                    <th class="py-2 px-4">Make</th>
                    <th class="py-2 px-4">Model</th>
                    <th class="py-2 px-4">Year</th>
                    <th class="py-2 px-4">License Plate</th>
                    <th class="py-2 px-4">Status</th>
                    <th class="py-2 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr class="border-b">
                        <td class="py-2 px-4"><?= $row['id'] ?></td>
                        <td class="py-2 px-4"><?= $row['make'] ?></td>
                        <td class="py-2 px-4"><?= $row['model'] ?></td>
                        <td class="py-2 px-4"><?= $row['year'] ?></td>
                        <td class="py-2 px-4"><?= $row['license_plate'] ?></td>
                        <td class="py-2 px-4"><?= $row['status'] ?></td>
                        <td class="py-2 px-4">
                            <a href="edit_car.php?id=<?= $row['id'] ?>" class="text-blue-500 hover:text-blue-700">Edit</a> | 
                            <a href="delete_car.php?id=<?= $row['id'] ?>" class="text-red-500 hover:text-red-700">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
