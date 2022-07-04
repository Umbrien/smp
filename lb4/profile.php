<?php
session_start();

if(!isset($_SESSION['login'])) {
    header('Location: page404.php');
}

if(isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not found</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/index.css" />
</head>
<body>
    <?php include 'header.php' ?>
    <h1>Profile</h1>
    <form action="profile.php" method="POST">
        <input type="checkbox" name="logout" checked class="d-none">
        <button type="submit">Logout</button>
    </form>
    <?php include 'footer.html' ?>
</body>
</html>
