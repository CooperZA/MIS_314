<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Random Image | A02</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <body>
        <div class="pageContainer centerText">

            <h2>Random Image</h2>
            <hr />

            <?php
            //Retrieve name from querystring. Check that parameter
            //is in querystring or may get "Undefined index" error

            /* array of key value pairs for links to images based onm the number specified by user */
            $array = array(
                1 => "https://yorktown.cbe.wwu.edu/sandvig/images/dice/1.gif",
                2 => "https://yorktown.cbe.wwu.edu/sandvig/images/dice/2.gif",
                3 => "https://yorktown.cbe.wwu.edu/sandvig/images/dice/3.gif",
                4 => "https://yorktown.cbe.wwu.edu/sandvig/images/dice/4.gif",
                5 => "https://yorktown.cbe.wwu.edu/sandvig/images/dice/5.gif",
                6 => "https://yorktown.cbe.wwu.edu/sandvig/images/dice/6.gif",

            );

            $rand1 = rand(1, 6);
            $rand2 = rand(1, 6);

            $sum = $rand1 + $rand2;
            ?>
            <!-- output images, sum and reload page btn -->
            <img src="<?php echo $array[$rand1]; ?>">
            <img src="<?php echo $array[$rand2]; ?>">
            <br>
            <br>
            <h3>The sum of the dice is: <?php echo $sum ?></h3>

            <h3><a href="#" onclick="window.location.reload(true)">Reload Page</a></h3>
        </div>

    </body>

</html>