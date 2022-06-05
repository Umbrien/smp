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
    <form action="index.php">
        <input type="checkbox"> Fanta <input type="number" value="0"> $1 <br>
        <input type="checkbox"> Sprite <input type="number" value="3"> $1 <br>
        <input type="checkbox"> Nuts <input type="number" value="0"> $1 <br>

        <input type="submit" value="Send" class="btn btn-success">
    </form>
    </div>
    <?php include 'footer.html' ?>
</body>
</html>