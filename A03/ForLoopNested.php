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

        <h2>For Loop Nested</h2>
        <hr>

        <form>

            Rows:
            <input type="text" name="rows" size="5" autofocus>
            <br><br>
            Columns:
            <input type="text" name="cols" size="5">
            <br><br>
            <input type="submit" value="Loop" style="margin-bottom: 10px;">

        </form>

        <table class="simpleTable">
            <tbody>

                <?php
                $rows = $_GET['rows'];
                $cols = $_GET['cols'];

                if (isset($rows)) {
                    for ($i = 0; $i < $rows; $i++) {
                        ?><tr><?php
                        for ($j = 0; $j < $cols; $j++) {
                        ?>
                            <td>Row <?php echo $i; ?>, Column: <?php echo $j; ?> </td>
                        <?php
                        }
                        ?></tr><?php
                    }
                }
                ?>
            </tbody>

        </table>


    </div>
</body>

</html>