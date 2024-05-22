<?php
 require "../config/config.php"; 

 $title = '';
 $category = '';
 $details = '';
 $error_message = '';
 $success_message = '';
 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $title = $_POST["title"] ?? '';
     $category = $_POST["category"] ?? '';
     $details = $_POST["details"] ?? '';
 
     if (empty($title) || empty($category) || empty($details)) {
         $error_message = "Please fill up the form properly.";
     } else {
         $insert = $conn->prepare("INSERT INTO topics (title, category, details) VALUES (:title, :category, :details)");
 
         $insert->execute([
             ':title' => $title,
             ':category' => $category,
             ':details' => $details,
         ]);

         $stmt = $conn->prepare("SELECT category, title FROM topics");
         $stmt->execute();
         $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);

         header("Location: ../blog.php");
         exit;
     }
 }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Topic</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../styles/createTopic.css" rel="stylesheet">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <h1 class="display-5">Create Topic</h1>
                <p class="lead">You can create a new topic using the form below.</p>
            </div>

            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success_message)): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="create.php">
                <div class="mb-3">
                    <label for="title" class="form-label">Title*</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category*</label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="" selected disabled>Select category</option>
                        <option value="category1">Category 1</option>
                        <option value="category2">Category 2</option>
                        <option value="category3">Category 3</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="details" class="form-label">Details</label>
                    <textarea class="form-control" id="details" name="details" rows="5" placeholder="Enter details" required></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">Create Topic</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
