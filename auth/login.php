<?php require "../config/config.php"; ?>
<?php
$error_message = '';
$email = '';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Check login credentials
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Login successful, redirect to dashboard or another page
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            background-color: #ffd9d9;
            font-family: Arial, sans-serif;
        }
        header {
            background-color: #4a90e2;
            color: white;
            padding: 10px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        header nav {
            display: flex;
            justify-content: center;
            gap: 30px;
        }
        header nav a {
            text-decoration: none;
            color: white;
            font-size: 1em;
            padding: 10px 15px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        header nav a:hover {
            background-color: white;
            color: #4a90e2;
            border-radius: 5px;
        }
        .main-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 300px;
            text-align: center;
        }
        .login-container h2 {
            margin: 0 0 20px;
            font-size: 1.5em;
        }
        .login-container input {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4a90e2;
            color: white;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .login-container button:hover {
            background-color: #357ae8;
        }
        .login-container a {
            color: #000dff;
            text-decoration: none;
            font-size: 0.9em;
        }
        .login-container a:hover {
            text-decoration: underline;
        }
        footer {
            background-color: #e6e6fa;
            text-align: right;
            padding: 10px;
        }
        footer a {
            color: black;
            text-decoration: none;
        }
        .error-message {
            color: red;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php require "../includes/header.php"; ?>
    <div class="main-container">
        <div class="login-container">
            <h2>Login</h2>
            <?php if ($error_message): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <form method="POST" action="login.php">
                <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
            <p>Don't have an account? <a href="register.php">Sign Up Here</a></p>
        </div>
    </div>
    <?php require "../includes/footer.php"; ?>
</body>
</html>
