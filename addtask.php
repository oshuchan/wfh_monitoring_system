<?php 
    define("TITLE", "Add Task | CCIT WFH Attendance Monitoring System");
    include('connection/dbconnection.php');
    include('data/indexController.php');
    include('data/taskController.php');
    include('includes/header.php');
    include('connection/checklogin.php');
    $message = "";

    if(isset($_POST['submit'])){
        $message = addTask($_POST);
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

                    <h1 class="page-title mb-0 mt-2">ADD TASK</h1>

                    <p class="lead">
                        CCIT Work From Home Attendance Monitoring System
                    </p>

                </div>
            </div>
            <!-- ADD TASK -->
            <div class="content__boxed">
                <div class="content__wrap">
                    <div class="card text-center mb-4 col-xl-8 offset-xl-2">
                        <div class="card-header">Add Task</div>
                        <div class="card-body">
                            <p style="color:red"><?php echo $message;?></p>
                            <form action="addtask.php" class="mt-4 needs-validation" method="POST">
                                <div class="w-md-400px d-inline-flex row g-3 mb-4">
                                    <div class="col-md-12 mt-3 position-relative">
                                        <label for="_dm-vCustomFirsname" class="form-label">Task name</label>
                                        <input name="task_name" id="_dm-vCustomFirsname" type="text" class="form-control" value="" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please type in task name</div>
                                    </div>

                                    <div class="col-md-12 mt-3 position-relative">
                                        <label for="_dm-vCustomAccountStatus" class="form-label">Task Status</label>
                                        <select name="task_status"  id="_dm-vCustomAccountStatus" class="form-select" required="">
                                            <option selected="" disabled="" value="">Choose Status</option>
                                            <option value=1>Enabled</option>
                                            <option value=0>Disabled</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a status.</div>
                                    </div>

                                    <div class="col-12 pt-4 d-grid gap-2">
                                        <button class="btn btn-primary btn-lg" type="submit" name="submit">Register Task</button>                                      
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END OF ADD USER -->


            <!-- FOOTER -->
            <?php include("includes/footer_links.php")?>
            <!-- END - FOOTER -->

        </section>

        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - CONTENTS -->

        <!-- HEADER -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <?php include("includes/nav.php")?>    
    </body>

<?php 
include('includes/footer.php'); 
?>