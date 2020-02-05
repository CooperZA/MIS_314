<html>

<head>
    <title>Select Color</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<?php
include 'validationUtilities.php';

//must arrive from order02.php
$referrer = $_SERVER['HTTP_REFERER'];

// if (stripos($referrer, 'order02.php') == false) header("location:order01.php");

// cookies for order form
// variable names for cookies
$fname = 'FirstName';
$carModel = 'CarModel';

// get variables from forms
$name = $_GET['fname'];
$car = $_GET['model'];

if (isset($name) && isset($car)) {
    // validate
    if (!fIsValidLength($name)) {
        exit("Name is not valid");
    }

    if (!fIsValidCar($car)) {
        exit("Car is not valid");
    }
}

// send car to lower for link
$car = trim(strtolower($car));

// set cookies
setcookie($fname, $name, time() + 60 * 60 * 24);
setcookie($carModel, $car, time() + 60 * 60 * 24);

?>

<body>
    <div class="pageContainer centerText">
        <p></p>
        <h2 class="centerText">Select Color</h2>
        <div class="pageContainer">
            <form action="Order03.php" class="formLayout">
                <div class="formGroup">
                    <label>Car color:</label>
                    <div class="formElements">
                        <select name="color" required>
                            <option value=""></option>
                            <option style="background-color: blue; color:white;" value="Blue">Blue</option>
                            <option style="background-color: red" value="Red">Red</option>
                            <option style="background-color: yellow" value="Yellow">Yellow</option>
                        </select>
                    </div>
                </div>
                <div class="formGroup">
                    <label></label>
                    <button type="submit"> >> Next >> </button>
                </div>
                <div class="centerText vertGap55">
                    <button type="submit" formnovalidate>Submit without validation</button><br><br>
                    <a href="?">Reload page</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>