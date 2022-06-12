<?php 
    define("TITLE", "Timeout Verify | CCIT WFH Attendance Monitoring System");
    include('connection/dbconnection.php');
    include('data/indexController.php');
    include('data/attendanceController.php');
    include('includes/header.php');
    include('data/user_menu.php');
    include('connection/checklogin.php');
    $message = "";
    $task_ids = $_SESSION['timeout_selected_ids'];
    $filenames = $_SESSION['timeout_selected_filenames'];
    if(isset($_POST['submit'])){
        $username =  mysqli_real_escape_string($conn,$_POST['username']);
        $password =  mysqli_real_escape_string($conn,$_POST['password']);
        $repassword =  mysqli_real_escape_string($conn,$_POST['repassword']);
        $user_id = $_SESSION['id'];
        $message = confirmPassword($username,$user_id,$password,$repassword,"OUT",[]);
    }
?>

<body class="jumping">

    <!-- PAGE CONTAINER -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div id="root" class="root mn--max hd--expanded">

        <!-- CONTENTS -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <section id="content" class="content">
            <div class="content__header content__boxed">
                <div class="content__wrap">

                    <h1 class="page-title mb-0 mt-2">TIME OUT FORM</h1>

                    <p class="lead">
                        CCIT Work From Home Attendance Monitoring System
                    </p>

                </div>

            </div>
            <!-- FORM -->
            <!-- TIME OUT -->
            <div class="content__boxed">
                <div class="content__wrap">
                    <div class="card text-center mb-4 col-xl-8 offset-xl-2">

                        <div class="card-body">
                           <!-- Step progress -->
                           <nav id="_dm-customWizardSteps" class="nav nav-callout justify-content-center flex-nowrap mt-3 mb-3">
                            <a href="#" class="nav-link active" data-step="account">
                                <i class="d-block pli-security-check fs-2 mb-2"></i>
                                <span>Verify</span>
                            </a>
                        </nav>
                        <!-- END : Step progress -->
                        <!-- Form sections -->
                        <form action="timeout-verify.php" method="POST" role="form" class="p-xl-3 align-items-center">
                            <!-- Verify section -->
                            <section data-step="verify">
                            <p style="color:red"><?php print_r($message);?></p>
                            <div class="row mb-3">
                                    <label for="username" class="col-sm-4 col-xl-2 col-form-label">Username</label>
                                    <div class="col-sm-8 col-xl-10">
                                        <input id="username" name="username" type="text" class="form-control" readonly value="<?php echo $_SESSION['username']?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-sm-4 col-xl-2 col-form-label">Email</label>
                                    <div class="col-sm-8 col-xl-10">
                                        <input id="email" name="email" type="email" class="form-control" readonly value="<?php echo $_SESSION['email']?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-xl-6 mb-3">
                                        <div class="row align-items-center">
                                            <label for="password" class="col-sm-4 col-form-label">Password</label>
                                            <div class="col-sm-8">
                                                <input name="password" id="password" class="form-control" type="password" required="">

                                                <!-- <div class="valid-feedback">Looks good!</div>
                                                <div class="invalid-feedback">Please type in your password.</div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="row align-items-center">
                                            <label for="repassword" class="col-sm-4 p-xl-0 text-xl-end col-form-label">Retype password</label>
                                            <div class="col-sm-8">
                                                <input name="repassword" id="repassword" class="form-control" type="password" required="">
                                                <!-- <div class="valid-feedback">Looks good!</div>
                                                <div class="invalid-feedback">Password does not match.</div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pt-3 d-flex">
                                    <a href="timeout.php" class="btn btn-light ms-auto" type="button">Back</a>
                                    <button class="btn btn-primary ms-1" type="submit" id="submit" name="submit">Next</button>
                                </div>
                            </section>
                            <!-- END : Task to Do section -->
                        </form>
                        <!-- END : Form sections -->

                        </div>
                    </div>
                </div>
            <!-- END OF TIME OUT -->
            <!-- END OF FORM -->


            <!-- FOOTER -->
            <?php include("includes/footer_links.php");?>
            <!-- END - FOOTER -->

        </section>

        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - CONTENTS -->

        <!-- HEADER -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <?php include("includes/nav.php");?>    
    </body>
<?php 
include('includes/footer.php'); 
?>