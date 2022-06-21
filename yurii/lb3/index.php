<?php
session_start();

$fanta_max = 15;
$sprite_max = 10;
$nuts_max = 32;

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
            echo '<input type="checkbox" name="fanta_bool"> Шоколадный батончик <input class="form-control" type="number" value="0" name="fanta_amount" max="' . $fanta_max . '"> $3 ';
            echo ' | ' . $fanta_max . ' осталось <br><br>';
        ?>
        <?php
            echo '<input type="checkbox" name="sprite_bool"> Чипсы <input class="form-control" type="number" value="3" name="sprite_amount" max="' . $sprite_max . '"> $7';
            echo ' | ' . $sprite_max . ' осталось <br><br>';
        ?>
        <?php
            echo '<input type="checkbox" name="nuts_bool"> Мороженное <input class="form-control" type="number" value="0" name="nuts_amount" max="' . $nuts_max . '"> $8';
            echo ' | ' . $nuts_max . ' осталось <br><br>';
        ?>

        <input type="submit" value="Отправить" class="btn btn-outline-warning">
    </form>
    </div>
    <?php include 'footer.html' ?>
</body>
</html>