<?php
/* 
    Class to handle database connection, queries, and results
*/

class dbQueryHandler
{
    // properties
    public $link;
    public $result;

    public function __construct()
    {
        //Create a connection object
        //@ suppresses errors.  
        //parameters: mysqli_connect('my_server', 'my_user', 'my_password', 'my_db');  
        $link = @mysqli_connect('yorktown.cbe.wwu.edu', 'cooperz', 'admin', 'cooperz');

        //handle connection errors
        if (!$link) {
            die('Connection Error: ' . mysqli_connect_error());
        }
    }

    public function getSqlResult($sql){
        return mysqli_query($this->link, $sql) or die('SQL syntax error while retriving items for index: ' . mysqli_error($this->link));
    }

    public function getNumberOfResults($result){
        return mysqli_num_rows($result);
    }
}
