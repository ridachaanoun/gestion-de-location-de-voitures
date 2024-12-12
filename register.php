<?php
include 'db_connection.php'; // Include database connection

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate input
    if (!empty($username) && !empty($email) && !empty($password) && !empty($confirm_password)) {
        if ($password === $confirm_password) {
            // Check if the username or email already exists
            $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insert the new user
                $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $username, $email, $hashed_password);

                if ($stmt->execute()) {
                    header("Location: login.php"); // Redirect to login page
                    exit;
                } else {
                    $error = "Error registering user. Please try again.";
                }
            } else {
                $error = "Username or email already exists.";
            }
            $stmt->close();
        } else {
            $error = "Passwords do not match.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded shadow-md w-96">
        <h1 class="text-2xl font-bold mb-4">Register</h1>
        <?php if (isset($error)): ?>
            <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-4">
                <label class="block text-gray-700">Username:</label>
                <input type="text" name="username" required class="shadow appearance-none border rounded w-full py-2 px-3">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Email:</label>
                <input type="email" name="email" required class="shadow appearance-none border rounded w-full py-2 px-3">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Password:</label>
                <input type="password" name="password" required class="shadow appearance-none border rounded w-full py-2 px-3">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Confirm Password:</label>
                <input type="password" name="confirm_password" required class="shadow appearance-none border rounded w-full py-2 px-3">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full">Register</button>
        </form>
    </div>
</body>
</html>
