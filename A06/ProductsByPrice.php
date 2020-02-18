<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>

<head>
    <title>Products by Price</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<div class="pageContainer centerText">
    <h3>Products by Price</h3>
    <hr>
    <form class="formLayout">
        <div class="formGroup">
            <label>Price:</label>
            <input type="text" name="price" required placeholder="price" pattern="[0-9\.]{1,7}" title="Must be numeric" autofocus />
        </div>
        <div class="formGroup">
            <label></label>
            <button type="submit">Submit</button>
        </div>
    </form>
    <?php
    //include database connection
    include("util/DatabaseConnect.php");

    //connect to database
    $link = fConnectToDatabase();

    //Retrieve parameters from querystring and sanitize
    $searchPrice = fCleanNumber($_GET['price']);

    //List records
    $sql = "SELECT Price, Name, Image
                FROM geekproducts WHERE Price < $searchPrice ORDER BY Price ASC";

    //$result is an array containing query results
    $result = mysqli_query($link, $sql)
        or die('SQL syntax error: ' . mysqli_error($link));

    echo "<p>We sell " . mysqli_num_rows($result) . " items under $" . $searchPrice ."</p>";
    ?>
    <table class="simpleTable">
        <tr>
            <th>Price</th>
            <th>Item Name</th>
            <th>Thumbnail Image</th>
        </tr>
        <?php
        // iterate through the retrieved records
        while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            echo "<tr>
                     <td>$row[Price]</td>
                     <td>$row[Name]</td>
                     <td>
                        <a href='http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/a06/images/l_$row[Image]'>
                            <img src='http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/a06/images/m_$row[Image]' class='geekImageMed'>
                        </a>
                     </td>
                 </tr>";
        }
        ?>
    </table>
</div>
</body>

</html>