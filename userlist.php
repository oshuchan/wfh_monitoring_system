<?php 
    define("TITLE", "User List | CCIT WFH Attendance Monitoring System");
    include('connection/dbconnection.php');
    include('data/indexController.php');
    include('data/userController.php');
    include('includes/header.php');
    include('connection/checklogin.php');
    $users = getUsers();
    
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

                    <h1 class="page-title mb-0 mt-2">USER LIST</h1>

                    <p class="lead">
                        CCIT Work From Home Attendance Monitoring System
                    </p>

                </div>

            </div>

            <!-- USER LIST TABLE -->
            <div class="content__boxed">
                <div class="content__wrap">
                    <div class="card text-center mb-4 col-xl-8 offset-xl-2">
                        <div class="card-header">User List</div>
                        <div class="card-body">
             
                            <div class="card">
                                <div class="card-header -4 mb-3">
                                    <div class="row">

                                        <!-- Left toolbar -->
                                        <div class="col-md-6 d-flex gap-1 align-items-center mb-3">
                                            <div class="btn-group">
                                                <a title="Add User" href="adduser.php"class="btn btn-icon btn-outline-light"><i
                                                        class="pli-folder-add fs-5"></i></a>
                                                <a title="Edit User" href="edituser.php" class="btn btn-icon btn-outline-light"><i
                                                        class="pli-folder-edit fs-5"></i></a>
                                                <a title="Delete User" href="deleteuser.php" class="btn btn-icon btn-outline-light"><i
                                                        class="pli-trash fs-5"></i></a>

                                            </div>
                                        </div>

                                        
                                        <!-- END : Left toolbar -->

                                        <!-- Right Toolbar -->
                                        <!-- <div
                                            class="col-md-6 d-flex gap-1 align-items-center justify-content-md-end mb-3">
                                            <div class="form-group">
                                                <input type="text" placeholder="Search..." class="form-control"
                                                    autocomplete="off">
                                            </div>
                                            
                                        </div> -->
                                        <!-- END : Right Toolbar -->


                                        <!-- USER LIST TABLE -->

                                        
                                        <div class="table-responsove">
                                            <div id="_dm-tabulatorEditData" class="table table-striped">
                                                <?php if (count($users) > 0) { ?>
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Username</th>
                                                            <th>Email</th>
                                                            <th>User Type</th>
                                                            <th>Department</th>
                                                            <th>Designation</th>
                                                            <th>User Type</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($users as $user) {
                                                            ?>
                                                        <tr>
                                                            <td><?php echo $user['first_name'] . " " . $user['last_name'];?></td>
                                                            <td><?php echo $user['username'];?></td>
                                                            <td><?php echo $user['email']?></td>
                                                            <td><?php echo $user['user_type']?></td>
                                                            <td><?php echo $user['department_name']?></td>
                                                            <td><?php echo $user['designation_name']?></td>
                                                            <td><?php echo $user['user_type']?></td>
                                                        </tr>
                                                        <?php
                                                        }?>
                                                    </tbody>
                                                </table>
                                                <?php } else { 
                                                    echo '<p style="color:red" class="text-center">No User Available</p>';
                                                    }?>
                                            </div>
                                        </div>
                                        <!-- END OF USER LIST TABLE -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <!-- FOOTER -->
            <?php include("includes/footer_links.php")?>
            <!-- END - FOOTER -->

        </section>

        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - CONTENTS -->

        <!-- HEADER -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - HEADER -->

        <!-- MAIN NAVIGATION -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <?php include("includes/nav.php");?>
    </body>
<?php include("includes/footer.php");?>