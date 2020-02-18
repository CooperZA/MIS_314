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
                    $category = $_GET['CatID'];

                    // Connect to DB
                    $link = fConnectToDatabase();

                    $sql = "SELECT gpc.CatID, gc.CatName, COUNT(*) AS numProducts FROM geekproductcategories gpc JOIN geekcategories gc ON gpc.CatID = gc.CatID GROUP BY CatName ASC";

                    //$result is an array containing query results
                    $result = mysqli_query($link, $sql) or die('SQL syntax error: ' . mysqli_error($link));

                    // number of results
                    $numberResults;

                    while ($row = mysqli_fetch_array($result)){
                        // Output the left menu
                        $catID = $row['CatID'];
                        $catName = $row['CatName'];
                        echo "<div class='menuLink'><a href='?CatID=$catID'>$catName</a> ($row[numProducts])</div>";

                    }
                ?>
            </div>
            <div class="centerColumn">
                <?php
                    if (!isset($category)){
                        echo "<h3>Please Select a Product Category</h3>";
                        exit();
                    } else {
                        // echo "<h3>You selected $category</h3>";
                    }
                            
                    $sqlProduct = "SELECT gp.Name, gp.ShortDesc, gp.Image, gp.price FROM geekproducts gp JOIN geekproductcategories gpc ON gpc.ItemID = gp.ItemID WHERE gpc.CatID = $category";
                    
                    $resultProduct = mysqli_query($link, $sqlProduct) or die('SQL syntax error: '. mysqli_error($link));

                    while ($row = mysqli_fetch_array($resultProduct)) {
                        // Get product variables from returned row
                        $img = $row['Image'];
                        $name = $row['Name'];
                        $price = $row['Price'];
                        $desc = $row['ShortDesc'];

                        echo "<div class='productItem'>\n
                            <img src='http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/a06/images/m_$img' class='productImage'>\n
                            <div class='productName'>$name</div>\n
                            <div class='productPrice'>Price: $$price</div>\n
                            <div class='productDesc'>$desc</div>\n
                        </div>\n";
                    }
                ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</body>

</html>