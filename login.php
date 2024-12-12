<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Generate a secure token
            $token = bin2hex(random_bytes(32));

            // Insert token into personal_access_tokens table
            $insertTokenSql = "INSERT INTO personal_access_tokens (user_id, token) VALUES (?, ?)";
            $tokenStmt = $conn->prepare($insertTokenSql);
            $tokenStmt->bind_param("is", $user['id'], $token);
            $tokenStmt->execute();

            // Save token in session
            $_SESSION['token'] = $token;

            // Redirect to the homepage
            header("Location: index.php");
            exit();
        }
    }

    // Invalid credentials
    echo "Invalid username or password.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded shadow-md w-96">
        <h1 class="text-2xl font-bold mb-4">Login</h1>
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
                <label class="block text-gray-700">Password:</label>
                <input type="password" name="password" required class="shadow appearance-none border rounded w-full py-2 px-3">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full">Login</button>
        </form>
    </div>
</body>
</html>
