<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Items</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="pageContainer">
        <div class="centerText">
            <h3>Product Categories</h3>
            <hr>
        </div>
        <div class='equalColumnWraper'>
            <div class='leftColumn'>
                <div class="centerText">
                    <h3>Categories</h3>
                </div>
                <?php
                    //include utilities
                    include ('util/DatabaseConnect.php');

                    // Get query string values
                    $category = $_GET['category'];

                    // Connect to DB
                    $link = fConnectToDatabase();

                    $sql = "SELECT gpc.CatID, gc.CatName, COUNT(*) AS numProducts FROM geekproductcategories gpc JOIN geekcategories gc ON gpc.CatID = gc.CatID GROUP BY CatName ASC";

                    //$result is an array containing query results
                    $result = mysqli_query($link, $sql)
                        or die('SQL syntax error: ' . mysqli_error($link));

                    while ($row = mysqli_fetch_array($result)){
                        // <div class='menuLink'><a href='?category=Binary'>Binary</a> (2)</div>
                        $cat = $row['CatName'];
                        echo "<div class='menuLink'><a href='?category=$cat'>$cat</a> ($row[numProducts])</div>";

                    }
                ?>
            </div>
            <div class="centerColumn">
                <h3>You selected <?php echo $category ?></h3>
            </div>
        </div>
    </div>
</body>

</html>