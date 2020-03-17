<?php
include('util/databaseconnect.php');
$link = fConnectToDatabase();

//Shopping cart uses cookies to store cart items.
//PHP script uses an array for adding, removing and displaying the cart items.
//Cookies can contain only string data so array must be serialized.

// $bookArray is an array of key value pairs $isbn => $qty

$cookieName = "myCart2";
// retrieve cookie and unserialize into $bookArray
if (isset($_COOKIE[$cookieName])) {
    $bookArray = unserialize($_COOKIE[$cookieName]);
}
// Add items to cart
$addISBN = fCleanString($link, $_GET['addISBN'], 10);
if (strlen($addISBN) > 0) {
    if (isset($addISBN, $bookArray)) {
        // Increment by +1
        $bookArray[$addISBN] += 1;
    } else {
        // Add new item to cart
        $bookArray[$addISBN] = 1;
    }
}
// Remove items from cart
$deleteISBN = fCleanString($link, $_GET['deleteISBN'], 10);
if (strlen($deleteISBN) > 0) {
    if (isset($bookArray[$deleteISBN])) {
        // Deincrement by 1
        $bookArray[$deleteISBN] -= 1;
        // remove ISBN from array if qty==0
        if ($bookArray[$deleteISBN] == 0) {
            unset($bookArray[$deleteISBN]);
        }
    }
}

$totalbooks = 0;
if (isset($bookArray)) {
    // Write cookie
    setcookie($cookieName, serialize($bookArray), time() + 60 * 60 * 24 * 180);

    //Count total books in cart
    foreach ($bookArray as $isbn => $qty) {
        $totalbooks += $qty;
    }
    setCookie('BookCount', $totalbooks, time() + 60 * 60 * 24 * 180);
}
//***************************************************
//You do not need to modify any code above this point
//***************************************************
include_once("include/header.php");
include_once("include/menu.php");
?>
<div id="pageContent">
    <p class="centeredText">
        <?php
        echo $totalbooks . " item";
        if ($totalbooks != 1)
            echo 's';
        echo ' in your cart'
        ?>
    </p>

    <?php
    // Build sql statement containing ISBNs. Use foreach loop.
    $sql = "SELECT isbn, title, price 
                        FROM bookdescriptions
                        WHERE";

    // append the isbns onto the sql statement
    foreach ($bookArray as $isbn => $qty) {
        $sql .= " isbn = '$isbn' OR";
    }

    // remove last 2 indexes from $sql string
    $sql = substr($sql, 0, strlen($sql) - 2);

    // 2. Execute sql and display book titles, prices, qty, etc.
    $result = mysqli_query($link, $sql) or die('SQL syntax error while retriving items for shopping cart: ' . mysqli_error($link));

    // declare subtotal variable
    $subtotal = 0;
    $itemCount = 0;
    $ship = 4;
    $additionShip = 0.5;
    $itemCount = 0;

    if (isset($bookArray)) {
        echo "<table id='cart'>\n" .
            "<tr>\n
                <th>Title</th>\n
                <th class='m-3'>Qty</th>\n
                <th class='m-3'>Price</th>\n
                <th class='m-3'>Total</th>\n
                <th></th>
            </tr>\n";

        while ($row = mysqli_fetch_array($result)) {
            // pull in row values
            $isbn = $row['isbn'];
            $title = $row['title'];
            $price = $row['price'];
            $qty = $bookArray[$isbn];
            $itemTotal = 0.8 * ($price * $qty);
            $subtotal += $itemTotal;
            $itemCount += $qty;

            echo "
                <tr> \n
                    <td>
                        <a class='booktitle' href='ProductPage.php?isbn=$isbn'>$title</a>
                    </td>
                    <td class='m-2'>$qty</td>
                    <td class='bookPrice'>$price</td>
                    <td class='bookPrice'>$itemTotal</td>
                    <td style='text-align: center;'>
                        <a href='?addISBN=$isbn'>Add</a><br>
                        <a href='?deleteISBN=$isbn'>Remove</a>
                    </td>
                </tr>\n";
        }
    }

    // calculate shipping
    $shipping = $ship + (($itemCount - 1) * $additionShip);

    ?>
    </table>

    <!-- cart totals -->
    <table class="cartTotal">
        <tr>
            <td> Sub-Total:</td>
            <td align="right"><?php echo '$' . number_format($subtotal, 2); ?></td>
        </tr>
        <tr>
            <td> Shipping:*</td>
            <td align="right"><?php echo '$' . number_format($shipping, 2); ?></td>
        </tr>
        <tr>
            <td><b>Total:</b></td>
            <td align="right"><b><?php echo '$' . number_format(($subtotal + $shipping), 2); ?></b></td>
        </tr>
    </table>
    <!-- cart icons -->
    <div class="cartIcons">
        <a href="index.php"> 
            <button type="button" class="btn btn-secondary">Continue Shopping</button>
        </a>
        <a href="checkout01.php"> 
            <button type="button" class="btn btn-primary">Proceed to Checkout</button>
        </a>
    </div>

    <!-- shipping rules -->
    <p class="shipping">* shipping is $4.00 for the first item and $0.50 for each additional item.</p>
</div>


<?php include("include/footer.php"); ?>