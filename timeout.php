<?php 
    define("TITLE", "Timeout | CCIT WFH Attendance Monitoring System");
    include('connection/dbconnection.php');
    include('data/indexController.php');
    include('data/attendanceController.php');
    include('data/taskController.php');
    include('includes/header.php');
    include('data/user_menu.php');
    include('connection/checklogin.php');
    $message = "";
    $tasks = getMySelectedTasks($_SESSION['id'])[0];
    $task_ids = [];
    $filenames = [];
    $test = [];
    if(is_timed_in(date("Y-m-d"),$_SESSION['id']) == null || is_timed_out(date("Y-m-d"),$_SESSION['id'])['timed_out'] == 1){
        header("location: dashboard.php");
    }
    else {
        set_page("timeout.php");
        if (isset($_POST['next'])) {
            foreach($tasks as $task){
                if ($_POST['checkbox'.$task['task_id']] == "on" && $_FILES['file'.$task['task_id']]) {
                    $task_ids[] =  (int) $task['task_id'];
                    $filenames[] = $_FILES['file'.$task['task_id']];
                    $test[] = uploadMyFiles($task['task_id'],$_FILES['file'.$task['task_id']],$_SESSION['id']);
                    $_SESSION['has_upload'] = "Yes";
                }
            }
            $_SESSION['timeout_selected_ids'] = $task_ids;
            $_SESSION['timeout_selected_filenames'] = $filenames;
            echo '<script type="text/javascript">window.location="timeout-verify.php"; </script>';
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
                            <a href="#" class="nav-link active" data-step="tasktosubmit">
                                <i class="d-block pli-notepad fs-2 mb-2"></i>
                                <span>Task to Submit</span>
                            </a>

                        </nav>
                        <!-- END : Step progress -->
                    <!-- END : Step progress -->
                        <!-- Form sections -->
                        <!-- <?php print_r($test);?> -->
                        <!-- <?php print_r($_SESSION['timeout_selected_ids']);?> -->
                        <!-- <?php print_r($_SESSION['timeout_selected_filenames']);?> -->
                        <form action="timeout.php" method="post" enctype="multipart/form-data">
                            <section data-step="tasktosubmit">
                                <div class="row mb-3">
                                    <div class="col-xl-6 mb-3">
                                        <div class="row align-items-center">
                                            <label for="_dm-wRegFirstName" class="col-sm-4 col-form-label">First name</label>
                                            <div class="col-sm-8">
                                                <input id="_dm-wRegFirstName" class="form-control" type="text" readonly value="<?php echo $_SESSION['firstname']?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="row align-items-center">
                                            <label for="_dm-wRegLastName" class="col-sm-4 p-xl-0 text-xl-end col-form-label">Last name</label>
                                            <div class="col-sm-8">
                                                <input id="_dm-wRegLastName" class="form-control" type="text" readonly value="<?php echo $_SESSION['lastname']?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="_dm-wRegCollege" class="col-sm-4 col-xl-2 col-form-label">College</label>
                                    <div class="col-sm-8 col-xl-10">
                                        <input id="_dm-wRegCollege" type="text" class="form-control" readonly value="<?php echo $_SESSION['department_name']?>">
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label class="mb-3 align-items-center">Task List</label>
                                    <div class="mx-3" style="color:red;text-align:left"><i >Note: Make sure to tick the checkbox corresponding to the file to be uploaded. </i>
                                    </div>
                                    <!-- Bordered table -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Check Here</th>
                                                    <th>Tasks</th>
                                                    <th>Time Started</th>
                                                    <th>Upload</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                // echo ;
                                                // print_r(json_decode($tasks[0][0])[0]);
                                                ?>
                                            <?php
                                            if ($tasks == "No Task Selected") {
                                                echo $tasks;
                                            } else{
                                            foreach ($tasks as $task) { ?>
                                            <tr>
                                                
                                                <td class="text-center"> 
                                                    <input name=<?php echo "checkbox".$task['task_id'];?> id="_dm-blockCheckboxes" class="form-check-input" type="checkbox">
                                                    <div class="valid-feedback">Checked!</div>
                                                    <div class="invalid-feedback">Please check atleast one task.</div>
                                                </td>
                                                <td><?php echo $task['task_name'];?></td>
                                                <td><?php echo $task['start_time'];?></td>
                                                <td><input id="_dm-fileInput" class="form-control" type="file" name=<?php echo "file".$task['task_id'];?>></td>
                                                
                                                </tr>
                                            <?php }}?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- END : Bordered table -->
                                </div>
                                <div class="pt-3 d-flex">
                                    <button class="btn btn-primary ms-auto" type="submit" name="next" id="next">Next</button>
                                </div>
                                </section>
                            </form>
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
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - HEADER -->

        <!-- MAIN NAVIGATION -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
</body>
<?php 
include('includes/footer.php'); 
?>