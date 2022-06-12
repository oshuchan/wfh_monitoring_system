<?php 
define("TITLE", "REGISTER | CCIT WFH Attendance Monitoring System");
include('connection/dbconnection.php');
include('data/indexController.php');
include('includes/header.php');

?>

<body class="" style="background-image: url('./images/background/faith-whole.jpg');">

<!-- PAGE CONTAINER -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<div id="root" class="root front-container">

    <!-- CONTENTS -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <section id="content" class="content">
        <div class="content__boxed w-100 min-vh-100 d-flex flex-column align-items-center justify-content-center">
            <div class="content__wrap">

                <!-- Register card -->
                <div class="card shadow-lg">
                    <div class="card-body">

                        <div class="text-center">
                            <img src="./images/logo/faith-whole-logo.png" width="400"
                            height="150" alt="faith logo" loading="lazy">

                            
                            <h1 class="h3">Create a New Account</h1>
                            <p>CCIT WFH Attendance Monitoring System</p>
                        </div>

                        <form action="./dashboard.php" class="mt-4 needs-validation" novalidate="">
                        <div class="w-md-400px d-inline-flex row g-3 mb-4">

                                    <div class="col-md-6 mt-3 position-relative">
                                        <label for="_dm-vCustomFirsname" class="form-label">First name</label>
                                        <input id="_dm-vCustomFirsname" type="text" class="form-control" value="" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please input your first name</div>
                                    </div>

                                    <div class="col-md-6 mt-3 position-relative">
                                        <label for="_dm-vCustomLastname" class="form-label">Last name</label>
                                        <input id="_dm-vCustomLastname" type="text" class="form-control" value="" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please input your last name</div>
                                    </div>

                                    <div class="col-md-12 mt-3 position-relative">
                                        <label for="_dm-vCustomUsername" class="form-label">Username</label>
                                        <input id="_dm-vCustomUsername" type="text" class="form-control" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please input your username.</div>
                                    </div>

                                    <div class="col-md-12 mt-3 position-relative">
                                        <label for="_dm-vCustomEmail" class="form-label">Email</label>
                                        <input id="_dm-vCustomEmail" type="text" class="form-control" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please input your primary email.</div>
                                    </div>

                                    <div class="col-md-12 mt-3 position-relative">
                                        <label for="_dm-vCustomEmail" class="form-label">Secondary Email</label>
                                        <input id="_dm-vCustomEmail" type="text" class="form-control" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please input your secondary email.</div>
                                    </div>


                                    <div class="col-md-6 mt-3 position-relative">
                                        <label for="_dm-vCustomPassword" class="form-label">Password</label>
                                        <input id="_dm-vCustomPassword" type="password" class="form-control" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Password is invalid.</div>
                                    </div>

                                    <div class="col-md-6 mt-3 position-relative">
                                        <label for="_dm-vCustomConfirmPassword" class="form-label">Confirm Password</label>
                                        <input id="_dm-vCustomConfirmPassword" type="password" class="form-control" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Password does not match.</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="_dm-vCustomDepartment" class="form-label">Department</label>
                                        <select id="_dm-vCustomDepartment" class="form-select" required="">
                                            <option selected="" disabled="" value="">Choose Department</option>
                                            <option>CCIT</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a Department</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="_dm-vCustomDesignation" class="form-label">Designation</label>
                                        <select id="_dm-vCustomDesignation" class="form-select" required="">
                                            <option selected="" disabled="" value="">Choose Designation</option>
                                            <option>Dean</option>
                                            <option>Chair</option>
                                            <option>PT Instructor</option>
                                            <option>FT Instructor</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a Designation</div>
                                    </div>

                                    <div class="col-12 pt-4 d-grid gap-2">
                                        <button class="btn btn-primary btn-lg" type="submit">Register</button>                                      
                                    </div>

                                    </div>
                                </form>

                                

                        <div class="text-center align-items-center justify-content-between border-top pt-3"> Already have an account?
                            <a href="login.php" class="btn-link text-decoration-none"> Sign In </a>

                            <div class="ms-3">
                                
                            </div>

                        </div>
                <!-- END : Register card -->


            </div>
        </div>
    </section>

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - CONTENTS -->
</div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END - PAGE CONTAINER -->

</body>

<?php 
include('includes/footer.php'); 
?>