<?php
session_start();

// upgrade to HTTPS
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}

// Using post method so values will not be passed in the query string
// pull in values from login form
if ($_POST['postback']){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $postback = $_POST['postback'];
}


if ($password == 'guest' && strlen($username) > 0) {
    // add flag to session array
    $_SESSION['username'] = $username;

    $_SESSION['password'] = $password;

    $_SESSION['postback'] = true;
    
    // redirect to protected
    header("location: protected.php");
    
    exit;
}
?>
<html>

<head>
    <title>Login</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="pageContainer centerText">
        <h2>Login</h2>
        <form method="post" class="formLayout">
            <div class="formGroup">
                <label>First name:</label>
                <input type="text" name="username" value="<?php echo $username; ?>" class="formElement" placeholder="first name" title="first name" required autofocus /><br>
                <span class="alert">
                    <?php
                    if ($postback && strlen($username) < 1 ) {
                        echo "Please enter your name.";
                    }
                    ?>
                </span>
            </div>

            <div class="formGroup">
                <label>Password:</label>
                <input type="password" name="password" class="formElement" placeholder="password" title="password" required />
                <br>
                <label></label>(Password is 'guest')<br>
                <label></label>
                <span class="alert">&nbsp;
                    <?php
                    if ( $password != 'guest' && strlen($username) <= 0 && $postback){
                        echo "invalid password";
                    }
                    ?>
                </span>
            </div>

            <div class="formGroup">
                <label></label>
                <input type="hidden" name="postback" value="true">
                <button type="submit" name="submit" value="submit">Login</button>
            </div>
            <div class="formGroup">
                <label></label>
                <button type="submit" formnovalidate>Login without HTML5 validation</button>
            </div>

            <div class="vertGap55 centerText">
                <a href="protected.php">Try going to protected.php without logging on.</a>
            </div>
        </form>

    </div>
</body>

</html>