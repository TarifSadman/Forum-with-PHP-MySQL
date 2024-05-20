<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
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
        .container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .container h1 {
            margin: 0;
            font-size: 2em;
        }
        .container p {
            margin: 0;
            font-size: 1em;
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
    </style>
</head>
<body>
    <?php require "includes/header.php"; ?>
    <div class="container">
        <div>
            <h1>WELCOME</h1>
            <h3>to</h3>
            <h1>OUR FORUM</h1>
        </div>
    </div>
    <?php require "includes/footer.php"; ?>
</body>
</html>
