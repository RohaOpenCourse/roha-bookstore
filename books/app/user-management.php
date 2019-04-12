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
                         <h4>Manage Users</h4>
                     </div>
                     <div class="panel-body">
                         <ul>
                             <li><a href="create_new_user.php">New User</a></li>
                             <li><a href="#">Change roles</a></li>
                             <li><a href="#">Activate / Deactivate user</a></li>
                         </ul>
                     </div>
                 </div>
             </div>
             <div class="col-md-9">
                 <?php
                    $users="SELECT * FROM users";
                    $users=mysqli_query($conn,$users);

                    $records=mysqli_num_rows($users);

                    echo $records." records found.";

                    ?>

                 <?php
                  if (@$_GET['success']){

                 ?>

                 <h4 class="alert alert-success">
                     <i class="glyphicon glyphicon-ok"></i>
                     <?php echo @$_GET['success'] ?>
                 </h4>

                 <?php
                  }
                 ?>
                 <table class="table table-bordered table-striped table-condensed table-reposnsive small">
                     <tr>
                         <th>User Name</th>
                         <th>Full Name</th>
                         <th>Email Address</th>
                         <th>User Group</th>
                         <th>Photo</th>
                         <th>Actions</th>
                         <th>Location status</th>
                     </tr>

                 <?php

                    while ($user=mysqli_fetch_array($users)){
                        ?>
                        <tr>
                            <td><?php echo $user['username'] ?></td>
                            <td><?php echo $user['fname']." ".$user['lname'] ?></td>
                            <td><?php echo $user['email'] ?></td>

                            <?php
                               $role_id="SELECT * FROM role_users WHERE user_id=".$user['id'];
                                  $role_id=mysqli_query($conn,$role_id);
                                  $role_id=mysqli_fetch_array($role_id);
                                  $role_id=$role_id['role_id'];

                            /**
                             * find role name / group form roles table
                             */

                            $rolename="SELECT * FROM roles WHERE id='$role_id'";
                            $rolename=mysqli_query($conn, $rolename);
                            $rolename=mysqli_fetch_array($rolename);
                            $rolename=$rolename['role_name'];
                            ?>
                            <td><?php echo $rolename ?></td>
                            <td>
                                <a href="<?php echo $user['profile_pic'] ?>">
                                    <img src="<?php echo $user['profile_pic'] ?>" height="100px" width="100px" class="img-responsive img-circle"/>
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo $ROOT_URL.'detail-user-info.php?user_id='.base64_encode($user['id']); ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-eye-open"></span></a>
                                <a href="#" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
                                <a href="#" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span></a>
                            </td>
                            <td>
                                <?php
                                  $user_locations="SELECT * FROM user_locations WHERE user_id=".$user['id'];
                                  $user_locations=mysqli_query($conn,$user_locations);
                                  if (mysqli_num_rows($user_locations)>0) {
                                      ?>
                                      <i class="glyphicon glyphicon-ok text-success"></i>
                                      <?php
                                  }
                                  else{
                                ?>
<!--                                http://localhost/books/app/user-locations.php-->
                                <a href="<?php echo $ROOT_URL.'user-locations.php?user_id='.base64_encode($user['id']);?>">Complete Location Info</a>
                                <?php
                                  }
                                ?>
                            </td>
                        </tr>
                 <?php
                    }
                 ?>
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

