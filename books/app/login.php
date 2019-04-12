<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap forms example</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" type="text/css" href="/books/bootstrap/css/bootstrap.min.css">
    <!-- Latest compiled JavaScript -->

</head>

<body>


<div class="container">
    <div class="row">
        <br/><br/><br/><br/><br/>
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3>User Login</h3>
                </div>
                <div class="panel-body">

                    <?php
                        include ("config.php");

                        if (isset($_POST['btn_login'])){
                            $username=$_POST['username'];
                            $password=md5($_POST['password']);

                            $user=mysqli_query($conn,"SELECT * FROM users 
                              WHERE username='$username' and password='$password'");

                            if (mysqli_num_rows($user)>0){
                                 $user=mysqli_fetch_array($user);

                                 $_SESSION['user_id']=$user['id'];
                                 $_SESSION['username']=$user['username'];
                                 $_SESSION['first_name']=$user['fname'];
                                 $_SESSION['last_name']=$user['lname'];

                                 $user_role="SELECT * FROM role_users WHERE user_id=".$user['id'];
                                 $user_role=mysqli_query($conn,$user_role);
                                 $user_role=mysqli_fetch_array($user_role);

                                $role_name="SELECT * FROM roles WHERE id=".$user_role['role_id'];
                                $role_name=mysqli_query($conn,$role_name);
                                $role_name=mysqli_fetch_array($role_name);

                                $_SESSION['role']=$role_name['role'];

                                header("Location:".$ROOT_URL."index.php");
                            }
                            else
                            {
                                ?>
                                <div class="alert alert-danger">Incorrect User Name or password.
                                Please try again.</div>
                    <?php
                            }
                        }


                    ?>

                    <form action="login.php" method="post">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </div>
                            <input type="text" name="username" placeholder="User Name" class="form-control"/>
                        </div>
                            <br/>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-lock"></span>
                            </div>
                            <input type="password" name="password" placeholder="Password" class="form-control"/>
                        </div>

                        <br/>
                        <div class="form-group">
                            <button type="submit" name="btn_login" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <div class="form-group">
                            <a href="#" style="text-align: center">Forget password?</a>
                        </div>
                    </form>
                </div>
            </div>
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

<script src="/books/bootstrap/js/bootstrap.min.js"></script>
<![endif]-->

</body>
</html>
