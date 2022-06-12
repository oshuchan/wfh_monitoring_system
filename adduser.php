<?php 
    define("TITLE", "Add User | CCIT WFH Attendance Monitoring System");
    include('connection/dbconnection.php');
    include('data/indexController.php');
    include('data/userController.php');
    include('includes/header.php');
    include('connection/checklogin.php');
    $response = "";

    if(isset($_POST['submit'])){
        $password =  mysqli_real_escape_string($conn,$_POST['password']);
        $repassword =  mysqli_real_escape_string($conn,$_POST['repassword']);
        $user_id = $_SESSION['id'];
        if($password == $repassword){
            $response = addUser($_POST);
        } else{
            $response = "Passwords Does Not Match!";
        }
        
    }
    if (!$_SESSION['user_type'] == "Administrator") {
        header("location: dashboard.php");
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

                <h1 class="page-title mb-0 mt-2">ADD USER</h1>

                <p class="lead">
                    CCIT Work From Home Attendance Monitoring System
                </p>

            </div>

        </div>

        <!-- ADD USER -->
        <div class="content__boxed">
            <div class="content__wrap">
                <div class="card text-center mb-4 col-xl-8 offset-xl-2">
                    <div class="card-header">Add User</div>
                    <div class="card-body">
                    
                    <p style="color:red"><?php echo $response;?></p>
                    <form action="adduser.php" class="mt-4 needs-validation" method="POST">
                        <div class="w-md-400px d-inline-flex row g-3 mb-4">

                                    <div class="col-md-6 mt-3 position-relative">
                                        <label for="_dm-vCustomFirsname" class="form-label">First name</label>
                                        <input name="firstname" id="_dm-vCustomFirsname" type="text" class="form-control" value="" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please type in first name</div>
                                    </div>

                                    <div class="col-md-6 mt-3 position-relative">
                                        <label for="_dm-vCustomLastname" class="form-label">Last name</label>
                                        <input name="lastname" id="_dm-vCustomLastname" type="text" class="form-control" value="" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please type in last name</div>
                                    </div>

                                    <div class="col-md-12 mt-3 position-relative">
                                        <label for="_dm-vCustomUsername" class="form-label">Username</label>
                                        <input name="username" id="_dm-vCustomUsername" type="text" class="form-control" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please type in username.</div>
                                    </div>

                                    <div class="col-md-12 mt-3 position-relative">
                                        <label for="_dm-vCustomEmail" class="form-label">Email</label>
                                        <input name="email" id="_dm-vCustomEmail" type="text" class="form-control" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please type in primary email.</div>
                                    </div>

                                    <div class="col-md-12 mt-3 position-relative">
                                        <label for="_dm-vCustomEmail" class="form-label">Secondary Email</label>
                                        <input name="secondary_email" id="_dm-vCustomEmail" type="text" class="form-control" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please type in primary email.</div>
                                    </div>

                                    <div class="col-md-6 mt-3 position-relative">
                                        <label for="_dm-vCustomPassword" class="form-label">Password</label>
                                        <input name="password" id="_dm-vCustomPassword" type="password" class="form-control" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please type in password.</div>
                                    </div>

                                    <div class="col-md-6 mt-3 position-relative">
                                        <label for="_dm-vCustomConfirmPassword" class="form-label">Confirm Password</label>
                                        <input name="repassword" id="_dm-vCustomConfirmPassword" type="password" class="form-control" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Password does not match.</div>
                                    </div>

                                    <div class="col-md-12 mt-3 position-relative">
                                        <label for="_dm-vCustomDepartment" class="form-label">Department</label>
                                        <select name="department" id="_dm-vCustomDepartment" class="form-select" required="">
                                            <option selected="" disabled="" value="">Choose Department</option>
                                            <option value=1>CCIT</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a Department.</div>
                                    </div>

                                    <div class="col-md-12 mt-3 position-relative">
                                        <label for="_dm-vCustomDesignation" class="form-label">Designation</label>
                                        <select name="designation" id="_dm-vCustomDesignation" class="form-select" required="">
                                            <option selected="" disabled="" value="">Choose Designation</option>
                                            <option value=1>Dean</option>
                                            <option value=2>Chair</option>
                                            <option value=3>PT Instructor</option>
                                            <option value=4>FT Instructor</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a Designation.</div>
                                    </div>

                                    <div class="col-md-6 mt-3 position-relative">
                                        <label for="_dm-vCustomAccountRole" class="form-label">Account Role</label>
                                        <select name="role" id="_dm-vCustomAccountRole" class="form-select" required="">
                                            <option selected="" disabled="" value="">Choose Role</option>
                                            <option value="Administrator">Administrator</option>
                                            <option value="Faculty">Faculty</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a Role.</div>
                                    </div>

                                    <div class="col-md-6 mt-3 position-relative">
                                        <label for="_dm-vCustomAccountStatus" class="form-label">Account Status</label>
                                        <select name="status" id="_dm-vCustomAccountStatus" class="form-select" required="">
                                            <option selected="" disabled="" value="">Choose Status</option>
                                            <option value=1>Enabled</option>
                                            <option value=0>Disabled</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a Status.</div>
                                    </div>

                                    <div class="col-sm-12">
                                    <!-- <p> Profile Picture (Optional) </p>
                                    <input id="_dm-fileInput" class="form-control" type="file"> -->

                                    <div class="col-12 pt-4 d-grid gap-2">
                                        <button class="btn btn-primary btn-lg" type="submit" name="submit">Register User</button>                                      
                                    </div>

                                    

                                    </div>
                                </form>




                    </div>


                    
                </div>




            </div>
        </div>
        <!-- END OF ADD USER -->


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