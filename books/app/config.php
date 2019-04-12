<?php
    $conn=mysqli_connect("localhost","root","") or die("Could not connect to server.");
    mysqli_select_db($conn,"bookstore") or die("Could not contact our database.");

    $ROOT_URL="http://localhost/books/app/";

?>