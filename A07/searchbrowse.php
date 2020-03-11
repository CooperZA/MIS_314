<?php
//set page title
$pageTitle = 'Search Browse';

// connect to DB
include('util/databaseconnect.php');
include('util/dbQueryHandler.php');

$link = fConnectToDatabase();

// include page settings
include('include/header.php');
include('include/menu.php');

// get search query or catID and catName
$search = mysqli_real_escape_string($link, fcleanString($link, $_GET['search'], 50)); 
$catID = fcleanNumber($_GET['catID']); 
$catName = fcleanString($link, $_GET['catName'], 50);

// if block for search query (add page header message)
if(!empty($search)){
    $sql = "SELECT bd.title, bd.ISBN, bd.description, ba.nameF, ba.nameL 
    FROM bookdescriptions bd 
    JOIN bookauthorsbooks bab ON bd.ISBN = bab.ISBN 
    JOIN bookauthors ba ON bab.AuthorID = ba.AuthorID
    JOIN bookcategoriesbooks bcb ON bd.ISBN = bcb.ISBN 
    JOIN bookcategories bc ON bcb.CategoryID = bc.CategoryID
    WHERE (CategoryName = '$search'
    OR title LIKE '%$search%'
    OR description LIKE '%$search%'
    OR publisher LIKE '%$search%'
    OR concat_ws(' ', nameF, nameL, nameF) LIKE '%$search%' )
    GROUP BY title
    ORDER BY title;";

}

// id block for category query (add page header message)
if(!empty($catID) && !empty($catName)){
    $sql = "SELECT bd.title, bd.ISBN, bd.description, Concat(ba.nameF, ' ', ba.nameL) as authorName 
    FROM bookdescriptions bd 
    JOIN bookcategoriesbooks bcb ON bd.ISBN = bcb.ISBN 
    JOIN bookcategories bc ON bcb.CategoryID = bc.CategoryID
    JOIN bookauthorsbooks bab ON bd.ISBN = bab.ISBN 
    JOIN bookauthors ba ON bab.AuthorID = ba.AuthorID
    WHERE bc.CategoryID = $catID AND bc.CategoryName = '$catName'
    GROUP BY bd.title;";

}

$result = mysqli_query($link, $sql) or die('SQL syntax error while retriving items for search browse: ' . mysqli_error($link));

// print_r(mysqli_fetch_array($result));

?>
<div class="col-md-9">
    <?php
    // echo number of results from search
    if(!empty($search)){
        echo "<p class='text-center'>" . mysqli_num_rows($result) . " books contain <font color='#CC0000'>'" . $search . "'</font></p>";
    }else if(!empty($catID) && !empty($catName)){
        echo "<p class='text-center'>" . mysqli_num_rows($result) . " books in <font color='#CC0000'>'" . $catName . "'</font> category</p>";
    }else{
        echo "<p class='text-center'>No Records Found</p>";
    }

    while ($row = mysqli_fetch_array($result)) {
        // retreive values from row array
        $ISBN = $row['ISBN'];
        $title = $row['title'];
        $desc = substr($row['description'], 0, strrpos(substr($row['description'], 0, 200), " ")) . "<a href='productpage.php?isbn=$ISBN'> more...</a>";
    ?>
        <div class="book-container">
            <a href="productpage.php?isbn=<?php echo $ISBN; ?>" class="book-title">
                <?php echo $title; ?>
            </a>
            <br>
            <span>
                by <?php echo fListAuthors($link, $ISBN) ?>
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