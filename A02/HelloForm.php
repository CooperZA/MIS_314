<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hello Form | A02</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <body>
        <div class="pageContainer centerText">

            <h2>Hello Form</h2>
            <hr />

            <form>
                <p>Please enter your name:</p>
                <input type="text" name="fname" autofocus>
                <input type="submit" value="Submit Name">
            </form>

            <?php
            //Retrieve name from querystring. Check that parameter
            //is in querystring or may get "Undefined index" error
            if (isset($_GET['fname'])) {
                $fname = $_GET['fname'];
                echo "<h1> Hello $fname";
            }
            ?>
        </div>

    </body>

</html>