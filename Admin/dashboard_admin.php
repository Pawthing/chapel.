<?php

include '../dbcon.php';
session_start();
$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login_admin.php');
   exit();
};

if(!isset($_SESSION['member_name'])){
    header('location:login_admin.php');
    exit();
 };

if(isset($_GET['logout'])){
   unset($admin_id);
   session_destroy();
   header('location:login_admin.php');
}
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../style/style.css">
    <title>Admin Dashboard Site</title>
</head>
<body>
    
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="./dashboard_admin.php" class="brand"><i class='bx bxs-church icon'></i>Admin Dashboard</a>
        <ul class="side-menu">
            <li><a href="./dashboard_admin.php" class="active"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
            <li class="divider" data-text="main">Main</li>

            <li><a href="#"><i class='bx bx-qr-scan icon'></i> QR Code Attendance <i class='bx bx-chevron-right icon-right'></i></a>
                <ul class="side-dropdown">
                    <li><a href="att_choir.php"><i class='bx bxs-user-check icon'></i>Choir</a></li>
                    <li><a href="att_comi.php"><i class='bx bxs-user-check icon'></i>COMI</a></li>
                    <li><a href="att_knights.php"><i class='bx bxs-user-check icon'></i>Knights</a></li>
                    <li><a href="att_leccom.php"><i class='bx bxs-user-check icon'></i>LecCom</a></li>
                    <li><a href="att_multimedia.php"><i class='bx bxs-user-check icon'></i>Multimedia</a></li>
                    <li><a href="att_usherette.php"><i class='bx bxs-user-check icon'></i>Usherettes</a></li>
                </ul>
            </li> 
            <li><a href="qr_index_altar-servers.php"><i class="bx bxs-check-circle icon"></i> Attendance Monitoring</a></li>
            <li><a href="#"><i class="bx bxs-shield-plus icon"></i>Member Points</a></li>
            <li><a href="calendar_admin.php"><i class="bx bxs-calendar icon"></i>Chapel Calendar</a></li>
            <li><a href="#"><i class="bx bxs-pin icon"></i> Organization Schedule</a></li>
            <!-- <li><a href="#"><i class="bx bx-list-ol icon"></i> Chapel Rules</a></li> -->
            <li><a href="./heatmap.php"><i class="bx bxs-map icon"></i>Heatmap</a></li>
            <li><a href="./feedback_admin.php"><i class="bx bxs-message icon"></i>Feedback</a></li>
            <!-- <li class="divider" data-text="table and forms">Table and forms</li><BR></BR>

            <li><i class="bx bxs-table icon"></i> Tables</li>
            <li>
                <a href="#"><i class="bx bxs-notepad icon"></i> Forms <i class="bx bxs-chevron-right icon-right"></i></a>
                <ul class="side-dropdown">
                    <li><a href="#"><i class="bx bxs-map icon"></i>Heatmap</a></li>
                    <li><a href="feedback.php"><i class="bx bxs-message icon"></i>Feedback</a></li>
                </ul>
            </li> -->
        </ul>
        <!-- <div class="ads">
            <div class="wrapper">
                <a href="#" class="btn-upgrade">Upgrade</a>
                <p>Become a <span>PRO</span> member and enjoy <span>All Features</span></p>
            </div>
        </div> -->
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
                <span class="badge">5</span>
            </a>
            <a href="#" class="nav-link">
                <i class='bx bxs-message-square-dots'></i>
                <span class="badge">8</span>
            </a> -->
            <span class="divider"> </span>
            <!-- <a href="#" class="nav-link">
                <h5>ADMIN</h5>
            </a> -->
            <!-- <div class="profile">
                <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8cGVvcGxlfGVufDB8fDB8fHww" alt="">
                <ul class="profile-link">
                    <li><a href="profile_admin.php"><i class='bx bxs-user-circle icon'></i> Profile </a></li>
                    <li><a href="#"><i class='bx bxs-cog'></i> Settings </a></li>
                    <li><a href="../logout.php"><i class='bx bxs-log-out-circle'></i> Logout </a></li>
                </ul>
            </div> -->
            <a href="profile_admin.php" class="nav-link">
            <h4><b> 
            <?php
                try {
                    $admin_id = $_SESSION['admin_id']; 

                    // Prepare and execute the query
                    $select = $pdo->prepare("SELECT * FROM tbl_admin WHERE id = :admin_id");
                    $select->execute([':admin_id' => $admin_id]);

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
                        echo '<img src="../images/default-avatar.png">';
                    }else{
                        echo '<img src="../uploaded_img/'.$fetch['image'].'">';
                    }
                ?>
                <ul class="profile-link">
                    <li><a href="profile_admin.php"><i class='bx bxs-user-circle icon'></i> Profile </a></li>
                    <!-- <li><a href="#"><i class='bx bxs-cog'></i> Settings </a></li> -->
                    <?php if(!isset($_SESSION['authenticated'])) : ?>
                    <li><a href="../logout_admin.php"><i class='bx bxs-log-out-circle'></i> Logout </a></li>
                    <?php endif ?>
                </ul>
            </div>
         </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <h1 class="title">Dashboard</h1>
            <!-- <ul class="breadcrumbs">
                <li><a href="#">Home</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Dashboard</a></li>
            </ul> -->
            <h1 class="title" align=center>Organizations (Altar Servers)</h1>
            <div class="info-data">
                <div class="card">
                    <div class="head">
                        <div>
                            <h2>10</h2>
                            <p>Choir</p>
                        </div>
                        <!-- <i class='bx bx-trending-down icon down'></i>  -->
                        <i class='bx bxs-user-circle icon'></i> 
                    </div>
                    <!-- <span class="progress" data-value="60%"></span> -->
                    <!-- <span class="label">60%</span> -->
                </div>
                <div class="card">
                    <div class="head">
                        <div>
                            <h2>5</h2>
                            <p>COMI</p>
                        </div>
                        <i class='bx bxs-user-circle icon'></i> 
                    </div>
                    <!-- <span class="progress" data-value="75%"></span> -->
                    <!-- <span class="label">75%</span> -->
                </div>
                <div class="card">
                    <div class="head">
                        <div>
                            <h2>4</h2>
                            <p>Knights</p>
                        </div>
                        <i class='bx bxs-user-circle icon'></i> 
                    </div>
                    <!-- <span class="progress" data-value="80%"></span> -->
                    <!-- <span class="label">80%</span> -->
                </div>
                <div class="card">
                    <div class="head">
                        <div>
                            <h2>4</h2>
                            <p>LecCom</p>
                        </div>
                        <i class='bx bxs-user-circle icon'></i> 
                    </div>
                    <!-- <span class="progress" data-value="80%"></span> -->
                    <!-- <span class="label">80%</span> -->
                </div>
                <div class="card">
                    <div class="head">
                        <div>
                            <h2>3</h2>
                            <p>Multimedia</p>
                        </div>
                        <i class='bx bxs-user-circle icon'></i> 
                    </div>
                    <!-- <span class="progress" data-value="70%"></span> -->
                    <!-- <span class="label">70%</span> -->
                </div>
                <div class="card">
                    <div class="head">
                        <div>
                            <h2>3</h2>
                            <p>Usherettes</p>
                        </div>
                        <i class='bx bxs-user-circle icon'></i> 
                    </div>
                    <!-- <span class="progress" data-value="90%"></span> -->
                    <!-- <span class="label">90%</span> -->
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
                <!--<div class="content-data">
                    <div class="head">
                        <h3>Chatbox</h3>
                        <div class="menu">
                            <i class='bx bx-dots-horizontal-rounded icon'></i>
                            <ul class="menu-link">
                                <li><a href="#">Edit</a></li>
                                <li><a href="#">Save</a></li>
                                <li><a href="#">Remove</a></li>
                            </ul> 
                        </div>
                    </div>
                     <div class="chat-box">
                        <p class="day"><span>Today</span></p>
                        <div class="msg">
                            <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8cGVvcGxlfGVufDB8fDB8fHww" alt="">
                            <div class="chat">
                                <div class="profile">
                                    <span class="username">Mark Anthony</span>
                                    <span class="time">18:30</span>
                                </div>
                                <p>Hello</p>
                            </div>
                        </div>
                        <div class="msg me">
                            <div class="chat">
                                <div class="profile">
                                    <span class="time">18:30</span>
                                </div>
                                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. "</p>
                            </div>
                        </div>
                        <div class="msg me">
                            <div class="chat">
                                <div class="profile">
                                    <span class="time">18:30</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente quae non voluptatibus voluptates eius!</p>
                            </div>
                        </div>
                        <div class="msg me">
                            <div class="chat">
                                <div class="profile">
                                    <span class="time">18:30</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                            </div>
                        </div>
                    </div>
                    <form action="#">
                        <div class="form-group">
                            <input type="text" placeholder="Type...">
                            <button type="submit" class="btn-send"> <i class='bx bxs-send'></i></button>
                        </div>
                    </form> 
                </div>-->
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- NAVBAR -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../js/script.js"></script>
</body>
</html>