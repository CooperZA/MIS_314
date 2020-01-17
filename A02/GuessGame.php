<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sample web form</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <body>
        <div class="pageContainer centerText">

            <h2>Welcome to the Number Guess Game</h2>
            <hr />

            <p>Enter a number in the text box</p>

            <form>
                <p>Please enter a number:</p>
                <input type="text" name="fname" autofocus>
                <input type="submit" value="Go">
            </form>

            <?php
            //Retrieve name from querystring. Check that parameter
            //is in querystring or may get "Undefined index" error
            $fname = $_GET['fname'];
            if (isset($fname)) {
                echo "<h1> Hello $fname";
            }
            ?>
        </div>

    </body>

</html>