<?php
// All validation functions return either true or false.
// 
// Validate string length.
function fIsValidLength($input, $minLength = 2, $maxLength = 30) {
   //returns true of false
   //trim empty spaces from beginning and end
   $input = trim($input);
   
   return (strlen($input) >= $minLength && strlen($input) <= $maxLength);
}

//email address
function fIsValidEmail($email) {
   //validate using php filter function. Returns true or false.
   $email = trim($email);
   if (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
      return false;
   else
      return true;
}

//state abbreviation
function fIsValidStateAbbr($state) {
   $ValidAbbr = array("AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL",
       "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MD", "MA",
       "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC",
       "ND", "OH", "OK", "OR", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT",
       "VA", "WA", "WV", "WI", "WY");

   //trim & change to upper case (to match strings in array)
   $state = trim(strtoupper($state));

   //check if a value exists in an array. 
   return in_array($state, $ValidAbbr);
}

//telephone numbers
function fIsValidPhone($phone) {
   //remove delimiters and spaces
   $pattern = "/[-,.()\s]/";
   $phone = preg_replace($pattern, '', $phone);

   //must be 10 digits
   return ((strlen($phone) == 10) && is_numeric($phone));
}

//date
function fIsValidDate($date) {
//date must be in format yyyy-mm-dd or yyyy/mm/dd (RFC 3339 format)
   $date = str_replace('-', '/', $date);
   $test_arr = explode('/', $date);
   if (count($test_arr) == 3 &&
           is_numeric($test_arr[0]) &&
           is_numeric($test_arr[1]) &&
           is_numeric($test_arr[2])) {
      //checkdate($month, $day, $year)
      if (checkdate($test_arr[1], $test_arr[2], $test_arr[0])) {
         return true;
      } else {
         return false; //invalid date
      }
   } else {
      return false; //invalid format
   }
}

// Age
function fIsValidRange($value, $min = 0, $max = 120){
   // trim age
   $value = trim($value);
   
   // check that age is numeric
   if (is_numeric($value)){      
      // check that age is within the bounds of age
      return ($value > $min and $value <= $max) ? true : false;

   } else {
      return false; // age is not numeric
   }
}

// ZipCode
function fIsValidZip($zip) {
   // trim zip
   $zip = trim($zip);

   // check is numeric and str len == 5
   return (is_numeric($zip) and strlen($zip) == 5) ? true : false;
}

// validate car
function fIsValidCar($model) {
   // trim model
   $model = trim($model);
   
   // cars array
   $cars = array("Mustang", "Subaru", "Corvette");

   // check value and return bool
   return in_array($model, $cars);
}

// validate color 
function fIsValidColor($c) {
   //trim
   $c = trim($c);

   // colors array
   $colors = array("Blue", "Red", "Yellow");

   // check for allowed colors and return
   return in_array($c, $colors);
}
?>


