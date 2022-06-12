<?php 
define("TITLE", "Timeout Submit | CCIT WFH Attendance Monitoring System");
include('connection/dbconnection.php');
include('data/indexController.php');
include('data/attendanceController.php');
include('includes/header.php');
include('data/user_menu.php');
include('connection/checklogin.php');
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
                            <a href="#" class="nav-link" data-step="finish">
                                <i class="d-block pli-data-upload fs-2 mb-2"></i>
                                <span>Submit</span>
                            </a>
                        </nav>
                        <p class="h1">You Have Successfully Timed Out</p>

                                <div class="text-center mb-3 col-xl-8 offset-xl-2">
                                Time: <input type="text" class="form-control text-center" id="currentTime" placeholder="TimeInTime" disabled="">

                                </div>

                                <div class="text-center mb-3 col-xl-8 offset-xl-2">
                                Date: <input type="text" class="form-control text-center" id="currentDate" placeholder="TimeInDate" disabled="">
                                
                                </div>
                                <a href="dashboard.php" class="btn btn-primary ms-auto" type="button">Go to Dashboard</a>
<!--                                
                        <section data-step="finish" class="text-center align-items-center">
                                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                                    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                                </svg>
                                
                            </section> -->
                             

                        </div>
                    </div>
                </div>
            <!-- END OF TIME OUT -->
            <!-- END OF FORM -->


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
