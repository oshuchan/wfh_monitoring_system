
<?php 
    define("TITLE", "Delete User | CCIT WFH Attendance Monitoring System");
    include('connection/dbconnection.php');
    include('data/indexController.php');
    include('data/taskController.php');
    include('includes/header.php');
    include('connection/checklogin.php');
    $tasks = getAllTasks();
    $response = "";

    if (isset($_POST['delete'])) {
        $delete_id = $_POST['task'];
        $response = deleteTask($delete_id);
        $tasks = getAllTasks();
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

                    <h1 class="page-title mb-0 mt-2">DELETE TASK</h1>

                    <p class="lead">
                        CCIT Work From Home Attendance Monitoring System
                    </p>

                </div>

            </div>

            <!-- EDIT TASK -->
            <div class="content__boxed">
                <div class="content__wrap">
                    <div class="card text-center mb-4 col-xl-8 offset-xl-2">
                        <div class="card-header">Delete Task</div>
                        <div class="card-body">
                        <p style="color:red"><?php echo $response ?></p>
                        <form action="deletetask.php" class="mt-4 needs-validation" method="POST">
                            <div class="w-md-400px d-inline-flex row g-3 mb-4">

                                        <div class="col-md-12 mt-3 position-relative">
                                            <label for="_dm-vCustomAccountStatus" class="form-label">Task Name</label>
                                            <select name="task" id="_dm-vCustomAccountStatus" class="form-select" required="">
                                                <option selected="" disabled="" value="">Choose Task</option>
                                                <?php foreach ($tasks as $item) {?>
                                                <option value=<?php echo $item['id']?>><?php echo$item['task_name']?></option>
                                                <?php }?>
                                                <!-- <option>Syllabi Making</option>
                                                <option>Admin Work, Student Monitoring, Marketing, Report Making</option> -->
                                            </select>
                                            <div class="invalid-feedback">Please select a task.</div>
                                        </div>

                                        <div class="col-md-12 mt-3 position-relative">
                                            <input id="_dm-blockCheckboxes" class="form-check-input" type="checkbox" required="">
                                            <label for="_dm-vCustomFirsname" class="form-label">Confirm to delete.</label>
                                            <div class="valid-feedback">Checked!</div>
                                            <div class="invalid-feedback">Are you sure?.</div>
                                        </div>

                                        <div class="col-12 pt-4 d-grid gap-2">
                                            <button class="btn btn-danger btn-lg" type="submit" name="delete">Delete Task</button>                                      
                                        </div>

                                        

                                        </div>
                                    </form>



                        </div>


                        
                    </div>


    

                </div>
            </div>
            <!-- END OF EDIT TASk -->


            <!-- FOOTER -->
            <?php include("includes/footer_links.php")?>
            <!-- END - FOOTER -->

        </section>

        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - CONTENTS -->

        <!-- HEADER -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <?php include("includes/nav.php");?>   
    </body>

<?php include("includes/footer.php")?>