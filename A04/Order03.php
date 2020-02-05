<html>

<head>
    <title>Order Confirmation</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="pageContainer centerText">
        <p></p>
        <h2>Order Confirmation</h2>

        <?php
        include 'validationUtilities.php';

        //must arrive from order02.php
        $referrer = $_SERVER['HTTP_REFERER'];

        if (stripos($referrer, 'order02.php') == false) header("location:order01.php");

        // variable names for cookies
        $fname = 'FirstName';
        $carModel = 'CarModel';

        // use server validation to check cookie values
        $name = $_COOKIE[$fname];
        $car = $_COOKIE[$carModel];

        // get color value
        $color = $_GET['color'];

        // validate color
        if (isset($color)) {
            if (!fIsValidColor($color)) {
                exit("color is not valid");
            } else {
                // output h3 and image
                echo "<h3> Congratulations {$name} you
                have ordered a {$color} {$car}!</h3>";
                echo "<img style='margin: 30px 0;' src='http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/a04/images/{$car}{$color}.jpg'>";
            }
        }
        ?>

        <br>
        <a href="Order01.php">Place another order</a>

    </div>
</body>

</html>