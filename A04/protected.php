<?php
session_start();

// upgrade to HTTPS
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}
// echo 'username is: ' . $_SESSION['username'];
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

// check if logout button was clicked
if ($_POST['abandon']){
    session_unset();
    header("location: login.php");
    exit;
}
?>

<html>

<head>
    <title>Password Protected Page</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="pageContainer centerText">

        <h2>Password Protected Page</h2>
        <hr>

        <h2>Welcome <? echo $_SESSION["username"] ?></h2>
        <img src="http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/images/vault.jpg" style="width:400px; height:auto;" />
        <br>
        Your session will timeout
        after 24 minutes of inactivity.<br><br>

        <form method="post" class="formLayout">
            <div class="formGroup">
                <input type="hidden" name="abandon" value="true">
                <label> </label>
                <button type="submit">Logout</button>
            </div>
        </form>

    </div>
</body>

</html>