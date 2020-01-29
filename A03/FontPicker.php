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
                <input type="radio" name="font" required value="ChunkRed">Chunk Red
                <input type="radio" name="font" value="DecoBlue">Deco Blue
                <input type="radio" name="font" value="Animals">Animals
                <input type="radio" name="font" value="ElegantRed">Elegant Red
                <input type="radio" name="font" value="Funky">Funky
                <input type="radio" name="font" value="TapePunch">TapePunch
            </div>
            <br>
            <input type="text" name="message" required size="50" value="The Quick Brown Fox Jumps Over the Lazy Dog">
            <input type="submit" Value="Send">
            <br>
        </form>

    </div>
</body>

</html>