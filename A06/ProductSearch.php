<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>

<head>
    <title>Product Search</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<div class="pageContainer centerText">
    <h3>Product Search</h3>
    <hr>
    <p>Please Enter all or part of a product name:</p>
    <form class="formLayout">
        <div class="formGroup">
            <label>Search:</label>
            <input type="text" name="search" placeholder="search" autofocus />
            <input type="hidden" name="postback" value="true">
        </div>
        <div class="formGroup">
            <label></label>
            <button type="submit">Search</button>
        </div>
    </form>
    <?php
    //include database connection
    include("util/DatabaseConnect.php");

    //connect to database
    $link = fConnectToDatabase();

    //Retrieve parameters from querystring and sanitize
    $query = fCleanString($link, $_GET['search'], 50);
    $postback = $_GET['postback'];

    if ($postback) {

        //List records
        $sql = "SELECT Price, Name, Image
                FROM geekproducts WHERE Name LIKE '%$query%' ORDER BY Name ASC";

        //$result is an array containing query results
        $result = mysqli_query($link, $sql)
            or die('SQL syntax error: ' . mysqli_error($link));

        echo "<p>" . mysqli_num_rows($result) . " items contain" . $query . "</p>";
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
            echo "<tr>\n
                     <td>$row[Price]</td>\n
                     <td>$row[Name]</td>\n
                     <td>
                        <a href='http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/a06/images/l_$row[Image]'>
                            <img src='http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/a06/images/m_$row[Image]' class='geekImageMed'>
                        </a>
                     </td>\n
                 </tr>\n";
        }
    }
        ?>
        </table>
</div>
</body>

</html>