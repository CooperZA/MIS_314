<?php
include('util/databaseconnect.php');
$link = fConnectToDatabase();

// include header and menu
include_once('include/header.php');

// query database for email
$email = $_POST['email'];

$sql = "SELECT * FROM bookcustomers WHERE email = $email";

$result = mysqli_query($link, $sql) or die('SQL syntax error while retriving items for customer checkout02: ' . mysqli_error($link));

if (mysqli_num_rows($result) == 0) {
    echo "New Customer - Please provide your shipping address.";
} else {
    echo "Returning Customer - Please confirm your mailing and e-mail addresses.";
    $row = mysqli_fetch_array($result);
}
?>

<div class="col-md-12">

</div>

<?php include_once('include/footer.php'); ?>