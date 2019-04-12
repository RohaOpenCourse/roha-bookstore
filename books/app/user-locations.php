<?php
session_start();
include ("config.php");
include ("auth.php");
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>Bootstrap forms example</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" type="text/css" href="/books/bootstrap/css/bootstrap.min.css">
        <![endif]-->
    </head>

    <body>

    <!-- Fixed navbar (top menu) -->
    <?php
    include("layouts/top-menu.php");

    ?>


    <?php
//       Retrieve user info based the user id passed from the prev page

    $user_id=base64_decode($_GET['user_id']);


    @$user="SELECT * FROM users WHERE id='$user_id'";
    @$user=mysqli_query($conn,$user);
    @$user=mysqli_fetch_array($user);
    ?>

    <br/>
    <div class="container">
        <br/><br/><br/><br/>
        <div class="row">


            <h3 class="text-info">Complete location info for <?php echo $user['fname']. " ".$user['lname'] ?></h3>

            <form action="user-locations.php" method="post">
                <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id ?>"/>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Country</label>
                        <input type="text" name="country" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Region</label>
                        <input type="text" name="region" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Zone</label>
                        <input type="text" name="zone" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" class="form-control"/>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Sub city</label>
                        <input type="text" name="subcity" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Kebele</label>
                        <input type="text" name="kebele" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>House N<u>o.</u></label>
                        <input type="text" name="house_no" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="btn_location">Okay go it</button>
                        <button type="reset" class="btn btn-danger">Cancel</button>
                    </div>
                </div>
            </form>
        </div>

        <?php
        if (isset($_POST['btn_location'])) {
            $user_ID=$_POST['user_id'];
            $country=$_POST['country'];
            $region=$_POST['region'];
            $zone=$_POST['zone'];
            $city=$_POST['city'];
            $subcity=$_POST['subcity'];
            $kebele=$_POST['kebele'];
            $house_no=$_POST['house_no'];
            $create_location="INSERT INTO user_locations(user_id,loc_country,loc_region,loc_zone, 
            loc_city,loc_subcity,loc_kebele,loc_house_no,created_at,updated_at) 
            VALUES ('$user_ID','$country','$region','$zone','$city','$subcity','$kebele',
            '$house_no',now(),now())";
            $create_location=mysqli_query($conn,$create_location);
            if ($create_location){
                ?>
                <div class="alert alert-success">
                    <span class="glyphicon glyphicon-ok"></span>
                    <b>Congrats! You have completed your profile info</b>
                </div>
                <a href="user-management.php" class="btn btn-info btn-sm">Back</a>
                <?php
            }
            else{
                die("Something went wrong in creating location info. ".mysqli_error($conn));
            }
        }
        ?>

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
