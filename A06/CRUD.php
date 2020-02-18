<?php
//include database connection
include("util/DatabaseConnect.php");

//connect to database
$link = fConnectToDatabase();

//Retrieve parameters from querystring and sanitize
$updateID = fCleanNumber($_GET['updateID']);

if (!empty($updateID)) {
    $updateSql = "SELECT * FROM tblCustomers WHERE custID = $updateID";

    $updateResult = mysqli_query($link, $updateSql) or die('SQL syntax error: ' . mysqli_error($link));

    $updateRecord = mysqli_fetch_array($updateResult);

    $nameFUpdate = $updateRecord['nameF'];
    $nameLUpdate = $updateRecord['nameL'];

    // flag
    $flag = true;

    $updateID2 = $updateID;
}


?>
<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>

<head>
    <title>CRUD</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>
<div class="pageContainer centerText">
    <h3>CRUD (Create, Read, Update & Delete) Database</h3>
    <hr>
    <form class="formLayout">
        <div class="formGroup">
            <label>First name:</label>
            <input name="nameF" type="text" value="<?php if ($flag) {
                                                        echo $nameFUpdate;
                                                    } ?>" autofocus>
        </div>
        <div class="formGroup">
            <label>Last name:</label>
            <input name="nameL" type="text" value="<?php if ($flag) {
                                                        echo $nameLUpdate;
                                                    } ?>">
            <input type="hidden" value="<?php if ($flag) {
                                            echo $updateID2;
                                        } ?>" name="updateID2">
        </div>
        <div class="formGroup">
            <label> </label>
            <button>Submit</button>
        </div>
    </form>
    <?php
    //Retrieve parameters from querystring and sanitize
    $nameF = fCleanString($link, $_GET['nameF'], 50);
    $nameL = fCleanString($link, $_GET['nameL'], 50);
    $updateID2 = fCleanNumber($_GET['updateID2']);
    $deleteID = fCleanNumber($_GET['deleteID']);

    //Insert
    if (!empty($nameF) && !empty($nameL) && empty($updateID2)) {
        $sql = "Insert into tblCustomers (nameL, nameF)
                VALUES ('$nameL', '$nameF')";
        mysqli_query($link, $sql) or die('Insert error: ' . mysqli_error($link));
    }

    //Delete
    if (!empty($deleteID)) {
        $sql = "Delete from tblCustomers WHERE CustID=$deleteID";
        mysqli_query($link, $sql) or die('Delete error: ' . mysqli_error($link));
    }

    // Update
    if (!empty($nameF) && !empty($nameL) && !empty($updateID2)) {
        $sql = "UPDATE tblCustomers SET nameF = '$nameF', nameL = '$nameL' WHERE custID = $updateID2";
        mysqli_query($link, $sql) or die('Update error: ' . mysqli_error(($link)));
    }

    //List records
    $sql = 'SELECT custID, nameF, nameL FROM tblCustomers ORDER BY CustID';

    //$result is an array containing query results
    $result = mysqli_query($link, $sql)
        or die('SQL syntax error: ' . mysqli_error($link));

    echo "<p>" . mysqli_num_rows($result) . " records in query</p>";

    ?>
    <table class="simpleTable">
        <tr>
            <th>Cust. ID</th>
            <th>F. Name</th>
            <th>L. Name</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        // iterate through the retrieved records
        while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $custID = $row['custID'];
            echo "<tr>
                     <td>$custID</td>
                     <td>$row[nameF]</td>
                     <td>$row[nameL]</td>
                     <td><a href='?deleteID=$custID'>delete</a></td>
                     <td><a href='?updateID=$custID'>update</a></td>
                 </tr>";
        }
        ?>
    </table>
</div>
</body>

</html>