<?php
  session_start();
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

    <?php
        include ("layouts/top-menu.php");
        include ("config.php");
    ?>

    <div class="container">
        <div class="page-header"></div>
        <br/><br/><br/>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form action="index.php" method="post">
                    <div class="input-group">
                        <input type="text" name="book_att" class="form-control"
                               placeholder="Search by ISBN, title, author, company or country"/>
                        <span class="input-group-btn">
                            <button type="submit" name="btn_search" class="btn btn-info">
                              <span class="glyphicon glyphicon-search"></span> Go
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <br/><br/><br/>

        <?php
         if (isset($_POST['btn_search'])){
            $book_att=$_POST['book_att'];

            @$book_info="SELECT * FROM books WHERE isbn like '%$book_att%' OR title like '%$book_att%'
                      OR publish_country like '%$book_att%' OR publisher  like '%$book_att%' OR author like '%$book_att%'";
            @$book_info=mysqli_query($conn, $book_info);

            ?>

            <div class="row">

                <?php
                if (mysqli_num_rows(@$book_info)<1) {
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
                    while ($book=mysqli_fetch_array(@$book_info)){
                        ?>
                        <div class="col-sm-4 col-md-3">
                            <div class="thumbnail">
                                <img src="<?= @$book['cover_photo'] ?>" class="img-responsive">
                                <div class="caption">
                                    <h3><?= @$book['title'] ?></h3>
                                    <p><?= @$book['long_description'] ?></p>

                                    <P>
                                        By <strong><?=@$book['author'] ?></strong>
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

        <?php
         }
         else{
        ?>
    <div class="row">
        <?php
        @$categories = "SELECT * FROM book_categories";
        @$categories = mysqli_query($conn, $categories);

        while ($category = mysqli_fetch_array($categories)) {
            ?>
            <div class="col-sm-4 col-md-3">
                <div class="thumbnail">
                    <img src="images/No-Photo-Available.jpg" class="img-responsive">
                    <div class="caption">
                        <h3><?php echo $category['cat_name'] ?></h3>
                        <p><?php echo $category['cat_description'] ?></p>
                        <p>
                            <a href="show-books.php?cat_id=<?= $category['id'] ?>" class="btn btn-primary btn-sm"
                               role="button">View books</a>
                            <?php
                            if (@$_SESSION['user_id'] != "" && @$_SESSION['role'] == "officer") {
                            ?>
                            <a href="#" class="btn btn-info btn-sm" role="button">Edit</a></p>
                        <a href="#" class="btn btn-danger btn-sm" role="button">Delete</a></p>
                        <?php } ?>
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


