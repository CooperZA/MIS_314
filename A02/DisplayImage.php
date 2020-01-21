<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Display Image | A02</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <body>
        <div class="pageContainer centerText">
            
            <h2>Display Image</h2>
            <hr/>
            <form>
                <p>
                    Please enter a value between 1-6:<br>
                    <input type="text" name="value" size="3" autofocus><br><br>
                    <input type="submit" value="Display Image">
                </p>
            </form>

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

            $value = $_GET['value'];

            if (is_numeric($value) && $value >= 1 && $value <= 6) {
                echo "<h1> You entered $value";
                echo "<br><br>";
                echo "<img src=",$array[$value];">";
            }
            ?>
        </div>

    </body>

</html>