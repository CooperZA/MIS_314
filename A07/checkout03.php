<?php
// include database connection, encryption and cleaner functions
include('util/databaseconnect.php');
include('validation.php');
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
// if something goes wrong with pulling in values
// exit script and display a back btn

///////////// NEED TO REFACTOR THE ARRAY INTO INDIVIDUAL VALUES
// in order for sql to work

// get values from post
// create array
$array = array(
    'email' => strip_tags($_POST['email']),
    'fname' => strip_tags($_POST['fname']),
    'lname' => strip_tags($_POST['lname']),
    'street' => strip_tags($_POST['street']),
    'city' => strip_tags($_POST['city']),
    'state' => strip_tags($_POST['state']),
    'zip' => strip_tags($_POST['zip']),
    'custID' => decrypt($_POST['custID']),
);

// if true then
if(fIsValidInputArray($array)){
    // echo back btn
    echo "Oh no something went wrong!";
    echo "<button class='btn btn-primary' onclick='goBack()'>Go Back</button>";
    exit();
}

// debug
echo $array['custID'];

// Check the custID length to determine if the customer is returning or not. insert or update customer table
if ( strlen(strval($array['custID'])) == 0 ){
    // new customer
    $sql = "INSERT INTO bookcustomers (email, fname, lname, street, city, state, zip, custID)
            VALUES ($array['email'], $array['fname'], $array['lname'], $array['street'], $array['city'], $array['state'], $array['zip'], $array['custID'] )";
    echo $sql;
    // get the customerid of the record inserted 
    $newCustID = mysqli_insert_id($link);

}else{
    // returing customer
    $sql = "UPDATE bookcustomers
            SET email = $array['email'], fname = $array['fname'], lname = $array['lname'], street = $array['street'], city = $array['city'], state = $array['state'], zip = $array['zip']
            WHERE custID = $array['custID']";

    echo $sql;
}

// TODO: Retreive order data from the cookie

// TODO: Display Order confirmation information

// TODO: Send email confirmation

?>


<?php include_once('include/footer.php'); ?>