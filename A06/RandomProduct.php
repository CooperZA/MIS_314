<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>

<head>
    <title>Random Product</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<div class="pageContainer" style="min-height: 400px;">
    <div class="centerText">
        <h2>Random Product</h2>
    </div>
    <hr>
    <?php
    //include database connection
    include("util/DatabaseConnect.php");

    //connect to database
    $link = fConnectToDatabase();

    //List records
    $sql = "SELECT ItemID, Name, LongDesc, Image, price FROM geekproducts ORDER BY rand() LIMIT 1;";

    //$result is an array containing query results
    $result = mysqli_query($link, $sql)
        or die('SQL syntax error: ' . mysqli_error($link));


    // iterate through the retrieved records
    while ($row = mysqli_fetch_array($result)) {
        //Field names are case sensitive and must match
        //the case used in sql statement
        echo "<img src='http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/a06/images/m_$row[Image]' class='geekImageFloat'>
        
            <h3>$row[Name]</h3>
            
            <b>Price: $row[price]</b><br><br>

            $row[LongDesc]
            ";
    }
    ?>
    </table>
</div>
</body>

</html>