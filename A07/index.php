<?php
// page title
$pageTitle = 'Home';

// connect to DB
include('util/databaseconnect.php');

$link = fConnectToDatabase();

// include page sections
include('include/header.php');
include('include/menu.php');

// get three random books from the database
$sql = "SELECT title, ISBN, description
FROM bookdescriptions ORDER BY rand() LIMIT 3;";

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
        // strrpos starts from end of string not beginning
        $desc = substr($row['description'], 0, strrpos($row['description'], " ", 200)) . "<a href='productpage.php?isbn=$ISBN'>more...</a>";
    ?>
        <div class="book-container">
            <a href="productpage.php?isbn=<?php echo $ISBN; ?>" class="book-title">
                <?php echo $title; ?>
            </a>
            <a href="productpage.php?isbn=<?php echo $ISBN; ?>" class="book-title">
                <img src="http://yorktown.cbe.wwu.edu/sandvig/mis314/assignments/bookstore/bookimages/<?php echo $ISBN; ?>.01.THUMBZZZ.jpg" alt="<?php echo $title; ?>">
            </a>
            <?php echo $desc; ?>
        </div>
    <?php
    }
    ?>
</div>
<?php
include('include/footer.php');
?>