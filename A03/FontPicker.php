<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Font Picker | MIS 314</title>
    <link rel="stylesheet" href="css/style.css">
    <script>
        //onload reset radiobutton list to selected item  
        function selectRadioButton() {
            //retrive selected item from querystring
            var querystring = document.location.search.substring(1);
            var selectedFont = querystring.match(/font=.*&/i);
            selectedFont = selectedFont[0].replace("font=", "").replace("&", "");

            //check the appropriate radio button
            var radio = document.getElementsByName("font");
            for (i = 0; i < radio.length; i++) {
                if (radio[i].value == selectedFont) {
                    radio[i].checked = true;
                }
            }
        }
    </script>
</head>

<body onload="selectRadioButton();">
    <div class="pageContainer centerText" style="width: 800px;">

        <form>
            <p>Please select a font and enter a message:</p>
            <div class="inputBlock">
                <input type="radio" name="font" required value="Chunk/Red">Chunk Red
                <input type="radio" name="font" value="Deco/Blue">Deco Blue
                <input type="radio" name="font" value="Animals">Animals
                <input type="radio" name="font" value="Elegant/Red">Elegant Red
                <input type="radio" name="font" value="Funky">Funky
                <input type="radio" name="font" value="Tape/Punch">TapePunch
            </div>
            <br>
            <input type="text" name="message" required size="50" value="The Quick Brown Fox Jumps Over the Lazy Dog">
            <input type="submit" Value="Send">
            <br>
        </form>
        <br>
        <?php
            // pull in variables
            $font = strtolower($_GET['font']);

            $message = $_GET['message'];

            // check that font and message are set
            if (!empty($font) && !empty($message)) {
                // loop through the message string
                for ($i = 0; $i < strlen($message); $i++) {
                    // get sub tring
                    $char = substr($message, $i, 1);

                    if ($char != " ") {
                        // get url for image
                        $url = fGetUrl($font, $char);
                        
                        // output url
                        echo "<img src='{$url}'>\n";
                        
                    } else {
                        echo "<br>\n";
                    }
                }
            }

        ?>
    </div>
</body>

</html>

<?php
    /* Function Declarations */
    function fGetUrl($font, $char) {
        // trim font
        $font = trim($font);

        // find font url based on the font
        switch ($font) {
            case "chunk/red":
                return "http://yorktown.cbe.wwu.edu/sandvig/Images/Alphabet/chunk/red/" . $char . "9.jpg";

            case "deco/blue":
                return "http://yorktown.cbe.wwu.edu/sandvig/Images/Alphabet/deco/blue/" . $char . "1.gif";

            case "animals":
                return "http://yorktown.cbe.wwu.edu/sandvig/Images/Alphabet/animals/" . $char . "4.gif";

            case "elegant/red":
                return "http://yorktown.cbe.wwu.edu/sandvig/Images/Alphabet/elegant/red/4" . $char . ".gif";

            case "funky":
                return "http://yorktown.cbe.wwu.edu/sandvig/Images/Alphabet/funky/" . $char . "3.jpg";

            case "tape/punch":
                return "http://yorktown.cbe.wwu.edu/sandvig/Images/Alphabet/punch/black/" . $char . "7.gif";
        }
    }
?>