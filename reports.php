<?php 
define("TITLE", "Reports | CCIT WFH Attendance Monitoring System");
include('connection/dbconnection.php');
include('data/indexController.php');
include('data/attendanceController.php');
include('data/userController.php');
include('includes/header.php');
include('connection/checklogin.php');
$start_date = date('Y-m-01');
$end_date = date('Y-m-t');
$searchbox = 0;
$user_ids = getUserIDs();
$attendance_data = getAttendances($start_date,$end_date,$_SESSION['user_type']);
if(isset($_POST['search'])){
    if ($_SESSION['user_type'] == "Administrator") {
        $searchbox = $_POST['searchbox'];
    }
    $start_date = date("Y-m-d",strtotime($_POST['start_date']));
    $end_date = date("Y-m-d",strtotime($_POST['end_date']));
    if ($searchbox == 0) {
        $attendance_data = getAttendances($start_date,$end_date,$_SESSION['user_type']);
    } else{
        $attendance_data = searchAttendancesByUserID($start_date,$end_date,$_SESSION['user_type'],$searchbox);
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
                    <h1 style="text-transform:uppercase" class="page-title mb-0 mt-2">
                        <?php if ($_SESSION['user_type'] == "Administrator") {echo "Summary Of Reports";} else {echo "Log Entries";} ?>
                            </h1>
                    <p class="lead">
                        CCIT Work From Home Attendance Monitoring System
                    </p>
                </div>
            </div>

            <div class="content__boxed">
                <!-- SUMMARY OF REPORTS TABLE -->
                <div class="content__boxed">
                    <div class="content__wrap">
                        <div class="card text-center mb-4 col-xl-8 offset-xl-2">
                            <div class="card-header">
                            <?php if ($_SESSION['user_type'] == "Administrator") {echo "Summary Of Reports";} else {echo "Log Entries";} ?>
                            
                            </div>
                            <div class="card-body">

                                <div class="card">
                                    <div class="card-header mb-4 mb-3">
                                        <div class="row">

                                            <!-- Left toolbar -->
                                            <form action="reports.php" method="post">
                                            <!-- Left toolbar -->
                                            <div class="col-md-12 d-flex gap-4 align-items-center mb-4">

                                                <h5 class="ps-1 pt-1 pe-1">FROM: </h5>
                                                <div class="btn-group">

                                                <input name="start_date" type="date" class="form-control" value=<?php echo $start_date;?>>

                                                </div>

                                                <h5 class="ps-1 pt-1 pe-1">TO: </h5>
                                                <div class="btn-group">
                                                    <input name="end_date" type="date" class="form-control m-1" value=<?php echo $end_date;?>>
                                                    <?php if ($_SESSION['user_type'] == "Administrator") { ?>
                                                        <select name="searchbox" id="_dm-vCustomAccountStatus" class="form-select" required="" selected="0">
                                                            <option value="0">Choose User ID</option>
                                                            <?php foreach($user_ids as $item){ ?>
                                                                <option value=<?php echo$item['id'];?>><?php echo $item['id'] . "-". $item['last_name']?></option>
                                                            <?php }?>
                                                            
                                                        </select>
                                                        
                                                    <!-- <input name="searchbox" type="text" class="form-control m-1"> -->
                                                    <?php }?>
                                                    <button class="btn btn-info btn-sm  m-1" type="submit" name="search">Search</button>
                                                </div>
                                            </div>
                                            
                                            </form>
                                            
                                            <div class="table-responsove">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                        <th class="text-center">Designation</th>
                                                        <th>Name</th>
                                                        <th class="text-center">User ID</th>
                                                        <th>Date Filed</th>
                                                        <th>Time In</th>
                                                        <th>Time Out</th>
                                                        <th>Task</th>
                                                        <!-- <th>Task Status</th> -->
                                                        <th>College</th>
                                                        </tr>
                                                    </thead>
                                                   
                                                    <tbody>
                                                        <?php foreach ($attendance_data as $item) {
                                                            ?>
                                                        <tr>
                                                            
                                                            <td><?php echo $item['designation_name'];?></td>
                                                            <td><?php echo $item['first_name'] . " " . $item['last_name'];?></td>
                                                            <td><?php echo $item['user_id'];?></td>
                                                            <td><span class="text-muted"><i class="demo-pli-clock"></i>
                                                                    </span><?php echo $item['date_attended'];?></td>
                                                            <td><?php echo $item['timeins']?></td>
                                                            <td><?php echo $item['timeouts']?></td>
                                                            <td><?php foreach (json_decode($item['task_description'],1) as $task) {
                                                             echo $task['task_name'] . " - "  . $task['status'] . "<br>";
                                                            } ?></td>
                                                            <!-- <td><a class="btn-link" href="#"> Link to Form & File/s </a></td>
                                                            </td>
                                                            <td class="fs-5">
                                                                <div class="badge d-block bg-success">Pending</div>
                                                            </td> -->
                                                            <td><?php echo $item['department_name']?></td>
                                                        </tr>
                                                        <?php
                                                        }?>
                                                    </tbody>
                                                </table>

                                                <ul class="pagination justify-content-center">
                                                    <li class="page-item disabled">
                                                        <a class="page-link">Previous</a>
                                                    </li>
                                                    <li class="page-item active" aria-current="page">
                                                        <span class="page-link">1</span>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item disabled"><a class="page-link" href="#">...</a>
                                                    </li>
                                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                                    <li class="page-item">
                                                        <a class="page-link" href="#">Next</a>
                                                    </li>
                                                </ul>

                                            </div>
                                            <!-- END OF SOR TABLE -->
                                            
                                        </div>
                                    </div>
                                </div>





                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- END OF SUMMARY OF REPORTS TABLE -->


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