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

if(isset($_POST['credentials_submit'])) {
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['surname'] = $_POST['surname'];
    $_SESSION['date'] = $_POST['date'];
    $_SESSION['about'] = $_POST['about'];

    $_SESSION['about_short'] = strlen($_POST['about']) < 50;
    $_SESSION['surname_empty'] = strlen($_POST['surname']) == 0;
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
        <button type="submit" name="avatar_submit">Update profile photo</button>
    </form>

    <form action="" method="POST">
        <input type="text" name="username" placeholder="username" value="<?php echo $_SESSION['username'] ?>" />
        <input type="text" name="surname" placeholder="surname" value="<?php echo $_SESSION['surname'] ?>" />
        <input type="date" name="date" value="<?php echo $_SESSION['date'] ?>" />
        <textarea name="about" placeholder="about"><?php echo $_SESSION['about'] ?></textarea>
        <button type="submit" name="credentials_submit">update</button>
        <?php
        if($_SESSION['surname_empty']) {
                echo '
            <div class="alert alert-danger" role="alert">
                Surname should not be empty
            </div>
                ';
        }
        if($_SESSION['about_short']) {
                echo '
            <div class="alert alert-danger" role="alert">
                About should be more than 50 symbols
            </div>
                ';
        }
        ?>
    </form>

    <form action="profile.php" method="POST">
        <input type="checkbox" name="logout" checked class="d-none">
        <button type="submit">Logout</button>
    </form>
    <?php include 'footer.html' ?>
</body>
</html>
