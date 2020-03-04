<?php
include('util/databaseconnect.php');
$link = fConnectToDatabase();

// include header and menu
include_once('include/header.php');

// query database for email
$email = strval(fCleanString($link, $_POST['email'], 50));

$sql = "SELECT * FROM bookcustomers WHERE email = '$email'";

$result = mysqli_query($link, $sql) or die('SQL syntax error while retriving items for customer checkout02: ' . mysqli_error($link));

if (mysqli_num_rows($result) == 0) {
    $custStatus = "New Customer - Please provide your shipping address.";
} else {
    $custStatus = "Returning Customer - Please confirm your mailing and e-mail addresses.";
    $row = mysqli_fetch_array($result);
}

// while($row = mysqli_fetch_array($result)){
?>

<div class="col-md-12">
    <div class="checkout-content">
        <h2 class="text-center">Shipping Information</h2>
        <p class="text-center"><?php echo $custStatus; ?></p>
        <form action="checkout03.php" method="post" autocomplete="on" class="form-checkout">
            <div class="formGroup">
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo $email; ?>" required placeholder="Enter Email" maxlength="50">
            </div>
            <div class="formGroup">
                <label for="fname">First Name:</label>
                <input type="text" name="fname" value="<?php echo $row['fname']; ?>" autofocus="" required placeholder="First name" title="first name" maxlength="20" pattern="[A-Za-z'-]{2,20}">
            </div>
            <div class="formGroup">
                <label for="lname">Last Name:</label>
                <input type="text" name="lname" value="<?php echo $row['lname']; ?>" required placeholder="Last name" title="last name" maxlength="20" pattern="[A-Za-z'-]{2,20}">
            </div>
            <div class="formGroup">
                <label for="street">Street:</label>
                <input type="text" name="street" value="<?php echo $row['street']; ?>" required placeholder="Street address" title="street address" maxlength="25">
            </div>
            <div class="formGroup">
                <label for="city">City:</label>
                <input type="text" name="city" value="<?php echo $row['city']; ?>" required placeholder="City" title="city" maxlength="30" pattern="[A-Za-z'-]{2,30}">
            </div>
            <div class="formGroup">
                <label for="state">State:</label>
                <input type="text" name="state" value="<?php echo $row['state']; ?>" required placeholder="ST" title="state" maxlength="2" pattern="[A-Za-z]{2}">
            </div>
            <div class="formGroup">
                <label for="zip">Zip:</label>
                <input type="text" name="zip" value="<?php echo $row['zip']; ?>" required placeholder="Zip" title="zip" maxlength="5" pattern="[0-9]{5}">
            </div>
            <div class="formGroup">
                <input type="hidden" name="custID" value="<?php echo $row['custID']; ?>">
                <input class="btn btn-primary pull-right" type="submit" value="Place Order">
            </div>
        </form>
    </div>
</div>

<?php 
// }

include_once('include/footer.php'); 
?>