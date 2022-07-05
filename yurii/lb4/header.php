<header class="mb-4">
    <?php 
session_start();
    if(!isset($_SESSION['login']))
        echo '<a href="login.php">Войти в систему</a>';
    else 
        echo 'Главная | Продукты | Корзина | <a href="profile.php">Профиль</a>';
?>
</header>
