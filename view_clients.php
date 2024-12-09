<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Clients</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar Section -->
    <nav class="bg-blue-600 text-white p-4 shadow">
        <ul class="flex justify-around">
            <li><a href="index.html" class="hover:text-gray-200">Add Client</a></li>
            <li><a href="view_clients.php" class="hover:text-gray-200">View Clients</a></li>
            <li><a href="edit_client.php" class="hover:text-gray-200">Edit Client</a></li>
            <li><a href="delete_client.php" class="hover:text-gray-200">Delete Client</a></li>
        </ul>
    </nav>

    <!-- View Clients Content -->
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold text-gray-700 mb-4 text-center">Clients List</h1>
        <table class="min-w-full bg-white shadow rounded-lg">
            <thead>
                <tr class="bg-gray-200 text-gray-600 text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Address</th>
                    <th class="py-3 px-6 text-left">Phone Number</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php
                include 'db_connection.php'; // Include database connection
                $sql = "SELECT * FROM Clients";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class='border-b border-gray-200 hover:bg-gray-100'>
                                <td class='py-3 px-6 text-left'>{$row['id']}</td>
                                <td class='py-3 px-6 text-left'>{$row['name']}</td>
                                <td class='py-3 px-6 text-left'>{$row['address']}</td>
                                <td class='py-3 px-6 text-left'>{$row['phone_number']}</td>
                                <td class='py-3 px-6 text-left'>{$row['email']}</td>
                                <td class='py-3 px-6 text-center'>
                                    <button class='bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600' onclick='showModal({$row['id']})'>Delete</button>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='py-3 px-6 text-center'>No clients found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-lg font-bold text-gray-700">Confirm Deletion</h2>
            <p class="text-gray-600 mt-4">Are you sure you want to delete this client?</p>
            <div class="flex justify-between mt-6">
                <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" id="confirmDelete">Yes, Delete</button>
                <button class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400" onclick="closeModal()">Cancel</button>
            </div>
        </div>
    </div>
<script src="viewC.js"></script>
</body>
</html>
