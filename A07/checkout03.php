<?php
// include database connection, encryption and cleaner functions
include('util/databaseconnect.php');
include('util/validation.php');
include('util/encryption.php');
$link = fConnectToDatabase();

// inclde header file
include_once('include/header.php');

// must arrive from checkout02
$referrer = $_SERVER['HTTP_REFERER'];

if (stripos($referrer, 'checkout02.php') == false) header("location:checkout01.php");

// validate user inputs from checkout02
/* 
    values from checkout02
    - email
    - fname
    - lname
    - street
    - city
    - state
    - zip
    - custID
*/

// get values from post
$userEmail = fCleanString($link, $_POST['email'], 50);
$userFname = fCleanString($link, $_POST['fname'], 20);
$userLname = fCleanString($link, $_POST['lname'], 20);
$userStreet = fCleanString($link, $_POST['street'], 25);
$userCity = fCleanString($link, $_POST['city'], 30);
$userState = fCleanString($link, $_POST['state'], 2);
$userZip = fCleanString($link, $_POST['zip'], 5);
$userID = decrypt($_POST['custIDe']);

// validate
$validArr = array(
    fIsValidEmail($userEmail),
    fIsValidLength($userFname, 2, 20),
    fIsValidLength($userLname, 2, 20),
    fIsValidLength($userStreet, 0, 25),
    fIsValidLength($userCity, 2, 30),
    fIsValidStateAbbr($userState),
    fIsValidLength($userZip, 5, 5)
);


// if something goes wrong with pulling in values
// exit script and display a back btn
if(in_array(FALSE, $validArr)){
    // echo back btn
    echo "Oh no something went wrong!";
    echo "<button class='btn btn-primary' onclick='goBack()'>Go Back</button>";
    exit();
}

$sql;

// if statement working revisiting customer may have some issues
// Check the custID length to determine if the customer is returning or not. insert or update customer table
if ( strlen(strval($userID)) == 0 ){
    // new customer
    $sql = "INSERT INTO bookcustomers (email, fname, lname, street, city, state, zip)
            VALUES ('$userEmail', '$userFname', '$userLname', '$userStreet', '$userCity', '$userState', '$userZip')";

    // execute sql
    mysqli_query($link, $sql) or die('sql error when inserting a new customer in checkout03: ' . mysqli_error($link));

    // get the customerid of the record inserted 
    $userID = mysqli_insert_id($link);

}else{
    // returing customer
    $sql = "UPDATE bookcustomers
            SET email = '$userEmail', fname = '$userFname', lname = '$userLname', street = '$userStreet', city = '$userCity', state = '$userState', zip = '$userZip'
            WHERE custID = $userID";
    
    echo $sql;

    // execute sql
    mysqli_query($link, $sql) or die('sql error when updating the returning customer in checkout03: ' . mysqli_error($link));
}

// TODO: Retreive order data from the cookie
// cookie name
$cookieName = "myCart2";

// empty book array
$bookArray = [];

// retrieve cookie and unserialize into $bookArray
if (isset($_COOKIE[$cookieName])) {
    $bookArray = unserialize($_COOKIE[$cookieName]);
}

echo $bookArray;

// dispose of cookie
setcookie($cookieName, null, time() - 60000);

// check if there are books in the book array
if ( count($bookArray) > 0 ){
    $orderSql = "INSERT INTO bookorders (custID, orderdate) 
                VALUES ($userID, time())";

    // execute query
    mysqli_query($link, $orderSql) or die('sql error when inserting into bookorders in checkout03: ' . mysqli_error($link));

    // get order id of inserted record
    $orderID = mysqli_insert_id($link);
}

//////// ???????
// loop through bookarray to add data to bookorderitems table
foreach ($bookArray as $item => $val){
    $isbn = $bookArray['isbn'];
    $qty = $bookArray['qty'];
    echo $bookArray;
    $bookItemsSql = "INSERT INTO bookorderitems (orderID, isbn, qty, price) VALUES ($orderID, '$isbn')";
}

// TODO: Display Order confirmation information

// get book information from database


// TODO: Send email confirmation

?>

<!-- order history -->
<form action="orderHistory.php" method="POST">
    <div class="formGroup">
        <input type="hidden" name="custIDe" value="<?php echo encrypt($userID); ?>">
        <input class="btn btn-primary text-center" type="submit" value="Order History">
    </div>
</form>

<?php include_once('include/footer.php'); ?>