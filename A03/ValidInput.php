<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="pageContainer centerText">
        <form>
            <p>Iterations:
                <input type="text" name="rows" size="5" autofocus>
                <input type="submit" value="Loop">
            </p>
        </form>

        <table class="simpleTable">
            <tbody>

            <?php
            $rows = $_GET['rows'];

            if (!empty($rows)) {

                if ($rows >= 1 && $rows <= 10 && is_numeric($rows)){
                    for ($i = 0; $i < $rows; $i++) {
                        ?>
                            <tr><td>Iteration: <?php echo $i; ?></td></tr>
                        <?php
                    }

                } else {
                    echo "<tr><td>Please enter number 1-10.</td></tr>";
                }
            }
            ?>
            </tbody>

        </table>


    </div>
</body>

</html>