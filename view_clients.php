<?php
include 'db_connection.php'; // Include database connection

$sql = "SELECT * FROM Clients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Clients</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="navStyle.css">
</head>
<body>

    <!-- Navbar Section -->
    <nav class="navbar">
        <ul>
            <li><a href="add_client_form.php">Add Client</a></li>
            <li><a href="view_clients.php">View Clients</a></li>
        </ul>
    </nav>

    <!-- View Clients Content -->
    <h1>Clients List</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['address']}</td>
                        <td>{$row['phone_number']}</td>
                        <td>{$row['email']}</td>
                        <td>
                            <a href='edit_client.php?id={$row['id']}'>Edit</a> | 
                            <a href='delete_client.php?id={$row['id']}'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No clients found.</td></tr>";
        }

        $conn->close();
        ?>
    </table>

</body>
</html>
