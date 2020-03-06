<?php
// All validation functions return either true or false.
// 
// Validate string length.
function fIsValidLength($input, $minLength, $maxLength) {
   //returns true of false
   //trim empty spaces from beginning and end
   $input = trim($input);
   $IsValid = (strlen($input) >= $minLength && strlen($input) <= $maxLength);
   return $IsValid;
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

// check values in a given structured array, determine if they are valid or not
function fIsValidInputArray($arr) {
   /* 
      ARRAY must be in format [email, fname, lname, street, city, state, zip, custID]
   */

   // get keys from array
   $keys = array_keys($arr);

   // array to be populated with T/F values to check if a provided entry was invalid
   $checkArray = [];

   // loop through array
   for ( $i = 0; $i < count($arr); $i++ ){
      // current key
      $ckey = $keys[$i];
      // check the key of the array
      if ($ckey == 'email') {

         array_push($checkArray, fIsValidEmail($arr[$ckey]));
      }else if ($ckey == 'state'){

         array_push($checkArray, fIsValidStateAbbr($arr[$ckey]));
      }else if ($ckey == 'custID'){

         array_push($checkArray, isnumeric($arr[$ckey]));
      }else if ($ckey == 'zip'){

         array_push($checkArray, fIsValidLength($arr[$ckey], 5, 5));
      }else if ($ckey == 'city'){

         array_push($checkArray, fIsValidLength($arr[$ckey], 2, 3));
      }else if ($ckey == 'street'){
         
         array_push($checkArray, fIsValidLength($arr[$ckey], 2, 25));
      }else{
         // first name last name
         array_push($checkArray, is fIsValidLength($arr[$ckey], 2, 20));
      }
   }

   // check if any values are false, if they are return false
   if (in_array(false, $checkArray)){
      return false;
   }else{
      return true;
   }
}