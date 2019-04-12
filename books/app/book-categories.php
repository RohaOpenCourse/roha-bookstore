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
                <h3 class="text-info">Add New Book Category</h3>
                <form action="book-categories.php" method="post">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat_name" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Category Description</label>
                        <textarea name="cat_description" rows="5" cols="40" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="btn_create" class="btn btn-primary btn-block">Create Category
                        </button>
                    </div>
                </form>

                <?php
                @$book_cat = $_POST['cat_name'];
                @$book_description = $_POST['cat_description'];

                if (isset($_POST['btn_create'])) {
                    $create_cat = "INSERT INTO book_categories (cat_name, cat_description, created_at, updated_at)
                                        VALUES ('$book_cat','$book_description',now(),now())";
                    $create_cat = mysqli_query($conn, $create_cat);
                    if ($create_cat) {
                        ?>

                        <div class="alert alert-success">
                            <i class="glyphicon glyphicon-ok"></i>
                            Book category has been created successfully
                        </div>
                        <?php
                    } else {
                        ?>

                        <div class="alert alert-danger">
                            <i class="glyphicon glyphicon-remove"></i>
                            Something went wrong. <?php echo mysqli_error($conn) ?>;
                        </div>
                        <?php

                    }
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>

    <div class="row">
        <?php
          @$categories="SELECT * FROM book_categories";
          @$categories=mysqli_query($conn, $categories);

          while ($category=mysqli_fetch_array($categories)){
        ?>
        <div class="col-sm-4 col-md-3">
            <div class="thumbnail">
                <img src="images/No-Photo-Available.jpg" class="img-responsive">
                <div class="caption">
                    <h3><?php echo $category['cat_name'] ?></h3>
                    <p><?php echo $category['cat_description'] ?></p>
                    <p>
                        <a href="show-books.php?cat_id=<?= $category['id'] ?>" class="btn btn-primary btn-sm" role="button">View books</a>
                        <?php
                        if (@$_SESSION['user_id']!="" && @$_SESSION['role']=="officer") {
                        ?>
                        <a href="#" class="btn btn-info btn-sm" role="button">Edit</a></p>
                        <a href="#" class="btn btn-danger btn-sm" role="button">Delete</a></p>
                    <?php } ?>
                </div>
            </div>
        </div>

        <?php
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


