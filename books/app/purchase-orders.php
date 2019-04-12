<?php
session_start();

include ("config.php");
include ("auth.php");
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

<div class="container-fluid">
    <br/><br/><br/><br/>
    <div class="row">

        <?php
          $incoming_purchase_requests="SELECT * FROM purchase_orders";
          $incoming_purchase_requests=mysqli_query($conn, $incoming_purchase_requests);
        ?>

        <div class="alert alert-success">
            <?php echo @$_SESSION['success_msg']; ?>
            <i class="glyphicon glyphicon-ok"></i>
        </div>

        <table class="table">
            <tr>
                <th>Customer Name</th>
                <th>Book Title</th>
                <th>Book Price</th>
                <th>Payment Copy</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

            <?php
               while ($order=mysqli_fetch_array($incoming_purchase_requests)){

                   $book_info="SELECT title FROM books WHERE id=".$order['book_id'];
                   $book_info=mysqli_query($conn, $book_info);
                   $book_info=mysqli_fetch_array($book_info);

                   $user_info="SELECT fname, lname FROM users WHERE id=".$order['user_id'];
                   $user_info=mysqli_query($conn,$user_info);
                   $user_info=mysqli_fetch_array($user_info);


                   ?>
                   <tr>
                       <td><?=$user_info['fname']." ".$user_info['lname'];?></td>
                       <td><?=$book_info['title'];?></td>
                       <td><?=$order['book_price'];?></td>
                       <td><a href="<?=$order['payment_copy'];?>"><?=$order['payment_copy'];?>"</a></td>

                       <?php
                        if ($order['status']==0){

                       ?>
                       <td><div class="label label-warning">Waiting for approval</div></td>
                       <?php
                        }
                        else if ($order['status']==1){
                            ?>
                        <td><div class="label label-success">Approved</div></td>
                       <?php
                        }
                        else{
                            ?>
                        <td><div class="label label-danger">Request is rejected</div></td>
                       <?php
                        }
                        $order_id=$order['id'];
                       ?>
                       <td>
                           <a href="#" class="btn btn-primary btn-sm">
                               <i class="glyphicon glyphicon-eye-open"></i>
                               Detail</a>
                           <a href="#" onclick="approveRequest(<?=$order_id ?>)" class="btn btn-success btn-sm">
                               <i class="glyphicon glyphicon-ok"></i>
                               Aprove</a>
                           <a href="#" onclick="rejectRequest(<?=$order_id ?>)" class="btn btn-danger btn-sm">
                               <i class="glyphicon glyphicon-remove"></i>
                               Reject</a>
                       </td>
                   </tr>
            <?php
               }
            ?>
        </table>

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

<script>
    function approveRequest(order_id) {
       var approve=confirm("Are you sure you want to approve this order?");

        if(approve){
           window.location="http://localhost/books/app/approve-purchase-request.php?order_id="+order_id;
        }
    }

    function rejectRequest(order_id) {
        var reject=confirm("Are you sure you want to reject this order?");
        if (reject){
            window.location="http://localhost/books/app/reject-purchase-request.php?order_id="+order_id;
        }
    }
</script>


</body>
</html>

