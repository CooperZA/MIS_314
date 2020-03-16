<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Bookstore | <?php echo $pageTitle ?></title>
    <!-- CSS -->
    <!-- font awesome -->
    <link href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- lightbox -->
    <link rel="stylesheet" href="node_modules\lightbox2\dist\css\lightbox.css">
    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/favicon/site.webmanifest">
</head>

<body>
    <!-- start container -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <header class="m-3">
                    <span class="row">
                        <div class="logo col-md-8">
                            <a href="index.php">
                                <img class="img-responsive logo-img" src="assets/ebook-store-logo.jpeg" alt="Logo Image">
                            </a>
                        </div>
                        <!-- cart and view account go here -->
                        <div class="col-md-2">
                            <a href="checkout01.php" class="float-right">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="cart-text">Cart</span>
                            </a>
                        </div>
                        <div class="col-md-2">
                            <a href="about.php" class="float-right">
                                <i class="fas fa-info"></i>
                                <span class="about-text">About this Site</span>
                            </a>
                        </div>
                    </span>
                </header>
            </div>
        </div>