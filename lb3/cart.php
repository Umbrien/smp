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
    <h2 class="text-center">Cart is empty</h2>
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
                $fanta_sum = isset($_GET["fanta_bool"]) ? $_GET["fanta_amount"] * 6.0 : 0;
                if (isset($_GET["fanta_bool"])) {
                    echo "<td>1</td> <td>Fanta</td> <td>6.00</td> <td>" . $_GET["fanta_amount"] . "</td> <td>".
                        $fanta_sum .
                    "</td> <td>bin</td>";
                }
            ?>
        </tr>
        <tr>
            <td>2</td> <td>phone2</td> <td>6.00</td> <td>1</td> <td>6.00</td> <td>bin</td>
        </tr>
        <tr>
            <td>Total</td> <td></td> <td></td> <td></td> <td>14.00</td> <td></td>
        </tr>
        </tbody>
    </table>
    <input type="button" class="btn btn-danger" value="Cancel">
    <input type="button" class="btn btn-success" value="pay">
    </div>
    <?php include 'footer.html' ?>
</body>
</html>