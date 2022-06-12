<?php 
    define("TITLE", "Timein | CCIT WFH Attendance Monitoring System");
    include('connection/dbconnection.php');
    include('data/indexController.php');
    include('data/attendanceController.php');
    include('data/taskController.php');
    include('includes/header.php');
    include('data/user_menu.php');
    include('connection/checklogin.php');
    
    if (is_timed_in(date("Y-m-d"),$_SESSION['id']) != null){
        header("location:dashboard.php");
    }else
    {
        set_page("timein.php");
        $task_ids =[];
        $tasks =  getAllTasks();
        if (isset($_POST['next'])) {
            foreach ($_POST as $item => $val) {
                if($val == "on"){
                    $id = substr($item, strpos($item, "x") + 1);
                    array_push($task_ids,$id);
                }
            }
            $_SESSION['task_ids'] = $task_ids;
            echo '<script type="text/javascript">window.location="timein-verify.php"; </script>';
        }
    }
    $test = is_timed_in(date("Y-m-d"),$_SESSION['id']);
    


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

                <h1 class="page-title mb-0 mt-2">TIME IN FORM</h1>

                <p class="lead">
                    CCIT Work From Home Attendance Monitoring System
                    
                </p>
               
            </div>

        </div>

        
        <!-- FORM -->
        <!-- TIME IN -->
        <div class="content__boxed">
            <div class="content__wrap">
                <div class="card text-center mb-4 col-xl-8 offset-xl-2">

                    <div class="card-body">
                       <!-- Step progress -->
                       <nav id="_dm-customWizardSteps" class="nav nav-callout justify-content-center flex-nowrap mt-3 mb-3">
                        <a href="#" class="nav-link active" data-step="tasktodo">
                            <i class="d-block pli-notepad fs-2 mb-2"></i>
                            <span>Task to Do</span>
                        </a>

                    </nav>
                    <!-- <?php echo $str_ids;?> -->
                    <!-- <?php echo $test;?> -->
                    <!-- END : Step progress -->
                    <!-- <div class="table-responsove">
                        <div id="_dm-tabulatorEditData" class="table table-striped">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Task Name</th>
                                        <th>Task Status</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($tasks as $task) {
                                        ?>
                                    <tr>
                                        <td><?php echo $task['id'];?></td>
                                        <td><?php echo $task['task_name'];?></td>
                                        <td><?php echo $task['task_status'];?></td>
                                        <td><?php echo $task['created_at']?></td>
                                        <td>
                                            <a title="Claim Task" href="timein.php?action=work&id=<?php echo $task['id'];?>" class="btn btn-primary btn-sm m-1" type="submit">Work this Task</a> 
                                        </td>
                                    </tr>
                                    <?php
                                    }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr> -->
                    <!-- Form sections -->
                    <form action="timein.php" method="post">
                    <section data-step="tasktodo">
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
                            <?php if (count($tasks) == 0) {?>
                                <p style="color:red" class="text-center">No Task Available</p>
                            <?php }else{?>
                            <!-- Bordered table -->
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Check Here</th>
                                            <th>Tasks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($tasks as $task) { ?>
                                    <tr>
                                        <td class="text-center"> 
                                            <input name=<?php echo "checkbox".$task['id'];?> id="_dm-blockCheckboxes" class="form-check-input" type="checkbox">
                                            <div class="valid-feedback">Checked!</div>
                                            <div class="invalid-feedback">Please check atleast one task.</div>
                                        </td>
                                        <td><?php echo $task['task_name'];?></td>
                                        </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>
                            <?php }?>
                            <!-- END : Bordered table -->

                        </div>


                        <div class="pt-3 d-flex">
                            <button class="btn btn-primary ms-auto" type="submit" name="next" id="next">Next</button>
                        </div>
                        </section>

                        
                    </form>

                    



                    <!-- <form action="timein.php" method="POST" class="p-xl-3 align-items-center needs-validation" novalidate="">

                        <section data-step="tasktodo">

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

                            
                         

                            <div class="pt-3 d-flex">
                                <button class="btn btn-primary ms-auto" type="submit" name="nextPage" id="nextPage">Next</button>
                            </div>

                           

                        </section>
                        

                    </form> -->
                    <!-- END : Form sections -->
                    </div>
                </div>
            </div>
            </div>
        <!-- END OF TIME IN -->
        <!-- END OF FORM -->
        <!-- FOOTER -->
        <?php include("includes/footer_links.php");?>
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
   
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <!-- END - PAGE CONTAINER -->
</body>

<?php 
include('includes/footer.php'); 
?>