<?php
session_start();

if(!isset($_SESSION['login'])) {
    header('Location: page404.php');
}

if(isset($_POST['logout'])) {
    #session_destroy();
    unset($_SESSION['login']);
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
    <div class="container">
    <h1 class="my-3"><b>Профиль</b></h1>

    <div class="card">
        <div class="card-body">
            <img src="<?php echo $_SESSION['avatar']; ?>" class="rounded-circle" width=125 height=125 />

            <form action="" method="POST" enctype="multipart/form-data">
                <input type="file" name="avatar_upload" />
                <button type="submit" name="avatar_submit" class="btn btn-sm btn-outline-success">Обновить аватар</button>
            </form>
        </div>
    </div>


    <div class="card my-4">
        <div class="card-body">

    <form action="" method="POST">
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
        <input type="text" name="username" placeholder="Имя" value="<?php echo $_SESSION['username'] ?>"
            class="form-control form-control-sm"
         />
                        </div>
                        <div class="col">
        <input type="text" name="surname" placeholder="Фамилия" value="<?php echo $_SESSION['surname'] ?>"
            class="form-control form-control-sm <?php if($_SESSION['surname_empty']) echo 'is-invalid' ?>"
        />
        <?php
            if($_SESSION['surname_empty']) {
                    echo '<div class="invalid-feedback">Укажите фамилию</div>';
            }
        ?>
                        </div>
                        <div class="col">

        <input type="date" name="date" value="<?php echo $_SESSION['date'] ?>"
            class="form-control form-control-sm"
        />
                        </div>
                    </div>
                </div>
                <div class="col">

        <textarea name="about" placeholder="Краткая информация (не меньше 50 символов)"
            class="form-control"
        ><?php echo $_SESSION['about'] ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col">
        <button type="submit" name="credentials_submit" class="btn btn-sm btn-secondary">Обновить</button>
                </div>
                <div class="col">
                </div>
            </div>
        </div>
    </form>
                    <div class="row">
        <?php
        if($_SESSION['about_short']) {
                echo '
                <div class="col">
            <div class="alert alert-danger" role="alert">
                Описание дожлно быть не меньше 50 символов
            </div>
                </div>
                ';
        }
        ?>
                    </div>
        </div>
    </div>

    <form action="profile.php" method="POST">
        <button name="logout" type="submit" class="btn btn-danger">Bыход</button>
    </form>
    </div>

    <?php include 'footer.html' ?>
</body>
</html>
