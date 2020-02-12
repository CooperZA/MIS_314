<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>

<head>
    <title>PHP Database Insert, Read & Delete | Movies</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<div class="pageContainer centerText">
    <h3>PHP Database Insert, Read, & Delete</h3>
    <hr>
    <form class="formLayout">
        <div class="formGroup">
            <label>ASIN:</label>
            <input name="asin" type="text" autofocus>
        </div>
        <div class="formGroup">
            <label>Movie Title:</label>
            <input name="title" type="text">
        </div>
        <div class="formGroup">
            <label>Price:</label>
            <input name="price" type="text">
        </div>
        <div class="formGroup">
            <label> </label>
            <button>Add to Database</button>
        </div>
    </form>
    <?php
    //include database connection
    include("util/DatabaseConnect.php");

    //connect to database
    $link = fConnectToDatabase();

    //Retrieve parameters from querystring and sanitize
    $dvdAsin = fCleanString($link, $_GET['asin'], 15);
    $dvdTitle = fCleanString($link, $_GET['title'], 100);
    $dvdPrice = fCleanNumber($_GET['price']);
    $delRecord = fCleanString($link, $_GET['delAsin'], 15);

    //Insert
    if (!empty($dvdAsin) && !empty($dvdTitle) && !empty($dvdPrice)) {
        $sql = "INSERT INTO tblDvdTitle (asin, title, price)
                VALUES ('$dvdAsin', '$dvdTitle', '$dvdPrice')";
        mysqli_query($link, $sql) or die('Insert error: ' . mysqli_error($link));
    }

    //Delete
    if (!empty($delRecord)) {
        $sql = "DELETE FROM tblDvdTitle WHERE asin = '$delRecord'";
        mysqli_query($link, $sql) or die('Delete error: ' . mysqli_error($link));
    }
    //List records
    $sql = 'SELECT asin, title, price
                FROM tblDvdTitle order by title';

    //$result is an array containing query results
    $result = mysqli_query($link, $sql)
        or die('SQL syntax error: ' . mysqli_error($link));

    echo "<p>" . mysqli_num_rows($result) . " records in query</p>";
    ?>
    <table class="simpleTable">
        <tr>
            <th>ASIN</th>
            <th>Title</th>
            <th>Price</th>
            <th>Cover</th>
            <th>Delete</th>
        </tr>
        <?php
        // iterate through the retrieved records
        while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $asin = $row['asin'];
            echo "<tr>
                     <td>$asin</td>
                     <td>$row[title]</td>
                     <td>$row[price]</td>
                     <td><img src='http://images.amazon.com/images/P/$asin.01.MZZZZZZZ.jpg'></td>
                     <td><a href='?delAsin=$asin'>delete</a></td>
                 </tr>";
        }
        ?>
    </table>
</div>
</body>

</html>