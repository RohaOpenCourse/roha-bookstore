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
        ?>
        <div class="row">
            <div class="col-md-6 col-lg-offset-4">
                <br/><br/><br/>
                <form action="purchase-request.php" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="book_id" value="<?=@$_GET['book_id'];?>"/>
                    <input type="hidden" name="book_price" value="<?=@$_GET['book_price'];?>"/>
                    <input type="hidden" name="user_id" value="<?=@$_GET['user_id']; ?>"/>

                    <div class="form-group">
                        <label>Attach the bank payment copy</label>
                        <input type="file" name="payment_copy" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="btn_send_request" class="btn btn-success btn-block">Send purchase Request
                            <i class="glyphicon glyphicon-arrow-right"></i>
                        </button>
                    </div>
                </form>

                <?php
                    if (isset($_POST['btn_send_request'])){
                        $book_id=$_POST['book_id'];
                        $book_price=$_POST['book_price'];
                        $user_id=$_POST['user_id'];
                        $status=0;



                        $payment_copy=$_FILES['payment_copy']['name'];
                        $payment_copy_temp=$_FILES['payment_copy']['tmp_name'];
                        $payment_copy_target="payments/".$_FILES['payment_copy']['name'];


                        if (!file_exists('payments')){
                            mkdir('payments');
                        }

                        if (copy($payment_copy_temp,$payment_copy_target)){
                            echo "Payment receipt copy has been uploaded sent successfully.";
                        }
                        else{
                            echo "<font color='red'>Something went wrong. ".mysqli_error($conn)."</font>";
                        }

                        $create_request_info="INSERT INTO purchase_orders(user_id,book_id,book_price,
                                      payment_copy,status,created_at, updated_at) VALUES ('$user_id','$book_id','$book_price','$payment_copy_target','$status',now(),now())";
                        $create_request_info=mysqli_query($conn,$create_request_info);

                        if ($create_request_info){
                            echo "Purchase reuest has been sent successfully.";
                        }
                        else{
                            echo "<font color='red'>Something went wrong in sending purchasing request.".mysqli_error($conn)."</font>";
                        }
                    }
                ?>
            </div>
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


