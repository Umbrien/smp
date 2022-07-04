<header>
    <?php 
session_start();
    if(!isset($_SESSION['login']))
        echo '<a href="login.php">Login</a>';
    else 
        echo 'Home | Products | Cart | <a href="profile.php">Profile</a>';
?>
</header>
