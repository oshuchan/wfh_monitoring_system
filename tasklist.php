<?php 
    define("TITLE", "Task List | CCIT WFH Attendance Monitoring System");
    include('connection/dbconnection.php');
    include('data/indexController.php');
    include('data/taskController.php');
    include('includes/header.php');
    include('connection/checklogin.php');
    if ($_SESSION['user_type'] != "Administrator") {
        header("location: dashboard.php");
    }
    $tasks = getAllTasks();
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

                    <h1 class="page-title mb-0 mt-2">TASK LIST</h1>

                    <p class="lead">
                        CCIT Work From Home Attendance Monitoring System
                    </p>

                </div>

            </div>

            <!-- USER LIST TABLE -->
            <div class="content__boxed">
                <div class="content__wrap">
                    <div class="card text-center mb-4 col-xl-8 offset-xl-2">
                        <div class="card-header">Task List</div>
                        <div class="card-body">
             
                            <div class="card">
                                <div class="card-header -4 mb-3">
                                    <div class="row">

                                        <!-- Left toolbar -->
                                        <div class="col-md-6 d-flex gap-1 align-items-center mb-3">
                                            <div class="btn-group">
                                                <a title="Add Task" href="addtask.php"class="btn btn-icon btn-outline-light"><i
                                                        class="pli-folder-add fs-5"></i></a>
                                                <!-- <a href="edituser.php" class="btn btn-icon btn-outline-light"><i
                                                        class="pli-folder-edit fs-5"></i></a> -->
                                                <a title="Delete Task" href="deletetask.php" class="btn btn-icon btn-outline-light"><i
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
                                        </div> -->
                                        <!-- END : Right Toolbar -->
                                        <!-- USER LIST TABLE -->
                                        <div class="table-responsive">
                                            <div id="_dm-tabulatorEditData" class="table table-striped">
                                                <?php if (count($tasks) > 0) { ?>
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Task Name</th>
                                                                <th>Date Created</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php foreach ($tasks as $task) { ?>
                                                            <tr>
                                                                <td><?php echo $task['task_name'];?></td>
                                                                <td><?php echo $task['created_at']?></td>
                                                            </tr>
                                                            <?php }?>
                                                        </tbody>
                                                    </table>
                                                <?php } else { 
                                                    echo '<p style="color:red" class="text-center">No Task Available</p>';
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