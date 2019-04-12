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
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>User Photo</h4>
                </div>
                <div class="panel-body">
                    <?php
                      $user_id=base64_decode($_GET['user_id']);

                      $user="SELECT * FROM users WHERE id='$user_id'";
                      $user=mysqli_query($conn,$user);
                      $user=mysqli_fetch_array($user)
                    ?>

                    <img src="<?php echo $user['profile_pic'] ?>" width="300px" height="300px" class="img-responsive img-thumbnail"/>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <table class="table table-bordered table-striped table-condensed table-reposnsive">
                <tr>
                    <td>FUll Name </td><td><?php echo $user['fname']." ".$user['lname'] ?></td>
                </tr>
                <tr>
                    <td>ID Number </td><td><?php echo $user['id'] ?></td>
                </tr>
                <tr>
                    <td>User Name </td><td><?php echo $user['username'] ?></td>
                </tr>
                <tr>
                    <td>Email Address </td><td><?php echo $user['email'] ?></td>
                </tr>
                <tr>
                    <td>Mobile </td><td><?php echo $user['mobile'] ?></td>
                </tr>
            </table>


            <h3 class="text-info"><?php echo $user['fname'] ?>'s Physical Address</h3>

            <?php
              $user_location=mysqli_query($conn, "SELECT * FROM user_locations WHERE user_id=".$user['id']);
              $user_location=mysqli_fetch_array($user_location);
            ?>

            <table class="table table-bordered table-striped table-condensed table-reposnsive">
                <tr>
                    <td>Country </td><td><?php echo $user_location['loc_country'] ?></td>
                </tr>
                <tr>
                    <td>Region </td><td><?php echo $user_location['loc_region'] ?></td>
                </tr>
                <tr>
                    <td>Zone </td><td><?php echo $user_location['loc_zone'] ?></td>
                </tr>
                <tr>
                    <td>City </td><td><?php echo $user_location['loc_city'] ?></td>
                </tr>
                <tr>
                    <td>Sub City </td><td><?php echo $user_location['loc_subcity'] ?></td>
                </tr>
            </table>
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

