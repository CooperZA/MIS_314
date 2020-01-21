<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Guess Game | A02</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <body>
        <div class="pageContainer centerText">

            <h2>Welcome to the Number Guess Game</h2>
            <hr />

            <p>Enter a positive number in the text box</p>

            <form>
                <p>Please enter a number:</p>
                <input type="text" name="guess" autofocus>
                <input type="submit" value="Go">
            </form>

            <?php
            //Retrieve name from querystring. Check that parameter
            //is in querystring or may get "Undefined index" error
            $guess = $_GET['guess'];

            // check that the guess is numeric
            if (is_numeric($guess)) {

                // switch case for guessing the answers
                switch ($guess) {
                    case $guess < 4:
                        echo "<h1> Very Low </h1>";
                        break;
                    case $guess >= 4 && $guess <= 6:
                        echo "<h1> Low </h1>";
                        break;
                    case $guess == 7:
                        echo "<h1> Correct! </h1>";
                        break;
                    case $guess >= 8 && $guess <= 10:
                        echo "<h1> High </h1>";
                        break;
                    case $guess > 10:
                        echo "<h1> Very High </h1>";
                        break;
                }
            }
            ?>
        </div>

    </body>

</html>