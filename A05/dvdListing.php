<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>

<head>
    <title>PHP Database Insert, Read & Delete | Actors</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<div class="pageContainer centerText">
    <h3>Movie Listing</h3>
    <hr>
    <?php
    //include database connection
    include("util/DatabaseConnect.php");

    //connect to database
    $link = fConnectToDatabase();

    //List records
    $sql = "SELECT DISTINCT tblDvdTitle.asin, CONCAT(tblDvdActor.First_Name, ' ', tblDvdActor.Last_Name) AS actor_name, tblDvdTitle.title, tblDvdTitle.price FROM ((tblActorTitle INNER JOIN tblDvdTitle ON tblActorTitle.asin = tblDvdTitle.asin) INNER JOIN tblDvdActor ON tblActorTitle.actorID = tblDvdActor.actorID);";

    //$result is an array containing query results
    $result = mysqli_query($link, $sql)
        or die('SQL syntax error: ' . mysqli_error($link));

    echo "<p>" . mysqli_num_rows($result) . " movies in database</p>";
    ?>
    <table class="simpleTable">
        <tr>
            <th>ASIN</th>
            <th>Title</th>
            <th>Price</th>
            <th>Actors</th>
            <th>Cover</th>
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
                    <td>$row[actor_name]</td>
                    <td><img src='http://images.amazon.com/images/P/$asin.01.MZZZZZZZ.jpg'></td>
                  </tr>";
        }
        ?>
    </table>
</div>
</body>

</html>