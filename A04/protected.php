<?php
    if (!isset($_SESSION["username"])) {
        header("location: login.php");
        exit;
    }

    // check if logout button was clicked
    if (isset($_POST['submit'])) {
        $logout = true;
        session_unset();
        header("location: login.php");
        exit;
    }
?>

<html>

<head>
    <title>Password Protected Page</title>
    <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="pageContainer centerText">

        <h2>Password Protected Page</h2>
        <hr>

        <h2>Welcome <? echo $_SESSION["username"] ?></h2>
        <img src="http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/images/vault.jpg" style="width:400px;height:auto;" />
        <br>
        Your session will timeout
        after 24 minutes of inactivity.<br><br>

        <form method="post" class="formLayout">
            <div class="formGroup">
                <input type="hidden" name="abandon" value="<?php echo $logout; ?>">
                <label> </label>
                <button type="submit">Logout</button>
            </div>
        </form>

    </div>
</body>

</html>