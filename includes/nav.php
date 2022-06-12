
<?php include('./data/user_menu.php');?>
<header class="header">
            <div class="header__inner">
                <!-- Brand -->
                <div class="header__brand">
                    <div class="brand-wrap">

                        <!-- Brand logo -->
                        <a href=<?php echo $_SESSION['page'];?> class="brand-img stretched-link">
                            <img src="./images/logo/logo.png" alt="Faith Logo" class="Faith logo" width="40"
                                height="40">
                        </a>

                        <!-- Brand title -->
                        <div class="brand-title">FAITH</div>

                    </div>
                </div>
                <!-- End - Brand -->

                <div class="header__content">

                    <!-- Content Header - Left Side: -->
                    <div class="header__content-start">

                        <!-- Navigation Toggler -->
                        <button type="button" class="nav-toggler header__btn btn btn-icon btn-sm"
                            aria-label="Nav Toggler" onclick="changeContentHeader()">
                            <i class="demo-psi-view-list"></i>
                        </button>

                        <script>
                            function changeContentHeader() {
                                document.querySelector("#content > .content__header").classList.toggle("rounded-0");
                            }

                        </script>


                    </div>
                    <!-- End - Content Header - Left Side -->

                    <!-- Content Header - Right Side: -->
                    <div class="header__content-end">

                        <!-- User dropdown -->
                        <div class="dropdown">

                            <!-- Toggler -->
                            <button class="header__btn btn btn-icon btn-sm" type="button" data-bs-toggle="dropdown"
                                aria-label="User dropdown" aria-expanded="false">
                                <i class="demo-psi-male"></i>
                            </button>

                            <!-- User dropdown menu -->
                            <div class="dropdown-menu dropdown-menu-end w-md-250px">

                                <!-- User dropdown header -->
                                <div class="d-flex align-items-center border-bottom px-3 py-2">
                                    <div class="flex-shrink-0">
                                        <img class="img-sm rounded-circle" src="./images/pfp/pfp-sample.jpg"
                                            alt="Profile Picture" loading="lazy">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-0"><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']?></h5>
                                        <span class="text-muted fst-italic"><?php echo $_SESSION['email']?></span>
                                    </div>
                                </div>


                                <!-- User menu link -->
                                <form method="post" action=<?php echo $_SESSION['page'];?> >
                                <div class="list-group list-group-borderless">
                                    <button type="submit" name="settings" class="list-group-item list-group-item-action">
                                        <i class="demo-pli-gear fs-5 me-2"></i> Account Settings
                                    </button>
                                    <button type="submit" name="lockscreen" class="list-group-item list-group-item-action mt-auto">
                                        <i class="demo-pli-computer-secure fs-5 me-2"></i> Lock screen
                                    </button>
                                    <button type="submit" name="logout" class="list-group-item list-group-item-action">
                                        <i class="demo-pli-unlock fs-5 me-2"></i> Logout
                                    </button>
                                </div>
                                </form>



                            </div>
                        </div>
                        <!-- End - User dropdown -->

                    </div>
                </div>
            </div>
        </header>
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - HEADER -->

        

        <!-- MAIN NAVIGATION -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <nav id="mainnav-container" class="mainnav">
            <div class="mainnav__inner">

                <!-- Navigation menu -->
                <div class="mainnav__top-content scrollable-content pb-5">

                    <!-- Profile Widget -->
                    <div class="mainnav__profile mt-3 d-flex3">

                        <div class="mt-2 d-mn-max"></div>

                        <!-- Profile picture  -->
                        <div class="mininav-toggle text-center py-2">
                            <img class="mainnav__avatar img-md rounded-circle border" src="./images/pfp/pfp-sample.jpg"
                                alt="Profile Picture">
                        </div>

                        <div class="mininav-content collapse d-mn-max">
                            <div class="d-grid">

                                <!-- User name and position -->
                                <span class="d-flex justify-content-center align-items-center">
                                    <h6 class="mb-0" style="text-transform:uppercase"><?php echo $_SESSION['lastname'].', '.$_SESSION['firstname'] ;?></h6>
                                </span>

                                <small
                                    class="text-muted d-flex justify-content-center align-items-center"><?php echo $_SESSION['user_type'];?></small>

                                <small class="text-muted d-flex justify-content-center align-items-center"><?php echo $_SESSION['department_name'];?></small>
                                <small class="text-muted d-flex justify-content-center align-items-center"><?php echo $_SESSION['designation_name'];?></small>
                                </span>
                            </div>
                        </div>

                    </div>
                    <!-- End - Profile widget -->

                    <!-- Navigation Category -->
                    <div class="mainnav__categoriy py-3">
                        <h6 class="mainnav__caption mt-0 px-3 fw-bold">Attendance</h6>
                        
                        <ul class="mainnav__menu nav flex-column">

                            <!-- Regular menu link -->
                            <?php foreach ($nav_attendance_links as $item) {
                                
                            ?>
                            <li class="nav-item">
                                <a href=<?php echo $item['link']?> class="nav-link mininav-toggle"><i
                                        class=<?php echo $item['icon_class']?>></i>
                                    <span class="nav-label mininav-content ms-1"><?php echo $item['title']?></span>
                                </a>
                            </li>

                            <?php }?>
                            <!-- END : Regular menu link -->

                        </ul>
                    </div>
                    <!-- END : Navigation Category -->


                    <!-- Manage Users Category -->
                    <?php if($_SESSION['user_type'] == "Administrator"){?>
                    <div class="mainnav__categoriy py-3">
                        <h6 class="mainnav__caption mt-0 px-3 fw-bold">Manage Users</h6>
                        <ul class="mainnav__menu nav flex-column">

                        <?php foreach ($nav_manage_users_links as $item) {?>
                            <li class="nav-item">
                                <a href=<?php echo $item['link']?> class="nav-link mininav-toggle"><i
                                        class=<?php echo $item['icon_class']?>></i>
                                    <span class="nav-label mininav-content ms-1"><?php echo $item['title']?></span>
                                </a>
                            </li><?php }?>
                        </ul>
                    </div>
                    
                    <!-- END : Manage Users Category -->

                    <!-- Manage Task Category -->
                    <div class="mainnav__categoriy py-3">
                        <h6 class="mainnav__caption mt-0 px-3 fw-bold">Manage Task</h6>
                        <ul class="mainnav__menu nav flex-column">
                            <?php foreach ($nav_manage_task_links as $item) {?>
                                <li class="nav-item">
                                    <a href=<?php echo $item['link']?> class="nav-link mininav-toggle"><i
                                            class=<?php echo $item['icon_class']?>></i>
                                        <span class="nav-label mininav-content ms-1"><?php echo $item['title']?></span>
                                    </a>
                                </li><?php }?>


                            
                        </ul>
                    </div>
                    <?php }?>
                    <!-- END : Manage Task Category -->
        </div>