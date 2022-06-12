<?php
    define("TITLE", "Settings | CCIT WFH Attendance Monitoring System");
    include('connection/dbconnection.php');
    include('data/indexController.php');
    include('includes/header.php');
    include('data/user_menu.php');
    include('connection/checklogin.php');

    set_page("settings.php");
    $error_password = "";
    $error_email = "";
    $data = [];
    // $message = "";
    if(isset($_POST['submit_password'])){
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $new_repassword = $_POST['new_repassword'];
        if ($new_password == $new_repassword) {
            $error_password = updatePassword($_SESSION['id'],$old_password,$new_password);
            $data = $_POST;
        } else {
            $error_password = "Passwords Does Not Match!";
        }
    }
    if(isset($_POST['submit_email'])){
        $old_email = $_POST['old_email'];
        $new_email = $_POST['new_email'];
        $new_reemail = $_POST['new_reemail'];
        if ($new_email == $new_reemail) {
            $error_email = updateEmail($_SESSION['id'],$old_email,$new_email);
            if($error_email == "Email Updated Successfully"){
                $_SESSION['email'] = $new_email;
            }
        } else {
            $error_email = "Emails Does Not Match!";
        }
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

                    <h1 class="page-title mb-0 mt-2">ACCOUNT SETTINGS</h1>

                    <p class="lead">
                        CCIT Work From Home Attendance Monitoring System
                    </p>

                </div>

            </div>

            <!-- SETTINGS -->
            <div class="content__boxed">
                <div class="content__wrap">
                    <div class="card mb-4 col-xl-8 offset-xl-2">
                        <div class="card-header text-center">Password Settings</div>
                        <div class="card-body">

                        <div class="row">
                        <div class="col-md-12 mb-3">
                                <div class="card-body">

                                    <h5 class="card-title">Change Password</h5>
                                    <p style="color:red"><?php echo $error_password;?></p>
                                    <!-- Change Password -->
                                    <form action="settings.php" method="POST" class="row g-3 needs-validation">
                                    <div class="col-md-12">
                                            <label for="_dm-vCustomFirsname" class="form-label">Old Password</label>
                                            <input name="old_password"  id="_dm-vCustomFirsname" type="password" class="form-control" value="" required="">
                                            <div class="invalid-feedback">Please type in your old password.</div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="_dm-vCustomLastname" class="form-label">New Password</label>
                                            <input name="new_password" id="_dm-vCustomLastname" type="password" class="form-control" required="">
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Please type in your new password.</div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="_dm-vCustomLastname" class="form-label">Confirm New Password</label>
                                            <input name="new_repassword" id="_dm-vCustomLastname" type="password" class="form-control" required="">
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">New password does not match.</div>
                                        </div>
                                        
                                        <div class="col-12 pt-4 text-end">
                                            <button class="btn btn-primary" type="submit" name="submit_password">Update Password</button>
                                        </div>
                                    </form>
                                    <!-- END : Change Password -->


                            </div>
                        </div>
                    </div>
                        




                        </div>
                    </div>
                </div>

            </div>

            <!-- SETTINGS -->
            <div class="content__boxed">
                <div class="content__wrap">
                    <div class="card mb-4 col-xl-8 offset-xl-2">
                        <div class="card-header text-center">Email Settings</div>
                        <div class="card-body">

                        <div class="row">
                        <div class="col-md-12 mb-3">
                                <div class="card-body">

                                    <h5 class="card-title">Change Email</h5>
                                    <p style="color:red"><?php echo $error_email;?></p>
                                    <!-- Change Email -->
                                    <form action="settings.php" method="POST" class="row g-3 needs-validation">
                                        <div class="col-md-12">
                                            <label for="_dm-vCustomFirsname" class="form-label">Old Email</label>
                                            <input name="old_email" id="_dm-vCustomFirsname" type="text" class="form-control" value="" required="">
                                            <div class="invalid-feedback">Please type in your old email.</div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="_dm-vCustomLastname" class="form-label">New Email</label>
                                            <input name="new_email" id="_dm-vCustomLastname" type="text" class="form-control" required="">
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Please type in your new email.</div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="_dm-vCustomLastname" class="form-label">Confirm New Email</label>
                                            <input name="new_reemail" id="_dm-vCustomLastname" type="text" class="form-control" required="">
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">New email does not match.</div>
                                        </div>
                                        
                                        <div class="col-12 pt-4 text-end">
                                            <button class="btn btn-primary" type="submit" name="submit_email">Update Email</button>
                                        </div>
                                    </form>
                                    <!-- END : Change Email -->

                                </div>

                        </div>
                    
                    </div>
                        




                        </div>
                    </div>
                </div>

            </div>


            <!-- FOOTER -->
            <?php include("includes/footer_links.php");?>
            <!-- END - FOOTER -->

        </section>

        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - CONTENTS -->

        <!-- HEADER -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <?php include("includes/nav.php"); ?>
    </body>
<?php include("includes/footer.php");?>