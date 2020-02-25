<?php
// connect to DB
include('util/databaseconnect.php');

$link = fConnectToDatabase();

// get search query or catID and catName
$search = fcleanString($link, $_GET['search'], 50); 
$catID = fcleanNumber($_GET['catID']); 
$catName = fcleanString($link, $_GET['catName'], 50); 

// if block for search query (add page header message)
if(isset($search)){
    $sql = "SELECT title, ISBN, description,";
}

// id block for category query (add page header message)
if(isset($catID) && isset($catName)){
    $sql = "SELECT title, ISBN, description,
    FROM bookdescriptions;";

}

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
        $author = $row['author'];
        $desc = substr($row['description'], 0, 200) . "<a href='productpage.php?isbn=$ISBN'>more...</a>";
    ?>
        <div class="book-container">
            <a href="productpage.php?isbn=<?php echo $ISBN; ?>" class="book-title">
                <?php echo $title; ?>
            </a>
            <br>
            <span>
                by <a href="searchbrowse.php?search=<?php echo $author; ?>"><?php echo $author; ?></a>
            </span>
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