<?php
$pageTitle = 'About';
// connect to DB
include('util/databaseconnect.php');

$link = fConnectToDatabase();

include('include/header.php');
include('include/menu.php');
?>
<div class="col-md-9">
    <h2 class="page-title">Site Features</h2>
    <ul>
        <li>Site created by Zach Cooper as a class project for <a href="http://yorktown.cbe.wwu.edu/sandvig/mis314/">MIS
                314</a> at Western Washington University. </li>
        <li>All product information is dynamically generated using PHP and mySQL.</li>
        <li>Product, customer and order information is stored in a mySQL database.</li>
        <li>Include files are used for all code that is used more
            than once (i.e. search/browse menu, ListAuthor function,
            header and footer). </li>
        <li><span class="sub-head">mySQL Database</span>
            <ul>
                <li>Normalized to 3rd normal form (or greater). Tables include:
                    <ul>
                        <li>book details </li>
                        <li>book categories</li>
                        <li>relationship details-books (many-to-many) </li>
                        <li>authors</li>
                        <li>relationship authors-books (many-to-many) </li>
                        <li>customers</li>
                        <li>orders</li>
                        <li>order items (one-to-many) </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><h3 class="sub-head">Home page</h3>
            <ul>
                <li>Selects three random items from from the
                    database using a SQL statement.</li>
                <li>Generates the browse menu dynamically from the database using a SQL query that shows
                    only the book categories that currently contain books.</li>
                <li>Truncates book descriptions at 250 characters.</li>
            </ul>
        </li>
        <li><h3 class="sub-head">Search page</h3>
            <ul>
                <li>Cleans user entered data to protect against SQL Injection attacks and cross-site scripting. </li>
                <li>Searches book title, description, author and
                    category fields in the database.</li>
                <li>The mysql_num_rows() function is used
                    to count the number of books found by the search.</li>
                <li>Responds gracefully to searches that return no matches.</li>
            </ul>
        </li>
        <li><h3 class="sub-head">Shopping cart page</h3>
            <ul>
                <li>Uses a cookie to store the ISBNs of items in the
                    cart.</li>
            </ul>
        </li>
        <li><h3 class="sub-head">Checkout pages</h3>
            <ul>
                <li>Searches the database for email addresses of existing
                    customer accounts and writes their shipping information in
                    the form on the order confirmation page.</li>
                <li>Customer ID is encrypted using Rijndael encryption algorithm
                </li>
            </ul>
        </li>
        <li><h3 class="sub-head">Order Confirmation Page</h3>
            <ul>
                <li>Checks for shopping cart and prompts user if cart is
                    empty.</li>
                <li>All fields are checked to make sure that they contain
                    information.</li>
                <li>Checks email address in database and prompts user to try
                    again user if address not found.</li>
                <li>Modifications made to customer information are updated in
                    the database.</li>
                <li>Order information are written to the database.</li>
                <li>An email is sent to the customer with the order
                    information.</li>
                <li>The shopping cart is emptied by setting ItemCount to zero in the ShoppingCart cookie.</li>
            </ul>
        </li>
        <li><h3 class="sub-head">Order History Page</h3>
            <ul>
                <li>Searches the database for all orders associated with
                    e-mail address</li>
                <li>If no matching email address is found user is prompted to
                    try again.</li>
            </ul>
        </li>
        <li><h3 class="sub-head">Enhancements</b></h3>
            <ul>
                <li>When a search or browse returns only one item, display the productpage.php rather than the searchbrowse.php page.</li>
                <li>Added lightbox for images on the product page using the lightbox2 javascript library, downloaded using npm.</li>
                <li>Home page and serachbrowse descriptions truncated at the space nearest to 200 characters from the beginning of the description.</li>
                <li>Categories in menu display the number of items in the category. Achieved through sql SELECT statement.</li>
                <li>Site optimized for mobile. Using Bootstrap CSS Framework.</li>
            </ul>
        </li>
        <li>
            <h5>Thanks to Amazon.com for the use of its
            icons, book images and book descriptions.</h5>
        </li>
    </ul>
</div>
<?php
include('include/footer.php');
?>