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
    $cat_id=$_GET['cat_id'];

    $cat_name="SELECT cat_name from book_categories WHERE id='$cat_id'";
    $cat_name=mysqli_query($conn, $cat_name);

    $cat_name=mysqli_fetch_array($cat_name);
        $books="SELECT * FROM books WHERE cat_id='$cat_id'";
        $books=mysqli_query($conn, $books);

       ?>


            <div class="row">

                <h3 class="text-info">List of books under category <strong><?= $cat_name['cat_name'] ?></strong></h3>

                <?php
                  if (mysqli_num_rows($books)<1) {
                      ?>

                      <div class="alert alert-danger">
                          <strong>
                              <i class="glyphicon glyphicon-remove"></i>
                              Sorry no book record found in this category
                          </strong>
                      </div>
                      <?php
                  }
                  else{
                    while ($book=mysqli_fetch_array($books)){
                ?>
                <div class="col-sm-4 col-md-3">
                    <div class="thumbnail">
                        <img src="<?= $book['cover_photo'] ?>" class="img-responsive">
                        <div class="caption">
                            <h3><?= $book['title'] ?></h3>
                            <p><?= $book['long_description'] ?></p>

                            <P>
                                By <strong><?=$book['author'] ?></strong>
                            </P>
                            <p>
                                Price

                                <strong>
                                <?php
                                    $price="SELECT * FROM prices WHERE book_id=".$book['id']."
                                    and effective=1";
                                    $price=mysqli_query($conn, $price);
                                    $price_result=mysqli_fetch_array($price);

                                    if (mysqli_num_rows($price)>0 && $price_result['price']>0){
                                ?>
                                    <span class="badge"><?=$price_result['price'] ?></span>
                                    <?php }

                                    else {
                                        ?>
                                        <span class="badge">Free</span>
                                        <?php
                                    }
                                    ?>
                                </strong>
                            </p>
                            <p>
                                <?php
                                    if (mysqli_num_rows($price)>0 && $price_result['price']>0) {
                                        ?>
                                        <a href="purchase-request.php?user_id=<?=@$_SESSION['user_id'] ?>&book_price=<?=$price_result['price']?>&book_id=<?= $book['id'] ?>" class="btn btn-info btn-sm">Buy now</a>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <a href="<?= $book['file_path'] ?>" class="btn btn-success btn-sm">Download</a>
                                        <?php
                                    }
                                        ?>
                                <a href="#" class="btn btn-info btn-sm">Detail</a>

                            </p>
                            <p>
                        <?php
                            if (@$_SESSION['user_id']!="" && @$_SESSION['role']=="officer") {
                                ?>
                                        <a href="set-book-price.php?book_id=<?= $book['id'] ?>" class="btn btn-info btn-sm">Set price</a>
                                        <a href="#" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                <?php
                            }
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
        <?php
            }
                }
        ?>
            </div>





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


