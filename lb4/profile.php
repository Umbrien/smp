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

if(isset($_POST['avatar_submit'])) {
    $img_name = $_FILES['avatar_upload']['name'];
    $tmp_img_name = $_FILES['avatar_upload']['tmp_name'];
    $folder = 'img/';
    move_uploaded_file($tmp_img_name, $folder . $img_name);
    $_SESSION['avatar'] = $folder . $img_name;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/index.css" />
</head>
<body>
    <?php include 'header.php' ?>
    <h1>Profile</h1>

    <img src="<?php echo $_SESSION['avatar']; ?>" />

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="avatar_upload" />
        <button type="submit" name="avatar_submit">Send</button>
    </form>

    <form action="profile.php" method="POST">
        <input type="checkbox" name="logout" checked class="d-none">
        <button type="submit">Logout</button>
    </form>
    <?php include 'footer.html' ?>
</body>
</html>
