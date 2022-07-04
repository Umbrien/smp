<?php
session_start();


if(!isset($_SESSION['login'])) {
    header('Location: page404.php');
}

$fanta_max = 30;
$sprite_max = 20;
$nuts_max = 50;

if (isset($_SESSION['fanta_amount'])) {
    $fanta_max -= $_SESSION['fanta_amount'];
}
if (isset($_SESSION['sprite_amount'])) {
    $sprite_max -= $_SESSION['sprite_amount'];
}
if (isset($_SESSION['nuts_amount'])) {
    $nuts_max -= $_SESSION['nuts_amount'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magazin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/index.css" />
</head>
<body>
    <?php include 'header.phtml' ?>
    <div class="container">
    <form action="cart.php" method="POST">
        <?php
            echo '<input type="checkbox" name="fanta_bool"> Fanta <input type="number" value="0" name="fanta_amount" max="' . $fanta_max . '"> $6 ';
            echo ' | ' . $fanta_max . ' left <br>';
        ?>
        <?php
            echo '<input type="checkbox" name="sprite_bool"> Sprite <input type="number" value="3" name="sprite_amount" max="' . $sprite_max . '"> $14';
            echo ' | ' . $sprite_max . ' left <br>';
        ?>
        <?php
            echo '<input type="checkbox" name="nuts_bool"> Nuts <input type="number" value="0" name="nuts_amount" max="' . $nuts_max . '"> $5.2';
            echo ' | ' . $nuts_max . ' left <br>';
        ?>

        <input type="submit" value="Send" class="btn btn-success">
    </form>
    </div>
    <?php include 'footer.html' ?>
</body>
</html>