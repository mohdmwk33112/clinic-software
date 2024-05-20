<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('includes/head.php'); ?>
</head>

<body>
    <div class="wrapper wrapper-full-page">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute">
            <div class="container">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="#pablo">HopeView</a>
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a href="login.php" class="nav-link">
                                <i class="nc-icon nc-mobile"></i> Login
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="full-page section-image" data-color="black" data-image="assets/img/full-screen-image-2.jpg">
            <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
            <div class="content">
                <div class="container">
                    <div class="col-md-4 col-sm-6 ml-auto mr-auto">
                        <form class="form" method="post" action="login.php">
                            <div class="card card-login card-hidden">
                                <div class="card-header">
                                    <h3 class="header text-center">Login</h3>
                                </div>
                                <div class="card-body">
                                    <?php
                                    require "classes.php";
                                    require "config.php";
                                    if (isset($_POST["login"])) {
                                        $username = $_POST["username"];
                                        $password = $_POST["password"];
                                        $user1 = new user($username, $password, $link);
                                        echo $user1->login();
                                    }
                                    ?>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" placeholder="Enter Username" class="form-control" name="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" placeholder="Password" class="form-control" name="password" required>
                                    </div>
                                </div>
                                <div class="card-footer ml-auto mr-auto">
                                    <button type="submit" class="btn btn-primary btn-wd" name="login">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include('includes/footer.php'); ?>
    </div>
</body>

<?php include('includes/scripts.php'); ?>
<script>
    $(document).ready(function () {
        demo.checkFullPageBackgroundImage();

        setTimeout(function () {
            // after 1000 ms we add the class animated to the login/register card
            $('.card').removeClass('card-hidden');
        }, 700);
    });
</script>

</html>
