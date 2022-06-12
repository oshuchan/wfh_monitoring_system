<?php
    define("TITLE", "Settings | CCIT WFH Attendance Monitoring System");
    include('connection/dbconnection.php');
    include('data/indexController.php');
    include('includes/header.php');
    include('data/user_menu.php');
    include('connection/checklogin.php');
    $error = "";
    if(isset($_POST['submit'])){
        $password = $_POST['password'];
        $username = $_SESSION['username'];
        $error = login($username,$password);
    }
?>

<body class="" style="background-image: url('./images/background/faith-mabini.jpg');">

    <!-- PAGE CONTAINER -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div id="root" class="root front-container">

        <!-- CONTENTS -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <section id="content" class="content">
            <div class="content__boxed w-100 min-vh-100 d-flex flex-column align-items-center justify-content-center">
                <div class="content__wrap">

                    <!-- Login card -->
                    <div class="card shadow-lg">
                        <div class="card-body">

                            <div class="text-center">
                                <img class="img-lg rounded-circle mb-3" src="./images/pfp/pfp-sample.jpg" alt="Picture profile">
                                <h1 class="h3"><?php echo $_SESSION['firstname']. " " .$_SESSION['lastname'] ;?></h1>
                                <p><?php echo $_SESSION['user_type'] ?></p>
                            </div>
                            <?php echo $error;?>
                            <form action="lockscreen.php" class="mt-4 needs-validation" method="POST">

                                <div class="col-md-12 mt-3 position-relative">
                                    <label for="_dm-vCustomPassword" class="form-label">Password</label>
                                    <input name="password" type="password" class="form-control" required="">
                                    <!-- id="_dm-vCustomPassword" -->
                                    <!-- <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Password is invalid.</div> -->
                                </div>

                                <!-- <div class="col-md-12 mt-3 position-relative">
                                    <input type="checkbox" value="lsRememberMe" id="rememberMe"> <label for="rememberMe">Remember me</label>
                                </div> -->

                                <div class="col-12 pt-4 d-grid gap-2">
                                    <button class="btn btn-primary btn-lg" type="submit" name="submit">Login</button>                                      
                                </div>
                            </form>

                            <!-- <div class="text-center mt-4">
                                <a href="login.php" class="btn-link text-decoration-none">Sign in using different account</a>
                            </div> -->

                        </div>
                    </div>
                    <!-- END : Login card -->

                </div>
            </div>
        </section>

        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - CONTENTS -->
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - PAGE CONTAINER -->

    <script src="./assets/pages/form-validation.js" defer></script>

</body>

</html>