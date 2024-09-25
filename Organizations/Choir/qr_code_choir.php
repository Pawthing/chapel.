<?php

include '../../dbcon.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
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
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }
</style>
<style>
        body {
            background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #989898;
            background-blend-mode: multiply,multiply;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 91.5vh;
        }

        .member-container {
            height: 90%;
            width: 95%;
            border-radius: 20px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
        }

        .member-container > div {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            border-radius: 10px;
            padding: 30px;
            height: 100%;
            overflow-y: scroll;
        }

        .thead{
            background-color: #1775F1;
        }
        .qrcode{
            text-align: center;
        }

        .table {
            max-height: 445px;
            overflow-y: scroll;
            text-align: center;
            margin: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            
        }

        .outer-wrapper {
            border: 1px solid black;
            box-shadow: 0px 0px 3px black;

            margin: 20px;
            max-width: fit-content;
        }
    </style>
<body>
    
    <!-- SIDEBAR -->
    <section id="sidebar">
        <!-- <h2>
        <a href="index.php"><img class="img-icon"src="img/1.png" alt="">DashboardSite</a>
        </h2> -->
        <a href="#" class="brand"><i class='bx bxs-church icon'></i>San Lorenzo Diakono Chapel</a>
        <ul class="side-menu">
            <li><a href="dashboard_choir.php"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
            <li class="divider" data-text="main">Main</li>
            <li><a href="qr_code_choir.php" class="active"><i class="bx bx-qr icon"></i>QR Code Attendance</a></li>
            <li>
                <a href="att_index_choir.php"><i class='bx bx-qr-scan icon'></i> Attendance </a>
            </li> 
            <li><a href="calendar_blue.php"><i class="bx bxs-calendar icon"></i>Chapel Calendar</a></li>
            <li><a href="heatmap.php"><i class="bx bxs-map icon"></i>Heatmap</a></li>
            <li><a href="feedback.php"><i class="bx bxs-message icon"></i>Feedback</a></li>
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
            <!-- <li><a href="#"><i class="bx bxs-chart icon"></i> Charts</a></li>
            <li><a href="#"><i class="bx bxs-widget icon"></i> Widgets</a></li> -->
            <!-- <li class="divider" data-text="table and forms">Table and forms</li><BR></BR>
            <li><i class="bx bxs-table icon"></i> Tables</li>
            <li>
                <a href="#"><i class="bx bxs-notepad icon"></i> Forms <i class="bx bxs-chevron-right icon-right"></i></a>
                <ul class="side-dropdown">
                    <li><a href="#"><i class="bx bxs-map icon"></i>Heatmap</a></li>
                    <li><a href="feedback_blue.php"><i class="bx bxs-message icon"></i>Feedback</a></li>
                </ul>
            </li> -->
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
                <span class="badge">5</span>
            </a>
            <a href="#" class="nav-link">
                <i class='bx bxs-message-square-dots'></i>
                <span class="badge">8</span>
            </a> -->

            <span class="divider"> </span>
            <a href="profile_choir.php" class="nav-link">
            <h4><b>
            <?php
                try {
                    // Prepare the SQL query
                    $selectQuery = "SELECT * FROM users WHERE id = :user_id";
                    $stmt = $pdo->prepare($selectQuery);
                    
                    // Bind the parameter safely
                    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

                    // Execute the query
                    $stmt->execute();

                    // Check if the user exists and fetch data
                    if ($stmt->rowCount() > 0) {
                        $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo htmlspecialchars($fetch['name']); // Safely output the name
                    }
                } catch (PDOException $e) {
                    // Handle any potential errors
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
                    <li><a href="profile_choir.php"><i class='bx bxs-user-circle icon'></i> Profile </a></li>
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
    <div class="main">
        
    <div class="member-container">
        <div class="member-list">
                <table class="table text-center table-sm" id="memberTable">
                    <thead class="thead">
                        <tr>
                            <th scope="col">Name</th><br>
                            <th scope="col">Organization Name</th>
                        </tr>
                    </thead>
                <tbody>
                <?php 
                    include ('../../dbcon.php');

                    try {
                        $pdo = new PDO($dsn, $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        // Prepare the SQL query
                        $query = "SELECT * FROM users WHERE id = :user_id";
                        $stmt = $pdo->prepare($query);
                        
                        // Bind the parameter
                        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

                        // Execute the query
                        $stmt->execute();

                        // Fetch and iterate over the result set
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $memberID = htmlspecialchars($row["id"]); // Ensure output is safe
                            $memberName = htmlspecialchars($row["name"]);
                            $orgName = htmlspecialchars($row["org_name"]);
                            $qrCode = htmlspecialchars($row["generate_code"]);
                            ?>
                            <tr>
                                <td id="memberName-<?= $memberID ?>"><?= $memberName ?></td>
                                <td id="orgName-<?= $memberID ?>"><?= $orgName ?> </td>
                            </tr>
                            <?php
                        }
                    } catch (PDOException $e) {
                        // Handle any potential errors
                        echo "Error: " . $e->getMessage();
                    }

                    // Close the PDO connection
                    $pdo = null;
                ?>    
                </tbody>
                </table>
                <br><p align="center"><?= $memberName ?>'s QR Code:</p><br>
                <div class="qrcode">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= $qrCode ?>" alt="" width="300">
                </div>
                            
            </div>
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