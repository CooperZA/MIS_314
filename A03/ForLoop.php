<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="pageContainer centerText">

<h2>For Loop</h2><hr>

<form>
   
   <p>Iterations:
      <input type="text" name="rows" size="5" autofocus>
      <input type="submit" value="Loop">
   </p>
</form>

<?php 
    $rows = $_GET['rows'];

    if(isset($rows)){
        for($i = 0; $i < $rows; $i++){
            echo "Iteration: {$i} <br>\n";
        }
    }
?>

</div>
</body>
</html>