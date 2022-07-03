<?php
session_start();
$total = 0;
if ($_POST['fanta_bool']) {
    if (isset($_SESSION['fanta_amount'])) {
        $_SESSION['fanta_amount'] += $_POST['fanta_amount'];
    } else {
        $_SESSION['fanta_amount'] = $_POST['fanta_amount'];
    }
} else {
    if($_POST['delete_fanta']) {
        unset($_SESSION['fanta_bool']);
        unset($_SESSION['fanta_amount']);
    }
}
if ($_POST['sprite_bool']) {
    if (isset($_SESSION['sprite_amount'])) {
        $_SESSION['sprite_amount'] += $_POST['sprite_amount'];
    } else {
        $_SESSION['sprite_amount'] = $_POST['sprite_amount'];
    }
} else {
    if($_POST['delete_sprite']) {
        unset($_SESSION['sprite_bool']);
        unset($_SESSION['sprite_amount']);
    }
}
if ($_POST['nuts_bool']) {
    if (isset($_SESSION['nuts_amount'])) {
        $_SESSION['nuts_amount'] += $_POST['nuts_amount'];
    } else {
        $_SESSION['nuts_amount'] = $_POST['nuts_amount'];
    }
} else {
    if($_POST['delete_nuts']) {
        unset($_SESSION['nuts_bool']);
        unset($_SESSION['nuts_amount']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart@Magazin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/index.css" />
</head>
<body>
    <?php include 'header.phtml' ?>
    <h2 class="text-center">Cart</h2>
    <div class="container">

    <table class="table table-striped table-bordered border-warning">
        <thead class="thead-dark">
        <tr>
            <td>id</td>
            <td>name</td>
            <td>price</td>
            <td>count</td>
            <td>sym</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <?php
                $sum = isset($_SESSION["fanta_amount"]) ? $_SESSION["fanta_amount"] * 6.0 : 0;
                if (isset($_SESSION["fanta_amount"])) {
                    echo "<td>1</td> <td>Fanta</td> <td>6.00</td> <td>" . $_SESSION["fanta_amount"] . "</td> <td>".
                        $sum .
                    '</td> <td>
                        <form action="cart.php" method="POST">
                        <input type="checkbox" name="delete_fanta" checked class="d-none">
                        <input type="submit" value="Delete" >
                        </form>
                    </td>';
                    $total += $sum;
                }
            ?>
        </tr>
        <tr>
            <?php
                $sum = isset($_SESSION["sprite_amount"]) ? $_SESSION["sprite_amount"] * 14.0 : 0;
                if (isset($_SESSION["sprite_amount"])) {
                    echo "<td>2</td> <td>Sprite</td> <td>14.00</td> <td>" . $_SESSION["sprite_amount"] . "</td> <td>".
                        $sum .
                    '</td> <td>
                        <form action="cart.php" method="POST">
                        <input type="checkbox" name="delete_sprite" checked class="d-none">
                        <input type="submit" value="Delete" >
                        </form>
                    </td>';
                    $total += $sum;
                }
            ?>
        </tr>
        <tr>
            <?php
                $sum = isset($_SESSION["nuts_amount"]) ? $_SESSION["nuts_amount"] * 14.0 : 0;
                if (isset($_SESSION["nuts_amount"])) {
                    echo "<td>3</td> <td>Nuts</td> <td>5.2</td> <td>" . $_SESSION["nuts_amount"] . "</td> <td>".
                        $sum .
                    '</td> <td>
                        <form action="cart.php" method="POST">
                        <input type="checkbox" name="delete_nuts" checked class="d-none">
                        <input type="submit" value="Delete" >
                        </form>
                    </td>';
                    $total += $sum;
                }
            ?>
        </tr>
        <tr>
            <?php
            echo "<td>Total</td> <td></td> <td></td> <td></td> <td>$total</td> <td></td>";
            ?>
        </tr>
        </tbody>
    </table>
    <input type="button" class="btn btn-danger" value="Cancel">
    <input type="button" class="btn btn-success" value="pay">
    <?php if ($total == 0) echo '<h5>Cart is empty. Go to <a href="index.php">shop</a></h5><br>'; ?>
    </div>
    <?php include 'footer.html' ?>
</body>
</html>