<?php require "../config/config.php"; ?>
<?php
$error_message = '';
$success_message = '';
$name = '';
$email = '';
$password = '';
$confirm_password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    $insert = $conn->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");

    $insert->execute([
        ':name' => $name,
        ':email' => $email,
        ':password' => password_hash($password, PASSWORD_DEFAULT)
    ]);

    header("Location: login.php");

    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        $error_message = "Please fill up the form.";
    } else {
        if ($password !== $confirm_password) {
            $error_message = "Passwords do not match.";
        } else {
            $success_message = "";
            $name = '';
            $email = '';
            $password = '';
            $confirm_password = '';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        .register-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 300px;
            text-align: center;
        }
        .register-container h2 {
            margin: 0 0 20px;
            font-size: 1.5em;
        }
        .register-container input {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }
        .register-container button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #efaaaa;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .register-container button:hover {
            background-color: #e0e0e0;
        }
        .register-container a {
            color: #000dff;
            text-decoration: none;
            font-size: 0.9em;
        }
        .register-container a:hover {
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
        .success-message {
            color: green;
            font-size: 0.9em;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <?php require "../includes/header.php"; ?>
    <div class="main-container">
        <div class="register-container">
            <h2>Register</h2>
            <?php if ($error_message): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <div id="success-container" style="display: <?php echo $success_message ? 'block' : 'none'; ?>">
                <?php if ($success_message): ?>
                    <p class="success-message"><?php echo $success_message; ?></p>
                <?php endif; ?>
            </div>
            <form method="POST" action="register.php">
                <input type="text" name="name" placeholder="Name" value="<?php echo htmlspecialchars($name); ?>" required>
                <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required>
                <input type="password" name="password" placeholder="Password" value="<?php echo htmlspecialchars($password); ?>" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" value="<?php echo htmlspecialchars($confirm_password); ?>" required>
                <button type="submit">Sign Up</button>
            </form>
            <p>Have an Account? <a href="#">Login Here</a></p>
        </div>
    </div>
    <?php require "../includes/footer.php"; ?>
</body>
</html>
