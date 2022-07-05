<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/index.css" />
</head>
<body>
    <?php include 'header.php' ?>
    <div class="container">
    <form action="credential.php" method="POST">
        <div class="form-group">
            <label for="loginInput">Login</label>
            <input type="text" class="form-control"
                id="loginInput" aria-describedby="loginHint"
                name="login"
                placeholder="Login"
            >
            <small id="loginHint" class="form-text text-muted">We'll never share your data</small>
        </div>
        <div class="form-group">
            <label for="passwordInput">Password</label>
            <input type="password" class="form-control"
                id="passwordInput" aria-describedby="loginHint"
                name="password"
                placeholder="Password"
            >
        </div>
        <button type="submit" class="btn btn-warning">Login</button>
        <?php
            if(isset($_SESSION['login-error'])) {
                echo '
            <div class="alert alert-danger" role="alert">
                Wrong login or password
            </div>
                ';
            }
        ?>
    </form>
    </div>
    <?php include 'footer.html' ?>
</body>
</html>
