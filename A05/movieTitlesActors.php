<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>

<head>
    <title>PHP Database Insert, Read & Delete | Actors</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<div class="pageContainer centerText">
    <h3>Movie Actors</h3>
    <hr>
    <form class="formLayout">
        <div class="formGroup">
            <label>ASIN:</label>
            <input name="newAsin" type="text" autofocus>
        </div>
        <div class="formGroup">
            <label>actorID:</label>
            <input name="newActorID" type="text">
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
    $newAsin = fCleanString($link, $_GET['newAsin'], 20);
    $newActorID = fCleanString($link, $_GET['newActorID'], 20);
    $delActorID = fCleanNumber($_GET['actorID']);
    $delAsin = fCleanString($link, $_GET['asin'], 15);

    //Insert
    if (!empty($actorFname) && !empty($actorLname)) {
        $sql = "INSERT INTO tblActorTitle (asin, actorID)
                VALUES ('$asin', '$actorID')";
        mysqli_query($link, $sql) or die('Insert error: ' . mysqli_error($link));
    }

    //Delete
    if (!empty($delRecord)) {
        $sql = "DELETE FROM tblActorTitle WHERE actorID = $delRecord AND asin = '$asin'";
        mysqli_query($link, $sql) or die('Delete error: ' . mysqli_error($link));
    }
    //List records
    $sql = 'SELECT asin, actorID
                FROM tblActorTitle ORDER BY actorID';

    //$result is an array containing query results
    $result = mysqli_query($link, $sql)
        or die('SQL syntax error: ' . mysqli_error($link));

    echo "<p>" . mysqli_num_rows($result) . " records in query</p>";
    ?>
    <table class="simpleTable">
        <tr>
            <th>ASIN</th>
            <th>Actor ID</th>
            <th>Delete</th>
        </tr>
        <?php
        // iterate through the retrieved records
        while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $actorID = $row['actorID'];
            $asin = $row['asin'];
            echo "<tr>
                     <td>$row[asin]</td>
                     <td>$row[actorID]</td>
                     <td><a href='?actorID=$actorID&asin=$asin'>delete</a></td>
                 </tr>";
        }
        ?>
    </table>
</div>
</body>

</html>