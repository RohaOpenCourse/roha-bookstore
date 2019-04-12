<?php
include ("config.php");
$reject_order="UPDATE purchase_orders set status=2 
                WHERE id=".$_GET['order_id'];
$reject_order=mysqli_query($conn, $reject_order);

if ($reject_order){
    $_SESSION['success_msg']="Order rejected successfully.";
    header("Location: ".$ROOT_URL."purchase-orders.php");
}