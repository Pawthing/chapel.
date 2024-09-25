<?php
session_start();

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
</style>


<div class="container">
    <div class="row">
        <div class="col-md-12">
         <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
            <h2>
           <a href="index.php"><img class="img-icon"src="img/1.png" alt=""></a>
            </h2>
                <a class="navbar-brand" href="index.php">San Lorenzo Diakono Chapel </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link" href="/chapelupdate104/index.php">Home</a>
                    </li>
                    <?php if(!isset($_SESSION['authenticated'])) : ?>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link active" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <?php endif ?>

                    <?php if(isset($_SESSION['authenticated'])) : ?>
                    <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <?php endif ?>
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
            <div class="col-md-5">
                    <?php
                        if(isset($_SESSION['status']))
                        {
                            ?>
                            <div class="alert alert-success">
                                <h5><?= $_SESSION['status'];?></h5>
                            </div>
                            <?php
                            unset($_SESSION['status']);
                        }
                    ?>
                <div class="card">
                    <div class="card-header">
                        <h5>Resend Email Verification</h5>
                    </div>
                    <div class="card-body">

                        <form action="resend-code.php" method="POST">
                            <div class="form-group mb-3">
                                <label>Email Address:</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email Address" required>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="resend_email_verify_btn" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>