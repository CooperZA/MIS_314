<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="bodyContainer">
        <h1>PHP clock</h1>
        <hr/>
        <?php
            for($i = 0; $i < 10; $i++){
                ?>
                <div class="clockBorder clockFont">
                    <?php
                    //echo current time
                    //Format parameters: g hour, i minutes
                    //s seconds, a am/pm
                    echo date("g:i:s a");
                    ?>
                </div>
                <h3>Today is
                    <?php
                    //add format string to produce date format
                    //"January 12, 2020";
                    echo date("F j, Y")
                    ?>
                </h3>
                <?php
            }
        ?>
    </div>
</body>

</html>