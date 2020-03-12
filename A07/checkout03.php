<?php
// include database connection, encryption and cleaner functions
include('util/databaseconnect.php');
include('util/validation.php');
include('util/encryption.php');
include('util/mailGenerator.php');
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
if (in_array(FALSE, $validArr)) {
    // echo back btn
    echo "Oh no something went wrong!";
    echo "<button class='btn btn-primary' onclick='goBack()'>Go Back</button>";
    exit();
}

$sql;

// if statement working revisiting customer may have some issues
// Check the custID length to determine if the customer is returning or not. insert or update customer table
if (strlen(strval($userID)) == 0) {
    // new customer
    $sql = "INSERT INTO bookcustomers (email, fname, lname, street, city, state, zip)
            VALUES ('$userEmail', '$userFname', '$userLname', '$userStreet', '$userCity', '$userState', '$userZip')";

    // execute sql
    mysqli_query($link, $sql) or die('sql error when inserting a new customer in checkout03: ' . mysqli_error($link));

    // get the customerid of the record inserted 
    $userID = mysqli_insert_id($link);
} else {
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

// time var
$currTime = time();

// check if there are books in the book array
if (count($bookArray) > 0) {
    $orderSql = "INSERT INTO bookorders (custID, orderdate) 
                VALUES ($userID, '$currTime')";

    // execute query
    mysqli_query($link, $orderSql) or die('sql error when inserting into bookorders in checkout03: ' . mysqli_error($link));

    // get order id of inserted record
    $orderID = mysqli_insert_id($link);
}

// loop through bookarray to add data to bookorderitems table
foreach ($bookArray as $isbn => $qty) {
    $discount = 0.8;

    $bookItemsSql = "INSERT INTO bookorderitems (orderID, isbn, qty, price) 
                    VALUES ($orderID, '$isbn', $qty, 
                    (SELECT (price * $discount) FROM bookdescriptions WHERE isbn = '$isbn'));";

    // Execute script
    mysqli_query($link, $bookItemsSql) or die('sql error when inserting order items into bookorderitems: ' . mysqli_error($link));
}

// TODO: Display Order confirmation information
// get book information from database
$orderConfirmationSql = "SELECT isbn, title, price 
                        FROM bookdescriptions
                        WHERE";

// append the isbns onto the sql statement
foreach ($bookArray as $isbn => $qty) {
    $orderConfirmationSql .= " isbn = '$isbn' OR";
}

// remove last 2 indexes from $sql string
$orderConfirmationSql = substr($orderConfirmationSql, 0, strlen($orderConfirmationSql) - 2);

// 2. Execute sql and display book titles, prices, qty, etc.
$result = mysqli_query($link, $orderConfirmationSql) or die('SQL syntax error while retriving items for order confirmation: ' . mysqli_error($link));

// declare subtotal variable
$subtotal = 0;
$itemCount = 0;
$ship = 4;
$additionShip = 0.5;

if (isset($bookArray)) {
    // variable for body of email
    $emailBody;

    // echo order number and user information, append to email body
    $emailBody .= "<table id='cart'>\n" .
        "<tbody>
        <tr>
            <td class='font-weight-bold'>Order Number:</td>\n
            <td>$orderID</td>\n
        </tr>
        <tr>
            <td class='font-weight-bold'>Shipping Address</td>
            <td>$userFname $userLname <br>
                $userStreet <br>
                $userCity, $userState $userZip<br>
            </td>
        </tr>
        <tr>
            <td class='font-weight-bold'>Books Shipped:</td>
            <td>
                <table>
                    <tbody>
                        <tr>
                            <th>Title</th>\n
                            <th>Qty</th>\n
                            <th>Price</th>\n
                            <th>Total</th>\n
                        </tr>";

        // echo $emailBody;

    while ($row = mysqli_fetch_array($result)) {
        // pull in row values
        $isbn = $row['isbn'];
        $title = $row['title'];
        $price = $row['price'];
        $qty = $bookArray[$isbn];
        $itemTotal = $price * $qty;
        $subtotal += $itemTotal;
        $itemCount++;

        // append each record to email body
        $emailBody .= "
                <tr> \n
                    <td>
                        <a class='booktitle' href='ProductPage.php?isbn=$isbn'>$title</a>
                    </td>
                    <td>$qty</td>
                    <td class='bookPrice text-center'>$price</td>
                    <td class='bookPrice'>$itemTotal</td>
                </tr>\n";
        // echo $emailBody;
    }
}

// calculate shipping
$shipping = $ship + (($itemCount - 1) * $additionShip);

$emailBody .= "</tbody></table></td></tr></tbody></table>
<table class='cartTotal'>
    <tr>
        <td> Sub-Total:</td>
        <td align='right'>" . '$' . number_format($subtotal, 2) ."</td>
    </tr>
    <tr>
        <td> Shipping:*</td>
        <td align='right'>" . "$" . number_format($shipping, 2) . "</td>
    </tr>
    <tr>
        <td><b>Total:</b></td>
        <td align='right'><b>" . "$" . number_format(($subtotal + $shipping), 2) . "</b></td>
    </tr>
</table>";

echo $emailBody;
?>
<div class='text-center'>
    <a href='index.php' class='btn btn-primary'>Continue Shopping</a>
</div>

<!-- order history -->
<form action="orderHistory.php" method="POST">
    <div class="formGroup">
        <input type="hidden" name="custIDe" value="<?php echo encrypt($userID); ?>">
        <input class="btn btn-primary text-center" type="submit" value="Order History">
    </div>
</form>

<?php
// TODO: Send email confirmation
// send email
MailHelper::GenerateEmail($userEmail, $emailBody);

include_once('include/footer.php');
?>