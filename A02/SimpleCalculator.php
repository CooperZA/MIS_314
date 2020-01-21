<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simple Calculator | A02</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <body>
        <div class="pageContainer centerText">

            <h2>Simple Calculator</h2>
            <hr />

            <form>
                <p>Enter two numbers to add:</p>
                Value 1:
                <input type="text" name="val1" autofocus>
                <br>
                <br>
                Value 2:
                <input type="text" name="val2" autofocus>
                <br><br>
                <input type="submit" value="Add">
            </form>

            <?php
            //Retrieve name from querystring. Check that parameter
            //is in querystring or may get "Undefined index" error
            $val1 = $_GET['val1'];
            $val2 = $_GET['val2'];

            // check if values are numeric, add and echo result
            if (is_numeric($_GET['val1']) && is_numeric($_GET['val2'])) {

                $sum = $val1 + $val2;
                echo "<h1> $sum";
            }
            ?>
        </div>

    </body>

</html>