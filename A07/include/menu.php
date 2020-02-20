<?php
    //List records
    $sql = "SELECT DISTINCT CategoryID AS catID, CategoryName AS catName
                FROM bookcategories  ORDER BY catName ASC";

    $result = mysqli_query($link, $sql) or die('SQL syntax error in menu.php: ' . mysqli_error($link));
?>

<div class="menu">
    <div class="menu-search">
        <div class="menu-head">Search</div>
        <div class="menu-container">
            <form action="">
                <input type="text" name="search" autofocus>
                <input class="btn" type="submit" value="Search">
            </form>
        </div>
    </div>
    <nav>
        <div class="menu-head">Browse</div>
        <ul>
            <!-- while loop -->
            <?php
                while($row = mysqli_fetch_array($result)){
                    // echo out each category
                    $catID = $row['catID'];
                    $catName = $row['catName'];
                    echo "<li><a href='index.php?catID=$catID&catName=$catName'>$catName</a></li>";
                }
            ?>
            
        </ul>
    </nav>
</div>