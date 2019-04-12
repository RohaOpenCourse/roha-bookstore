<?php
include ("config.php");
$approve_order="UPDATE purchase_orders set status=1 
                WHERE id=".$_GET['order_id'];
$approve_order=mysqli_query($conn, $approve_order);

if ($approve_order){
    $_SESSION['success_msg']="Order approved successfully.";
    header("Location: ".$ROOT_URL."purchase-orders.php");
}