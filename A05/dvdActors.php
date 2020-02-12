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
            <label>Fist Name:</label>
            <input name="fname" type="text" autofocus>
        </div>
        <div class="formGroup">
            <label>Last Name:</label>
            <input name="lname" type="text">
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
    $actorFname = fCleanString($link, $_GET['fname'], 20);
    $actorLname = fCleanString($link, $_GET['lname'], 20);
    $delRecord = fCleanNumber($_GET['delActor']);

    //Insert
    if (!empty($actorFname) && !empty($actorLname)) {
        $sql = "INSERT INTO tblDvdActor (First_Name, Last_Name)
                VALUES ('$actorFname', '$actorLname')";
        mysqli_query($link, $sql) or die('Insert error: ' . mysqli_error($link));
    }

    //Delete
    if (!empty($delRecord)) {
        $sql = "DELETE FROM tblDvdActor WHERE actorID = $delRecord";
        mysqli_query($link, $sql) or die('Delete error: ' . mysqli_error($link));
    }
    //List records
    $sql = 'SELECT actorID, First_Name, Last_Name
                FROM tblDvdActor order by actorID';

    //$result is an array containing query results
    $result = mysqli_query($link, $sql)
        or die('SQL syntax error: ' . mysqli_error($link));

    echo "<p>" . mysqli_num_rows($result) . " records in query</p>";
    ?>
    <table class="simpleTable">
        <tr>
            <th>Actor ID</th>
            <th>Fist Name</th>
            <th>Last Name</th>
            <th>Delete</th>
        </tr>
        <?php
        // iterate through the retrieved records
        while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $actorID = $row['actorID'];
            echo "<tr>
                     <td>$actorID</td>
                     <td>$row[First_Name]</td>
                     <td>$row[Last_Name]</td>
                     <td><a href='?delActor=$actorID'>delete</a></td>
                 </tr>";
        }
        ?>
    </table>
</div>
</body>

</html>