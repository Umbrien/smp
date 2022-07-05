<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/index.css" />
</head>
<body>
    <?php include 'header.php' ?>
    <div class="container">
    <h1 class="my-3"><b>Вход в систему</b></h1>
    <div class="card">
        <div class="card-body">

    <form action="credential.php" method="POST">
        <div class="form-group">
            <label for="loginInput"><b>Имя пользователя</b></label>
            <input type="text" class="form-control"
                id="loginInput" aria-describedby="loginHint"
                name="login"
                placeholder="Имя пользователя"
            >
            <small id="loginHint" class="form-text text-muted">Мы храним ваши данные в безопасной сессии</small>
        </div>
        <div class="form-group my-3">
            <label for="passwordInput"><b>Пароль</b></label>
            <input type="password" class="form-control"
                id="passwordInput" aria-describedby="loginHint"
                name="password"
                placeholder="Пароль"
            >
        </div>
        <button type="submit" class="btn btn-warning">Войти</button>
        <?php
            if(isset($_SESSION['login-error'])) {
                echo '
            <div class="alert alert-danger" role="alert">
                Неправильное имя пользователя или пароль
            </div>
                ';
            }
        ?>
    </form>
        </div>
    </div>
    </div>
    <?php include 'footer.html' ?>
</body>
</html>
