<?php
// connect to DB
include('util/databaseconnect.php');

$link = fConnectToDatabase();

// get isbn
$ISBN = fcleanString($link, $_GET['isbn'], 50);


$sql = "SELECT bd.title, bd.ISBN, bd.description, bd.price, bd.pages, bd.edition, bd.pubdate, bd.publisher, ba.nameF, ba.nameL 
FROM bookdescriptions bd 
JOIN bookauthorsbooks bab ON bd.ISBN = bab.ISBN 
JOIN bookauthors ba ON bab.AuthorID = ba.AuthorID
WHERE bd.ISBN = '$ISBN';";


$result = mysqli_query($link, $sql) or die('SQL syntax error while retriving items for index: ' . mysqli_error($link));

// print_r(mysqli_fetch_array($result));

include('include/header.php');
include('include/menu.php');
?>
<div class="col-md-9">
    <?php
    // echo out three random books
    while ($row = mysqli_fetch_array($result)) {
        // retreive values from row array
        $ISBN = $row['ISBN'];
        $title = $row['title'];
        $author = $row['nameF'] . " " . $row['nameL'];
        $desc = substr($row['description'], 0, 200) . "<a href='productpage.php?isbn=$ISBN'>more...</a>";
        $price = $row['price'];
        $pages = $row['pages'];
        $edition = $row['edition'];
        $pubdate = $row['pubdate'];
        $publisher = $row['publisher'];
    ?>
        <div class="book-container">
            <div class="book-title"><?php echo $title; ?></div>

            <div class="authors">by <a href="seachbrowse.php?search=<?php echo $row['nameF']?>"><?php echo $author; ?></a></div>
            
            <a href="http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/bookstore/bookimages/<?php echo $ISBN; ?>.01.LZZZZZZZ.jpg" class="book-title">
                <img src="http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/bookstore/bookimages/<?php echo $ISBN; ?>.01.MZZZZZZZ.jpg" alt="<?php echo $title; ?>">
            </a>
            <br>
        </div>
        <!-- <div>
      <span class="priceLabel">List Price: </span>
      <span class="bookPriceList">
         $27.86      </span>
   </div>

   <div>
      <span class="priceLabel">Our Price:</span>
      <span class="bookPriceB">
         $22.29 </span>
   </div>

   <div>
      <span class="priceLabel">You Save:</span>
      <span class="bookPriceB">
         $5.57 (20%)</span><br />
   </div>

   <div class="bookDetails">
      <div> <b>ISBN:</b> 1491918667 </div>
      <div> <b>Publisher:</b> O'Reilly Media</div>
      <div>  <b>Pages:</b> 812</div>
      <div> <b>Edition:</b> 4</div>
   </div> 

   <a href="ShoppingCart.php?addISBN=1491918667">
      <img class="addToCart" src="/sandvig/mis314/assignments/bookstore/images/add-to-cart-small.gif" 
           alt="Add to cart" title="Add to cart" ></a>

   <div class="bookDescription">
       <p>         This book is for people who wish to learn how to create effective and dynamic websites. This may include webmasters or graphic designers who are already creating static websites but wish to take their skills to the next level, as well as high school and college students, recent graduates, and self-taught individuals. In fact, anyone ready to learn the fundamentals behind the Web 2.0 technology known as Ajax will obtain a thorough grounding in all of these core technologies: PHP, MySQL, JavaScript, CSS, and HTML5, and learn the basics of the jQuery library too.     </p>      <h5>         Assumptions This Book Makes     </h5>      <p>         This book assumes that you have a basic understanding of HTML and can at least put together a simple, static website, but does not assume that you have any prior knowledge of PHP, MySQL, JavaScript, CSS, or HTML5â€”although if you do, your progress through the book will be even quicker.     </p>   </div>
   <a href="ShoppingCart.php?addISBN=1491918667">
      <img class="addToCart"  src="/sandvig/mis314/assignments/bookstore/images/add-to-shopping-cart-blue.gif"  alt="Add to cart" title="Add to cart" >
   </a> -->
    <?php
    }
    ?>
</div>
<?php
include('include/footer.php');
?>