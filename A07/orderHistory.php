<?php
include('util/databaseconnect.php');
include('util/validation.php');
include('util/encryption.php');
include('util/mailGenerator.php');

$link = fConnectToDatabase();

include_once('include/header.php');
// get customer id from post
$custID = decrypt($_POST['custIDe']);

// search database for records associated with custID
$sql = "SELECT bo.orderID, bo.orderdate, boi.qty, bd.title, boi.ISBN
        FROM bookdescriptions bd 
        JOIN bookorderitems boi ON bd.ISBN = boi.ISBN 
        JOIN bookorders bo ON boi.orderID = bo.orderID 
        JOIN bookauthorsbooks bab ON boi.ISBN = bab.ISBN
        JOIN bookauthors ba ON bab.AuthorID = ba.AuthorID 
        WHERE bo.custID = $custID
        ORDER BY boi.orderID asc";

$result = mysqli_query($link, $sql) or die('SQL syntax error while retriving items for order history: ' . mysqli_error($link));
?>
<div class="font-weight-bold text-center">Your Order History</div>
<br>
<div class="font-weight-bold text-center">You have ordered <?php echo mysqli_num_rows($result); ?> books</div>
<?php
// loop through book results
while ($row = mysqli_fetch_array($result)){
    $orderID = $row['orderID'];
    $orderDate = date('m/d/Y', $row['orderdate']);
    $qty = $row['qty'];
    $title = $row['title'];
    $isbn = $row['ISBN'];
    $author = fListAuthors($link, $isbn);

    ?>
        <div class="book-container">
            <a href="productpage.php?isbn=<?php echo $isbn; ?>" class="book-title">
                <img src="http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/bookstore/bookimages/<?php echo $isbn; ?>.01.THUMBZZZ.jpg" alt="<?php echo $title; ?>">
            </a>
            <span>
                <b>Order ID: <?php echo $orderID; ?></b>
                <p class="ml-1"><?php echo $orderDate;?></p>
            </span>
            <a href="productpage.php?isbn=<?php echo $isbn; ?>" class="book-title">
                <?php echo $title; ?>
            </a>
            <br>
            <span>
                by <?php echo fListAuthors($link, $isbn) ?>
            </span>
            <span>
                <p class="">
                    Qty: <?php echo $qty; ?>
                </p>
            </span>
        </div>
    <?php
}

include_once('include/footer.php');
?>