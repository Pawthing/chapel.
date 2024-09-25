<?php

include '../../dbcon.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
   exit();
};

if(!isset($_SESSION['member_name'])){
    header('location:login.php');
    exit(0);
 };

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
   exit();
}
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../style/style.css">
    <title>Dashboard Site</title>
    
</head>
<style>
    .img-icon {
        display: absolute;
        width: 75px;
    }
</style>
<body>
    
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand"><i class='bx bxs-church icon'></i>San Lorenzo Diakono Chapel</a>
        <ul class="side-menu">
            <li><a href="dashboard_multimedia.php" class="active"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
            <li class="divider" data-text="main">Main</li>
            <li><a href="qr_code_multimedia.php"><i class="bx bx-qr icon"></i>QR Code for Attendance</a></li>
            <li>
                <a href="att_index_multimedia.php"><i class='bx bx-qr-scan icon'></i> Attendance </a>
            </li> 
            <li><a href="calendar.php"><i class="bx bxs-calendar icon"></i>Chapel Calendar</a></li>
            <li><a href="heatmap.php"><i class="bx bxs-map icon"></i>Heatmap</a></li>
            <li><a href="feedback.php"><i class="bx bxs-message icon"></i>Feedback</a></li>
            <?php
                        if(isset($_SESSION['status']))
                        {
                            ?>
                            <div class="alert alert-success">
                                <h5><?php
                                 $_SESSION['status'];
                                 ?></h5>
                            </div>
                            <?php
                            unset($_SESSION['status']);
                        }
                    ?>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- NAVBAR -->
    <section id="content">
        <!-- NAVBAR -->
         <nav>
            <i class='bx bx-menu toggle-sidebar'></i>
            <form action="#">
                <div class="form-group">
                    <input type="text" placeholder="Search...">
                    <i class='bx bx-search icon'></i>
                </div>
            </form>
            <!-- <a href="#" class="nav-link">
                <i class='bx bxs-bell icon'></i>

            </a>
            <a href="#" class="nav-link">
                <i class='bx bxs-message-square-dots'></i>
            </a> -->
            <span class="divider"> </span>
            <a href="profile_multimedia.php" class="nav-link">
            
            <h4><b>
            <?php
                try {
                    $user_id = $_SESSION['user_id']; 

                    // Prepare and execute the query
                    $select = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
                    $select->execute([':user_id' => $user_id]);

                    // Check if the user exists
                    if ($select->rowCount() > 0) {
                        $fetch = $select->fetch(PDO::FETCH_ASSOC);
                        // Use $fetch data as needed, e.g., echoing the user's name
                        echo $fetch['name'];
                    } else {
                        echo "User not found.";
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }

                // Close the PDO connection
                $pdo = null;
            ?>
            <b></h4>
            </a>
            <div class="profile">
                <?php
                    if($fetch['image'] == ''){
                        echo '<img src="../../images/default-avatar.png">';
                    }else{
                        echo '<img src="../../uploaded_img/'.$fetch['image'].'">';
                    }
                ?>
                <ul class="profile-link">
                    <li><a href="profile_multimedia.php"><i class='bx bxs-user-circle icon'></i> Profile </a></li>
                    <!-- <li><a href="#"><i class='bx bxs-cog'></i> Settings </a></li> -->
                    <?php if(!isset($_SESSION['authenticated'])) : ?>
                    <li><a href="../../logout.php"><i class='bx bxs-log-out-circle'></i> Logout </a></li>
                    <?php endif ?>
                </ul>
            </div>
         </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <h1 class="title">Dashboard</h1>
            <h1 class="title" align=center><p><?php echo $_SESSION['user_type'];?>'s Organization </p></h1>
            <div class="info-data">
                <div class="card">
                    <div class="head">
                        <div>
                        <h2><?php echo $_SESSION['user_id'];?></h2>
                        <p><?php echo $_SESSION['user_type'];?></p>
                        </div>
                        <i class='bx bxs-user-circle icon'></i> 
                    </div>
                    <!-- <span class="progress" data-value="70%"></span>
                    <span class="label">70%</span> -->
                </div>
            </div>
            <div class="data">
                <div class="content-data">
                    <div class="head">
                        <h3>Ranking Analysis</h3>
                        <div class="menu">
                            <i class='bx bx-dots-horizontal-rounded icon'></i>
                            <ul class="menu-link">
                                <li><a href="#">Edit</a></li>
                                <li><a href="#">Save</a></li>
                                <li><a href="#">Remove</a></li>
                            </ul> 
                        </div>
                    </div>
                    <div class="chart">
                        <div id="chart"></div>
                    </div>
                </div>
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- NAVBAR -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../../js/script.js"></script>
</body>
</html>