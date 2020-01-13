<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hello_World</title>
        <link rel="stylesheet" href="hello_world.css"/>
    </head>
    <body>
        <div id="wrapper">
            <div class="container">
                <div class="header">
                    <h1>Hello World!</h1>
                </div>
                <?php
                for($i = 0; $i <= 10; $i++){

                    $out = "Hello World!"

                ?>
                    <p><?php echo $out ?> Value of i is <?php echo $i ?></p>
                <?php
                }
                ?>
            </div>
        </div>
    </body>
</html>
