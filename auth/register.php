<?php require "../config/config.php"; ?>

<?php
$username = '';
$email = '';
$password = '';
$confirm_password = '';
$gender = '';
$phone = '';
$error_message = '';
$success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? '';
    $email = $_POST["email"] ?? '';
    $phone = $_POST["phone"] ?? '';
    $gender = $_POST["gender"] ?? '';
    $password = $_POST["password"] ?? '';
    $confirm_password = $_POST["confirmPassword"] ?? '';

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password) || empty($gender) || empty($phone)) {
        $error_message = "Please fill up the form properly.";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        $insert = $conn->prepare("INSERT INTO users (username, email, password, gender, phone) VALUES (:username, :email, :password, :gender, :phone)");

        $insert->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':gender' => $gender,
            ':phone' => $phone
        ]);

        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="bg-light d-flex flex-column min-vh-100">
    <?php include "../includes/header.php"; ?>
    <main class="container flex-grow-1 d-flex justify-content-center align-items-center">
        <div class="card shadow-sm p-4 w-100" style="max-width: 600px;">
            <h2 class="card-title text-center mb-4">Register</h2>
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($error_message) ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($success_message)): ?>
                <div class="alert alert-success" role="alert">
                    <?= htmlspecialchars($success_message) ?>
                </div>
            <?php endif; ?>
            <form class="row g-3" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <div class="col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($username) ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" name="email" value="<?= htmlspecialchars($email) ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($phone) ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="gender" class="form-label">Gender</label>
                    <select id="gender" class="form-select" name="gender" required>
                        <option selected>Choose...</option>
                        <option value="male" <?= $gender === 'male' ? 'selected' : '' ?>>Male</option>
                        <option value="female" <?= $gender === 'female' ? 'selected' : '' ?>>Female</option>
                        <option value="other" <?= $gender === 'other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" name="password" required>
                </div>
                <div class="col-md-6">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </div>
                <div class="col-12 text-center mt-3">
                    <span>Already have an account? <a href="login.php">Log in</a></span>
                </div>
            </form>
        </div>
    </main>
    <footer class="bg-light text-center py-3 mt-auto fixed-bottom">
        <div class="container">
            © 2024 <a href="https://github.com/TarifSadman" target="_blank">Tarif Sadman</a> &nbsp; All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
