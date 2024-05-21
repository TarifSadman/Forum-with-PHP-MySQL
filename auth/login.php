<?php require "../config/config.php"; ?>
<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $error_message = '';
    $email = '';
    $password = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $login = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $login->bindParam(':email', $email);
        $login->execute();
        $user = $login->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['id'] = $user['id'];

            header("Location: ../blog.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <?php include "../includes/header.php"; ?>
    <main class="container flex-grow-1 d-flex justify-content-center align-items-center">
        <div class="card shadow-sm p-4 w-100" style="max-width: 400px;">
            <h2 class="card-title text-center mb-4">Login</h2>
            <?php if ($error_message): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <form method="POST" action="login.php">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            <p class="mt-3 text-center">Don't have an account? <a href="register.php">Sign Up Here</a></p>
        </div>
    </main>
    <footer class="bg-light text-center py-3 mt-auto">
        <div class="container">
            © 2024 <a href="https://github.com/TarifSadman" target="_blank">Tarif Sadman</a> &nbsp; All rights reserved.
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlB0D3x2pLtL0t1aELHv/RfSNj3EoX6B8Ge7FhI5VOM8IIaF21FQzpq4In8" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhG8N+YUJPLpKsB+twq4gNIcGxGpCqs5r9bFugs6z0Rfd8bj2j5T6c6f5Tbh" crossorigin="anonymous"></script>
</body>
</html>
