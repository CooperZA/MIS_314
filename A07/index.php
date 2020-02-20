<?php
    // connect to DB
    include('util/databaseconnect.php');

    $link = fConnectToDatabase();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Bookstore | <?php echo $pageTitle ?></title>
    <!-- CSS -->
    <!-- font awesome -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <?php
        include('include/header.php');
        include('include/menu.php');
    ?>
    <div class="container">
        <?php
        // stuf goes here
        ?>
    </div>
    <?php
        include('include/footer.php');
    ?>
    
</body>
<!-- bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- custom js -->

</html>