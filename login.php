<?php 
define("TITLE", "LOGIN | CCIT WFH Attendance Monitoring System");

include('connection/dbconnection.php');
include('data/indexController.php');
include('includes/header.php');
$error = "";
if(isset($_SESSION['id'])){
    header("location: dashboard.php");
}

if(isset($_POST['login']))
{
    if(isset($_SESSION['id'])){
        header("location: dashboard.php");
    } else{
        $username =  mysqli_real_escape_string($conn,$_POST['username']);
        $password =  mysqli_real_escape_string($conn,$_POST['password']);
        if($username=='' || $password=='')
        {
            $error='All fields are required';
        } else {
            $error = login($username,$password);
        }
    }

    
}


?>

<body class="" style="background-image: url('./images/background/faith-mabini.jpg');">

    <!-- PAGE CONTAINER -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div id="root" class="root front-container">

        <!-- CONTENTS -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <section id="content" class="content">
            <div class="content__boxed w-100 min-vh-100 d-flex flex-column align-items-center justify-content-center">
                <div class="content__wrap">

                
                    <!-- Login card -->
                    <div class="card shadow-lg">
                        <div class="card-body">

                            <div class="text-center">
                                <img src="./images/logo/faith-whole-logo.png" width="400"
                                height="150" alt="faith logo" loading="lazy">

                                <h1 class="h3">Account Login</h1>
                                <p>CCIT WFH Attendance Monitoring System</p>
                                <!-- <?php echo$_SESSION['id'];?> -->
                            </div>
                            <p style="text-align:center; color:red"> <?php echo $error;?></p>
                            <form action="login.php" class="mt-4" method="POST" role="form">
                                <div class="col-md-12 position-relative">
                                    <label for="username" class="form-label">Username</label>
                                    <input name="username" id="username" type="text" class="form-control" required="">
                                    <!-- <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Username is invalid.</div> -->
                                </div>

                                <div class="col-md-12 mt-3 position-relative">
                                    <label for="password" class="form-label">Password</label>
                                    <input name="password" id="password" type="password" class="form-control" required="">
                                    <!-- <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Password is invalid.</div> -->
                                </div>

                                <!-- <div class="col-md-12 mt-3 position-relative">
                                    <input type="checkbox" value="lsRememberMe" id="rememberMe"> <label for="rememberMe">Remember me</label>
                                </div> -->

                                <div class="col-12 pt-4 d-grid gap-2">
                                    <button class="btn btn-primary btn-lg" type="submit" id="login" name="login">Login</button>                                      
                                </div>

                            </form>

                            <!-- <form action="dashboard.php" class="mt-4 needs-validation" novalidate="" >
                                <div class="col-md-12 position-relative">
                                    <label for="_dm-vCustomUsername" class="form-label">Username</label>
                                    <input name="username" id="_dm-vCustomUsername" type="text" class="form-control" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Username is invalid.</div>
                                </div>

                                <div class="col-md-12 mt-3 position-relative">
                                    <label for="_dm-vCustomPassword" class="form-label">Password</label>
                                    <input name="password" id="_dm-vCustomPassword" type="password" class="form-control" required="">
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Password is invalid.</div>
                                </div>

                                <div class="col-md-12 mt-3 position-relative">
                                        <input type="checkbox" value="lsRememberMe" id="rememberMe"> <label for="rememberMe">Remember me</label>
                                </div>

                                <div class="col-12 pt-4 d-grid gap-2">
                                    <button class="btn btn-primary btn-lg" type="submit">Login</button>                                      
                                </div>

                            </form> -->

                                    

                            
                                    <div class="text-center align-items-center justify-content-between border-top pt-3 mt-3"> Don't have an account?
                                <a href="register.php" class="btn-link text-decoration-none"> Create one </a>

                                <div class="ms-3">
                                    
                                </div>

                            </div>


                        </div>
                    </div>

                    <!-- END : Login card -->

                </div>
            </div>
        </section>

        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- END - CONTENTS -->
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END - PAGE CONTAINER -->




</body>
<?php 
include('includes/footer.php'); 
?>