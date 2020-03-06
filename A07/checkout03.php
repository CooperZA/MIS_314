<?php
// include database connection, encryption and cleaner functions
include('util/databaseconnect.php');
include('validation.php');
include('util/encryption.php');
$link = fConnectToDatabase();

// inclde header file
include_once('include/header.php');

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

// get values from post
// create array
$array = array(
    'email' => $_POST['email'],
    'fname' => $_POST['fname'],
    'lname' => $_POST['lname'],
    'street' => $_POST['street'],
    'city' => $_POST['city'],
    'state' => $_POST['state'],
    'zip' => $_POST['zip'],
    'custID' => decrypt($_POST['custID']),
);

// if true then
if(fIsValidInputArray($array)){
    // echo back btn
    echo "Oh no something went wrong!";
    echo "<button class='btn btn-primary' onclick='goBack()'>Go Back</button>";
}


?>


<?php include_once('include/footer.php'); ?>