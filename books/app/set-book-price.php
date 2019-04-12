<?php
session_start();
include ("layouts/top-menu.php");
include ("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home | Roha Bookstore</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" type="text/css" href="/books/bootstrap/css/bootstrap.min.css">
    <![endif]-->
</head>

<body>

<div class="container">
    <br/><br/><br/>
    <?php
    if (@$_SESSION['user_id']!="" && @$_SESSION['role']=="officer") {
        ?>
        <div class="row">
            <div class="col-md-6 col-lg-offset-4">
                <h3 class="text-info">Set book price</h3>

                <?php
                  $book="SELECT * FROM books WHERE id=".$_GET['book_id'];
                  $book=mysqli_query($conn, $book);

                  $book=mysqli_fetch_array($book);
                ?>

                <p>Title: <strong><?= $book['title'] ?></strong></p>
                <p>Description: <strong><?= $book['long_description'] ?></strong></p>
                <p>Author: <strong><?= $book['author'] ?></strong></p>

                <form action="set-book-price.php?book_id=<?= $book['id'] ?>" method="post">

                   <div class="form-group">
                       <label>Book ID</label>
                       <input type="hidden" name="book_id" value="<?= $book['id'] ?>" class="form-control"/>
                   </div>

                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="price" class="form-control" />
                    </div>



                    <div class="form-group">
                        <button type="submit" name="btn_create" class="btn btn-primary btn-block">Set price
                        </button>
                    </div>
                </form>

                <?php
                    if (isset($_POST['btn_create'])){

                        $prices="SELECT * FROM prices WHERE book_id=".$book['id'];
                        $prices=mysqli_query($conn, $prices);

                        if (mysqli_num_rows($prices)>0){
                            $update_price="UPDATE prices SET effective=0 WHERE book_id=".$book['id'];
                            mysqli_query($conn, $update_price);
                        }
                        @$book_id=$_POST['book_id'];
                        @$book_price=$_POST['price'];
                        $effective=1;

                        $create_price="INSERT INTO prices (book_id,price,effective, created_at, updated_at)
                            VALUES('$book_id','$book_price','$effective',now(),now())";

                        $create_price=mysqli_query($conn, $create_price);

                        if ($create_price){
                            echo "Price has been set successfully";
                        }
                        else{
                            echo "Error".mysqli_error($conn);
                        }
                    }
                ?>
            </div>
        </div>
        <?php
    }
    ?>

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!-- jQuery library -->
<!--    <script src="/bookstore3/bootstrap/js/jquery3.3.1.min.js"></script>-->

<!--    jQuery CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="/books/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>


