<?php 
    define("TITLE", "Delete User | CCIT WFH Attendance Monitoring System");
    include('connection/dbconnection.php');
    include('data/indexController.php');
    include('data/userController.php');
    include('includes/header.php');
    include('connection/checklogin.php');
    $users = getUsers();
    $selected_id = 0;
    // if($_GET['action'] == 'edit' && $_GET['id'] > 0){
    //     $edit_id = $_GET['id'];
    //     $userData = getUserByID($edit_id);
    // }
    $response="";
    $firstname = "";
    $lastname = "";
    $username = "";
    $email = "";
    $secondary_email = "";
    $password = "";
    $department_id = 1;
    $designation_id = 1;
    $user_type = 1;
    $active = 0;

    $user_ids = getUserIDs();

    if(isset($_POST['search'])){
        
        $user_data = getUserByID($_POST['user_id']);
        $_SESSION['edit_id'] = $user_data['id'];
        $selected_id = $user_data['id'];

        $firstname = $user_data['first_name'];
        $lastname = $user_data['last_name'];
        $username = $user_data['username'];
        $email = $user_data['email'];
        $secondary_email = $user_data['secondary_email'];
        $password = $user_data['password'];
        $department_id = $user_data['department_id'];
        $designation_id = $user_data['designation_id'];
        $user_type = $user_data['user_type'];
        $active = $user_data['active'];

    } 
    if (isset($_POST['delete'])) {
        $response = deleteUser($_SESSION['edit_id']);
        $user_ids = getUserIDs();
    }
    if ($_SESSION['user_type'] != "Administrator") {
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

                    <h1 class="page-title mb-0 mt-2">Delete USER</h1>

                    <p class="lead">
                        CCIT Work From Home Attendance Monitoring System
                    </p>

                </div>

            </div>

            <!-- EDIT USER -->
            <div class="content__boxed">
                <div class="content__wrap">
                    <div class="card text-center mb-4 col-xl-8 offset-xl-2">
                        <div class="card-header">Delete User</div>
                        <div class="card-body">
                        

                        <!-- SEARCH DATA -->
                        <form action="deleteuser.php" method="post" id="searchform">
                        <label for="_dm-vCustomAccountStatus" class="form-label">Search User ID</label>
                        <div class="row">
                            <div class="col-md-10">
                                <div class="col-md-12">
                                    <select name="user_id" id="_dm-vCustomAccountStatus" class="form-select" required="" selected=<?php echo $selected_id?>>
                                        <option  disabled="" value="">Choose User ID</option>
                                        <?php foreach($user_ids as $item){ ?>
                                            <option value=<?php echo$item['id'];?>><?php echo $item['id'] . "-". $item['last_name']?></option>
                                        <?php }?>
                                        
                                    </select>
                                    <div class="invalid-feedback">Please select a User ID.</div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-md" type="submit" name="search">Search User</button>
                                </div>
                            </div>
                            
                        </div>
                        </form>
                        <!-- END OF SEARCH DATA -->
                        <br><hr>
                        <form action="deleteuser.php" class="mt-4 needs-validation" method="POST">
                            <div class="w-md-400px d-inline-flex row g-3 mb-4">
                                <div class="col-md-6 mt-3 position-relative">
                                    <label for="_dm-vCustomFirsname" class="form-label">First name</label>
                                    <input name="firstname" id="_dm-vCustomFirsname" type="text" class="form-control" readonly value=<?php echo $firstname;?> >
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please type in first name</div>
                                </div>

                                <div class="col-md-6 mt-3 position-relative">
                                    <label for="_dm-vCustomLastname" class="form-label">Last name</label>
                                    <input name="lastname"  id="_dm-vCustomLastname" type="text" class="form-control" readonly value=<?php echo $lastname;?> >
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please type in last name</div>
                                </div>

                                <div class="col-md-12 mt-3 position-relative">
                                    <label for="_dm-vCustomUsername" class="form-label">Username</label>
                                    <input name="username" id="_dm-vCustomUsername" type="text" class="form-control" readonly value=<?php echo $username;?>>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please type in username.</div>
                                </div>

                                <div class="col-md-12 mt-3 position-relative">
                                    <label for="_dm-vCustomEmail" class="form-label">Email</label>
                                    <input name="email" id="_dm-vCustomEmail" type="text" class="form-control" readonly value=<?php echo $email;?>>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please type in primary email.</div>
                                </div>

                                <div class="col-md-12 mt-3 position-relative">
                                    <label for="_dm-vCustomEmail" class="form-label">Secondary Email</label>
                                    <input name="secondary_email" id="_dm-vCustomEmail" type="text" class="form-control" readonly value=<?php echo $secondary_email;?>>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please type in secondary email.</div>
                                </div>


                                <div class="col-md-6 mt-3 position-relative">
                                    <label for="_dm-vCustomPassword" class="form-label">Password</label>
                                    <input name="password" id="_dm-vCustomPassword" type="password" class="form-control" readonly value=<?php echo $password;?>>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Please type in password.</div>
                                </div>

                                <div class="col-md-6 mt-3 position-relative">
                                    <label for="_dm-vCustomConfirmPassword" class="form-label">Confirm Password</label>
                                    <input name="repassword"  id="_dm-vCustomConfirmPassword" type="password" class="form-control" readonly value=<?php echo $password;?>>
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Password does not match.</div>
                                </div>

                                <div class="col-md-12 mt-3 position-relative">
                                <label for="_dm-vCustomDepartment" class="form-label">Department</label>
                                <select name="department_id" id="_dm-vCustomDepartment" class="form-select" disabled selected=<?php echo $department_id;?>>
                                    <option disabled="" value="">Choose Department</option>
                                    <option value=1 >CCIT</option>
                                </select>
                                <div class="invalid-feedback">Please select a Department.</div>
                            </div>

                            <div class="col-md-12 mt-3 position-relative">
                                <label for="_dm-vCustomDesignation" class="form-label">Designation</label>
                                <select name="designation_id" id="_dm-vCustomDesignation" class="form-select" disabled selected=<?php echo $designation_id;?>>
                                    <option disabled="" value="">Choose Designation</option>
                                    <option value=1>Dean</option>
                                    <option value=2>Chair</option>
                                    <option value=3>PT Instructor</option>
                                    <option value=4>FT Instructor</option>
                                </select>
                                <div class="invalid-feedback">Please select a Designation.</div>
                            </div>

                            <div class="col-md-6 mt-3 position-relative">
                                <label for="_dm-vCustomAccountRole" class="form-label">Account Role</label>
                                <select name="role" id="_dm-vCustomAccountRole" class="form-select" disabled selected=<?php echo $user_type;?>>
                                    <option disabled="" value="">Choose Role</option>
                                    <option value="Administrator">Administrator</option>
                                    <option value="Faculty">Faculty</option>
                                </select>
                                <div class="invalid-feedback">Please select a Role.</div>
                            </div>

                            <div class="col-md-6 mt-3 position-relative">
                                <label for="_dm-vCustomAccountStatus" class="form-label">Account Status</label>
                                <select name="status" id="_dm-vCustomAccountStatus" class="form-select" disabled selected=<?php echo $active;?>>
                                    <option disabled="" value="">Choose Status</option>
                                    <option value=1>Enabled</option>
                                    <option value=0>Disabled</option>
                                </select>
                                <div class="invalid-feedback">Please select a Status.</div>
                            </div>
                            <div class="col-md-12 mt-3 position-relative">
                                            <input id="_dm-blockCheckboxes" class="form-check-input" type="checkbox" required="">
                                            <label for="_dm-vCustomFirsname" class="form-label">Confirm to delete.</label>
                                            <div class="valid-feedback">Checked!</div>
                                            <div class="invalid-feedback">Are you sure?.</div>
                                        </div>
                                <!-- <div class="col-sm-12">
                                <p> Profile Picture (Optional) </p>
                                <input id="_dm-fileInput" class="form-control" type="file"> -->

                                <div class="col-12 pt-4 d-grid gap-2">
                                    <button class="btn btn-danger btn-lg" type="submit" name="delete">Deactivate User</button>                                      
                                </div>

                                </div>
                            </form>



                        </div>


                        
                    </div>


    

                </div>
            </div>
            <!-- END OF EDIT USER -->


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
<?php include("includes/footer.php");?>