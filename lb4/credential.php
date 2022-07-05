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
    $_SESSION['date'] = date("Y-m-d");
    $_SESSION['avatar'] = $user["avatar"];

    if(!isset($_SESSION['username']))
        $_SESSION['username'] = $user["login"];
    if(!isset($_SESSION['surname']))
        $_SESSION['surname'] = '';
    if(!isset($_SESSION['about']))
        $_SESSION['about'] = '';
    $_SESSION['surname_empty'] = false;
    $_SESSION['about_short'] = false;

    unset($_SESSION['login-error']);
    header('Location: index.php');
    exit();
} else {
    $_SESSION['login-error'] = true;
    header('Location: login.php');
    exit();
}

?>
