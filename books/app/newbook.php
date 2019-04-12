<?php
session_start();
if (isset($_SESSION)){
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>New book | Roha bookstore</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" type="text/css" href="/books/bootstrap/css/bootstrap.min.css">
        <![endif]-->
    </head>

    <body>

    <!-- Fixed navbar (top menu) -->
    <?php
    include("layouts/top-menu.php");
    include ("config.php");
    ?>

    <br/>
    <div class="container">
        <div class="row">
            <br/><br/><br/>
            <h3 class="text-primary">Enter new book information</h3>

            <form action="newbook.php" method="post" enctype="multipart/form-data">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Book category</label>
                        <select name="cat_id" class="form-control">
                            <option value="">Select book category</option>
                            <?php
                                $book_cats=mysqli_query($conn, "SELECT * from book_categories");
                                while ($book_cat=mysqli_fetch_array($book_cats)){
                                    ?>
                                 <option value="<?= $book_cat['id'] ?>"><?=$book_cat['cat_name'] ?></option>
                                <?php
                                }
                                ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>ISBN Number</label>
                        <input type="text" name="isbn" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Book title</label>
                        <input type="text" name="book_title" class="form-control"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Author</label>
                        <input type="text" name="book_author" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Publishing Company</label>
                        <input type="text" name="publisher" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Publishing Country</label>
                        <input type="text" name="pub_country" class="form-control"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date / Year</label>
                        <input type="date" name="pub_date" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea rows="3" name="description" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Upload book</label>
                        <input type="file" name="book_name" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Upload cover photo</label>
                        <input type="file" name="cover_photo" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="btn_create_book">
                            <span class="glyphicon glyphicon-floppy-save"></span>
                            Save</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </div>
                </div>
            </form>
        </div>

        <?php
            if (isset($_POST['btn_create_book'])) {
                $cat_id = @$_POST['cat_id'];
                $isbn = $_POST['isbn'];
                $book_title = $_POST['book_title'];
                $book_author = $_POST['book_author'];
                $publisher = $_POST['publisher'];
                $country = $_POST['pub_country'];
                $date = $_POST['pub_date'];
                $description = $_POST['description'];

                $book_file = $_FILES['book_name']['name'];
                $book_file_tmp_name = $_FILES['book_name']['tmp_name'];
                $book_target = "uploads/" . $_FILES['book_name']['name'];

                $cover_file = $_FILES['cover_photo']['name'];
                $cover_tmp_name = $_FILES['cover_photo']['tmp_name'];
                $cover_target = "uploads/" . $_FILES['cover_photo']['name'];

                if (!file_exists('uploads')) {
                    mkdir("uploads");
                }

                if (copy($book_file_tmp_name, $book_target)) {
                    ?>

                    <div class="alert alert-success"><strong>
                            <i class="glyphicon glyphicon-ok"></i>
                            Book file uploaded successfully
                        </strong>
                    </div>
                    <?php
                }

                if (copy($cover_tmp_name, $cover_target)) {
                    ?>
                    <div class="alert alert-success"><strong>
                            <i class="glyphicon glyphicon-ok"></i>
                            Book's cover photo uploaded successfully
                        </strong>
                    </div>
                    <?php
                }


                $create_book = "INSERT INTO books (cat_id, isbn,title,author, publisher,publish_country,publish_date,file_path,cover_photo,long_description,created_at, updated_at)
                      VALUEs  ('$cat_id','$isbn','$book_title','$book_author','$publisher','$country','$date','$book_target','$cover_target','$description',now(),now())";

                $create_book = mysqli_query($conn, $create_book);

                if ($create_book) {
                    ?>

                    <div class="alert alert-success">
                        <strong>
                            <i class="glyphicon glyphicon-ok"></i>
                            New book has been created successfully
                        </strong>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-danger">
                        <strong>
                            <i class="glyphicon glyphicon-remove"></i>
                            Something went wrong in creating new book record. <?php echo mysqli_errno($conn) ?>
                        </strong>
                    </div>
                    <?php
                }
            }
        ?>

        <div class="row">
            <a href="<?php echo $ROOT_URL.'index.php'?>" class="btn btn-success pull-right">
                <span class="glyphicon glyphicon-backward"></span>
                Back</a>
        </div>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <!-- jQuery library -->
    <script src="/books/bootstrap/js/jquery3.3.1.min.js"></script>

    <!--    jQuery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="/books/bootstrap/js/bootstrap.min.js"></script>

    </body>
    </html>

    <?php
}
?>
