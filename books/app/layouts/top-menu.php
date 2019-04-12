<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <!-- The mobile navbar-toggle button can be safely removed since you do not need it in a non-responsive implementation -->
            <a class="navbar-brand" href="#"><b><span class="text-primary">Roha Bookstore</span></b></a>
        </div>
        <!-- Note that the .navbar-collapse and .collapse classes have been removed from the #navbar -->
        <div id="navbar">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="all-books.php">Books</a></li>
                <li><a href="book-categories.php">Book Categories</a></li>

                <?php
                  if (isset($_SESSION['user_id'])){
                      if ($_SESSION['role']=='admin') {
                          ?>
                          <li><a href="user-management.php">User Management</a></li>
                          <?php
                      }

                      if ($_SESSION['role']=='officer'){
                         ?>
                          <li><a href="newbook.php">New book entry</a></li>
                          <li><a href="setup-pricing.php">Setup pricing</a></li>
                          <li><a href="purchase-orders.php">Purchase Orders </a></li>
                          <li><a href="sales.php">Sales</a></li>
                          <?php
                      }
                      if ($_SESSION['role']=='manager'){
                        ?>
                          <li><a href="reports.php">General Reports</a></li>
                          <?php
                      }
                      if ($_SESSION['role']=='customer'){

                      }

                      ?>
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                             aria-haspopup="true" aria-expanded="false">
                              <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?>
                              <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                              <li><a href="userprofile.php">Profile</a></li>
                              <li><a href="account-settings.php">Account Settings</a></li>
                              <li><a href="logout.php">Logout</a></li>
                          </ul>
                      </li>
                      <?php

                  }
                  else{
                      ?>
                      <li><a href="login.php">Login</a></li>
                      <li><a href="signup.php">Sign Up</a></li>
                <?php
                  }
                ?>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>