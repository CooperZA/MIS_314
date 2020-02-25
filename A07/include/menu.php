<?php
    //List records
    $sql = "SELECT DISTINCT bc.CategoryID AS catID, bc.CategoryName AS catName, Count(*) AS numProducts FROM bookcategories bc JOIN  bookcategoriesbooks bcb ON bcb.CategoryID = bc.CategoryID GROUP BY catName ASC;";

    $result = mysqli_query($link, $sql) or die('SQL syntax error in menu.php: ' . mysqli_error($link));
?>
<div class="col-md-3">
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
                        echo "<li><a href='searchbrowse.php?catID=$catID&catName=$catName'>$catName</a> ($row[numProducts])</li>\n";
                    }
                ?>
                
            </ul>
        </nav>
    </div>
</div>