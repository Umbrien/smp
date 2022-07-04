<?php
session_start();

$user = array(
    "login" => "flusq",
    "password" => "123",
    "avatar" => "img/placeholder.png",
);

$login = $_POST['login'];
$password = $_POST['password'];

if($login == $user['login'] && $password == $user['password']) {
    $_SESSION['login'] = $login;
    $_SESSION['time'] = date("Y-m-d H:i:s");
    $_SESSION['avatar'] = $user["avatar"];

    unset($_SESSION['login-error']);
    header('Location: index.php');
    exit();
} else {
    $_SESSION['login-error'] = true;
    header('Location: login.php');
    exit();
}

?>
