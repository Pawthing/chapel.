<?php
session_start();
// if(isset($_SESSION['authenticated']))
// {
//     $_SESSION['status'] = "You are already Logged In";
//     header('Location: dashboard_blue.php');
//     exit(0);
// }


$page_title = "Login Form";
include('include/header.php');
// include('include/navbar.php');
?>
<style type="text/css">
    
*{
    text-decoration: white;
}
body {
    display: absolute;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url("img/bgchapel.jpg") no-repeat;
    background-size: cover;
    background-position: center;
}
.navbar{
    background: transparent; /*#f1b04c;*/
}
.container {
    justify-content: center;
    align-items: center;
}

.navbar-brand{
    color: white;
}
.navbar-nav a{
    color: white;
}
.row .col-md-12{
    color: #f1b04c;
}
.img-icon {
    width: 75px;
}
h5{
    color: #f96d00;
}
.btn{
   width: 100%;
   border-radius: 5px;
   padding:10px 30px;
   color:var(--white);
   display: block;
   text-align: center;
   cursor: pointer;
   font-size: 20px;
   margin-top: 10px;
}

.btn{
   background-color: var(--blue);
}

.btn:hover{
   background-color: var(--blue);
}
</style>

 <div class="bg-transparent"> <!--<div class="bg-dark"> -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container-fluid">
                <h2>
                <a href="index.php"><img class="img-icon"src="img/1.png" alt=""></a>
                </h2>
                <a class="navbar-brand" href="#">San Lorenzo Diakono Chapel</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link" href="/chapelupdate104/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <!-- <a class="nav-link" href="dashboard.php">Dashboard</a> -->
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="register_admin.php">Register</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="login_admin.php">Login</a>
                    </li>
                </ul>

                </div>
            </div>
            </nav>
        </div>
    </div>
</div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">

                    <?php
                        if(isset($_SESSION['status']))
                        {
                            ?>
                            <div class="alert alert-success">
                                <h5><?= $_SESSION['status']; ?></h5>
                            </div>
                            <?php
                            unset($_SESSION['status']);
                        }
                    ?>

                <div class="card shadow">
                    <div class="card-header">
                        <h5 align="center">Login</h5>
                    </div>
                    <div class="card-body">

                        <form action="logincode_admin.php" method="POST" enctype="multipart/form-data">

                            <div class="form-group mb-1">
                                <label for="">Email Address</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group mb-1">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <!-- <a href="#">Forgot Password?</a> -->
                            Did not receive your Verification Email? <a href="resend-email-verification_admin.php">Resend</a>
                            <div class="form-group">
                                <button type="submit" name="login_now_btn" class="btn btn-primary">Login Now</button>
                            </div>
                        </form>
                        <p align="center">Don't have any account? <a href="register_admin.php">register now</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('include/header.php'); ?>