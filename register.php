<?php
session_start();

$page_title = "Chapel Registration";
include('include/header.php');
// include('include/navbar.php');
?>

<style>
    :root{
   --blue:#3498db;
   --dark-blue:#2980b9;
   --red:#e74c3c;
   --dark-red:#c0392b;
   --black:#333;
   --white:#fff;
   --light-bg:#eee;
   --box-shadow:0 5px 10px rgba(0,0,0,.1);
}
*{
    text-decoration: white;
}
.navbar{
    background: transparent;/*#f1b04c;
    /*  #dc6601
        #e27602
        #e88504
        #ec9006
        #ee9f27
        #f1b04c */
}
body {
    display: absolute;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: url("img/bgchapel.jpg") no-repeat;
    background-size: cover;
    background-position: center;
    font-family: poppins;
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
.img-icon{
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Data Table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
</head>
<body>

<div class="bg-transparent">
<div class="container">
    <div class="row">
        <div class="col-md-12">
         <nav class="navbar navbar-expand-lg"> <!-- <nav class="navbar navbar-expand-lg navbar-dark"> -->
            <div class="container-fluid">
            <h2>
           <a href="index.php"><img class="img-icon"src="img/1.png" alt=""></a>
            </h2>
                <a class="navbar-brand" href="index.php">San Lorenzo Diakono Chapel</a>

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
            <div class="col-md-4">
                <!--<div class="alert">-->
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
                <!--</div>-->
                <div class="card shadow">
                    <div class="card-header">
                        <h5 align="center">Registration</h5>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                        <!-- <form action="./endpoint_qrcode/add-member.php"> -->
                            <div class="form-group mb-1">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Fullname" required>
                            </div>
                            <div class="form-group mb-1">
                                <label for="">Phone Number</label>
                                <input type="number" name="phone" class="form-control" maxlength="11" placeholder="+63" required >
                                
                            </div>
                            <div class="form-group mb-1">
                                <label for="">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                            </div>
                            <div class="form-group mb-1">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                            </div>
                            <!-- <div class="form-group mb-1">
                                <label for="">Confirm Password</label>
                                <input type="password" name="cpassword" class="form-control" placeholder="Confim Password" required>
                            </div>  -->
                                <select name="org_name" required>
                                    <option value="">-Select Organization-</option>
                                    <option value="Choir">Choir</option>
                                    <option value="COMI">COMI</option>
                                    <option value="Knights">Knights</option>
                                    <option value="LecCom">LecCom</option>
                                    <option value="Multimedia">Multimedia</option>
                                    <option value="Usherette">Usherette</option>
                                </select>
                                <br><br>
                                <p>Profile Picture:</p>
                            <div class="form-group mb-1">
                                <input type="file" name="image" class="form-control" accept="image/jpg, image/jpeg, image/png">
                            </div> 
                            <!--<input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">-->
                            <button type="submit" name="register_btn" class="btn btn-primary form-control qr-generator" onclick="generateQrCode()">Register Now </button>
                            <div class="form-group mb-1">
                                 <p align="center">Already have an account? <a href="login.php">login now</a></p>
                            </div>
                            <div class="qr-con text-center" style="display: none;">
                            <input type="hidden" class="form-control" id="generateCode" name="generate_code">
                        </div>
                        <!-- </form> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- Bootstrap JS -->
 <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    <!-- Data Table -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

    <script>
        function generateRandomCode(length) {
            const characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            let randomString = '';

            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * characters.length);
                randomString += characters.charAt(randomIndex);
            }

            return randomString;
        }

        function generateQrCode() {
            const qrImg = document.getElementById('qrImg');

            let text = generateRandomCode(10);
            $("#generateCode").val(text);

            if (text === "") {
                alert("Please enter text to generate a QR code.");
                return;
            } else {
                const apiUrl = `https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=${encodeURIComponent(text)}`;

                qrImg.src = apiUrl;
                document.getElementById('memberName').style.pointerEvents = 'none';
                document.getElementById('orgName').style.pointerEvents = 'none';
                // document.querySelector('.modal-close').style.display = '';
                document.querySelector('.qr-con').style.display = '';
                document.querySelector('.qr-generator').style.display = 'none';
            }
        }
    </script>

</body>
</html>

<?php include('include/header.php'); ?>

