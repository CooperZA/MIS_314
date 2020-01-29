<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sales Calculation | MIS 314</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="pageContainer centerText">
        <h2>Sales Calculation</h2>
        <hr>
        <form>
            <p>Item Price:
                <input type="text" name="price" size="5" autofocus>
                <input type="submit" value="Calculate">
            </p>
        </form>
        <?php
        setlocale(LC_MONETARY, 'en_US.UTF-8');

        $price = $_GET['price'];

        if (!empty($price)) {
            if (is_numeric($price)) {

                // do some math
                // discount
                $disc = $price * (-0.25);
                // discounted price
                $discPrice = $price + $disc;
                // tax
                $tax = $price * 0.084;
                // Total
                $total = $discPrice + $tax;

                // get date and time
                $date = date('M') . ' ' . date('d') . ', ' . date('Y');

                // get time
                $time = date('h:i:s a');

                // final message
                $thank = "<h3>Thank you for shopping at Discount-O-Rama!</h3>";

                // output
            ?>
                <!-- table output -->
                <table class="simpleTable">
                    <tbody>
                        <tr>
                            <td align="right">Price:</td>
                            <td><?php echo '$' . number_format($price, 2); ?></td>
                        </tr>
                        <tr>
                            <td align="right">25% discount:</td>
                            <td><?php echo '$' . number_format($disc, 2); ?></td>
                        </tr>
                        <tr>
                            <td align="right">Discounted Price:</td>
                            <td><?php echo '$' . number_format($discPrice, 2); ?></td>
                        </tr>
                        <tr>
                            <td align="right">Tax (8.4%)</td>
                            <td><?php echo '$' . number_format($tax, 2); ?></td>
                        </tr>
                        <tr>
                            <td align="right">Total due:</td>
                            <td><?php echo '$' . number_format($total, 2); ?></td>
                        </tr>
                    </tbody>
                </table>

                <br>
                <!-- Time Table -->
                <table class="simpleTable">
                    <tbody>
                        <tr>
                            <td align="right">Sale date:</td>
                            <td><?php echo $date; ?></td>
                        </tr>
                        <tr>
                            <td align="right">Sale time:</td>
                            <td><?php echo $time; ?></td>
                        </tr>
                    </tbody>
                </table>
                <?php 

                echo $thank; 

            } else {
                echo '<div class="alert">Invalid entry. Please enter a numeric value.</div>';
            }
        }
        ?>


    </div>
</body>

</html>