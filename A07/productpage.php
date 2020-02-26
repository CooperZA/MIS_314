<?php
// page title
$pageTitle = 'Product Page';

// connect to DB
include('util/databaseconnect.php');

$link = fConnectToDatabase();

// include page sections
include('include/header.php');
include('include/menu.php');

// get isbn
$ISBN = fcleanString($link, $_GET['isbn'], 50);

$sql = "SELECT DISTINCT bd.title, bd.ISBN, bd.description, bd.price, bd.pages, bd.edition, bd.publisher 
FROM bookdescriptions bd 
JOIN bookauthorsbooks bab ON bd.ISBN = bab.ISBN 
JOIN bookauthors ba ON bab.AuthorID = ba.AuthorID
WHERE bd.ISBN = '$ISBN';";


$result = mysqli_query($link, $sql) or die('SQL syntax error while retriving items for index: ' . mysqli_error($link));

// print_r(mysqli_fetch_array($result));

?>
<div class="col-md-9">
    <?php
    // echo out three random books
    while ($row = mysqli_fetch_array($result)) {
        // retreive values from row array
        $ISBN = $row['ISBN'];
        $title = $row['title'];
        $desc = $row['description'];
        $price = $row['price'];
        $pages = $row['pages'];
        $edition = $row['edition'];
        $publisher = $row['publisher'];
    ?>
        <div class="book-container">
            <div class="book-title"><?php echo $title; ?></div>

            <div class="authors">by <a href="seachbrowse.php?search=<?php echo $row['nameF'] ?>"><?php echo fListAuthors($link, $ISBN); ?></a></div>

            <a href="http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/bookstore/bookimages/<?php echo $ISBN; ?>.01.LZZZZZZZ.jpg" class="book-title">
                <img src="http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/bookstore/bookimages/<?php echo $ISBN; ?>.01.MZZZZZZZ.jpg" alt="<?php echo $title; ?>">
            </a>
            <br>
        </div>
        <div>
            <span class="priceLabel">List Price: </span>
            <span class="bookPriceList"><?php echo '$' . number_format($price, 2); ?></span>
        </div>

        <div>
            <span class="priceLabel">Our Price:</span>
            <span class="bookPriceB"><?php echo '$' . number_format(($price * 0.8), 2); ?></span>
        </div>

        <div>
            <span class="priceLabel">You Save:</span>
            <span class="bookPriceB"><?php echo '$' . number_format(($price * 0.2), 2); ?> (20%)</span><br />
        </div>

        <div class="bookDetails">
            <div> <b>ISBN:</b> <?php echo $ISBN; ?></div>
            <div> <b>Publisher:</b> <?php echo $publisher;?></div>
            <div> <b>Pages:</b> <?php echo $pages;?></div>
            <div> <b>Edition:</b> <?php echo $edition;?></div>
        </div>

        <a href="ShoppingCart.php?addISBN=<?php echo $ISBN; ?>">
            <img class="addToCart" src="/sandvig/mis314/assignments/bookstore/images/add-to-cart-small.gif" alt="Add to cart" title="Add to cart"></a>

        <div class="bookDescription">
            <?php echo $desc; ?>
        </div>
        <a href="ShoppingCart.php?addISBN=<?php echo $ISBN; ?>">
            <img class="addToCart" src="/sandvig/mis314/assignments/bookstore/images/add-to-shopping-cart-blue.gif" alt="Add to cart" title="Add to cart">
        </a>
    <?php
    }
    ?>
</div>
<?php
include('include/footer.php');
?>