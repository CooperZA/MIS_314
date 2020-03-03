<?php 
include('util/databaseconnect.php');
$link = fConnectToDatabase();

// include header and menu 
include_once('include/header.php');

// get total books from cookie
$totalBooks = $_COOKIE['BookCount'];

?>

<div class="col-md-12">
    <h2>Your Account</h2>
    <h4>Buying online is quick and easy!</h4>
    <!-- display number of items in cart -->
    <h4>You have <?php echo $totalBooks; ?> items in your cart.</h4>

    <form class="" action="POST" action="checkout02.php" autocomplete="on">
        <div class="cartIcons">
            <div class="formGroup">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" autofocus="" required placeholder="Email">
            </div>
            <div class="formGroup">
                <input type="text" class="btn btn-primary" alt="Proceed to checkout">
            </div>
        </div>
    </form>
</div>

<?php include_once('include/footer.php'); ?>