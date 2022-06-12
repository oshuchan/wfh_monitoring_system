<?php 
define("TITLE", "Dashboard | CCIT WFH Attendance Monitoring System");
include('connection/dbconnection.php');
include('data/indexController.php');
include('data/attendanceController.php');
include('data/userController.php');
include('includes/header.php');
include('connection/checklogin.php');
set_page("dashboard.php");
$searchbox = 0;
$user_ids = getUsers();
$start_date = date('Y-m-01');
$end_date = date('Y-m-t');
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

// $test = attendance_exists($_SESSION['id'], date("Y-m-d"));
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

                    <h1 class="page-title mb-0 mt-2">DASHBOARD</h1>

                    <p class="lead">
                        CCIT Work From Home Attendance Monitoring System
                    </p>

                </div>

            </div>

            <div class="content__boxed">
                <div class="content__wrap">
                    <div class="card text-center mb-4 col-xl-8 offset-xl-2">
                        <div class="card-header">Attendance</div>
                        <div class="card-body">
                        <!-- <p style="color:red"><?php echo $_SESSION['department_name'];?></p> -->
                            <!-- TIME IN/OUT BUTTON -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card bg-success text-white overflow-hidden mb-3">
                                        <a class="card bg-success text-white overflow-hidden mb-3 align-items-center"
                                            href="timein.php">
                                            <div class="p-3 pb-10">
                                                <h3 class="mb-6"><i
                                                        class="psi-time-backup text-reset text-opacity-75 fs-6 me-2"></i>
                                                    Time In</h3>

                                            </div>
                                        </a>
                                    </div>

                                </div>
                                <div class="col-sm-6">
                                    <div class="card bg-info text-white overflow-hidden mb-3">
                                        <a class="card bg-info text-white overflow-hidden mb-3 align-items-center"
                                            href="timeout.php">
                                            <div class="p-3 pb-10">
                                                <h3 class="mb-6"><i
                                                        class="psi-overtime text-reset text-opacity-75 fs-6 me-2"></i>
                                                    Time Out</h3>

                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content__boxed">
                    <div class="content__wrap">
                        <div class="card text-center mb-4 col-xl-8 offset-xl-2">
                            <div class="card-header">
                                <?php if ($_SESSION['user_type'] == "Administrator") {echo "Summary Of Reports";} else {echo "Log Entries";} ?></div>
                            <div class="card-body">
                            <!-- <?php 
                                echo $test;
                            ?> -->
                                <div class="card">
                                    <div class="card-header mb-4 mb-3">
                                        <div class="row">
                                            <form action="dashboard.php" method="post">
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

                                            
                                            <!-- END : Left toolbar -->

                                            <!-- Right Toolbar -->
                                            <!-- <div
                                                class="col-md-6 d-flex gap-1 align-items-center justify-content-md-end mb-3">
                                                <div class="form-group">
                                                    <input type="text" placeholder="Search..." class="form-control"
                                                        autocomplete="off">
                                                </div>
                                                <div class="btn-group">
                                                    <button class="btn btn-icon btn-outline-light"><i
                                                            class="demo-pli-download-from-cloud fs-5"></i></button>
                                                    <div class="btn-group dropdown">
                                                        <button
                                                            class="btn btn-icon btn-outline-light dropdown-toggle dropdown-toggle-split"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <span class="visually-hidden">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item" href="#">Export as PDF</a></li>
                                                            <li><a class="dropdown-item" href="#">Export as Word</a>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!-- END : Right Toolbar -->


                                            <!-- SOR TABLE -->
                                            <div class="table-responsove">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Designation</th>
                                                            <th>Name</th>
                                                            <th>Date Filed</th>
                                                            <th>Time In</th>
                                                            <th>Time Out</th>
                                                            <!-- <th>Task Checked</th> -->
                                                            <th>Task</th>
                                                            <th>College</th>
                                                        </tr>
                                                    </thead>
                                                   
                                                    <tbody>
                                                        <?php foreach ($attendance_data as $item) {
                                                            ?>
                                                        <tr>
                                                            <td><?php echo $item['designation_name'];?></td>
                                                            <td><?php echo $item['first_name'] . " " . $item['last_name'];?></td>
                                                            <td><span class="text-muted"><i class="demo-pli-clock"></i>
                                                                    </span><?php echo $item['date_attended'];?></td>
                                                            <td><?php echo $item['timeins']?></td>
                                                            <td><?php echo $item['timeouts']?></td>
                                                            <td><?php foreach (json_decode($item['task_description']) as $key) {
                                                                echo $key->task_name . " - " . $key->status . "<br>";
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

            <?php include("includes/footer_links.php");?>


        </section>

        <?php include("includes/nav.php");?>

</body>
<?php 
include('includes/footer.php'); 
?>