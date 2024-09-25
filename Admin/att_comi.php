<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../style/style.css">
    <title>Attendance - COMI</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

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

        .attendance-container {
            height: 90%;
            width: 90%;
            border-radius: 20px;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.8);
        }

        .attendance-container > div {
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            border-radius: 10px;
            padding: 30px;
        }

        .attendance-container > div:last-child {
            width: 64%;
            margin-left: auto;
        }

         /* scroll table  09/17/2024/Tue Continuation...*/
        table {
            border: 1px solid black;
            border-collapse: separate;
            border-spacing: 0px;
        }

        th {
            position: sticky;
            top: 0px;
            background-color: #1775F1;
            color: black;
        }

        .table-wrapper {
            max-height: 445px;
            overflow-y: scroll;
            margin: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
        }
    </style>
</head>
<body>
    
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand"><i class='bx bxs-church icon'></i>Admin Dashboard</a>
        <ul class="side-menu">
            <li><a href="dashboard_admin.php"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
            <li class="divider" data-text="main">Main</li>
            <li>
                <a href="#" class="active"><i class='bx bx-qr-scan icon'></i> QR Code Attendance <i class='bx bx-chevron-right icon-right'></i></a>
                <ul class="side-dropdown show">
                    <li><a href="att_choir.php"><i class='bx bxs-user-check icon'></i>Choir</a></li>
                    <li><a href="att_comi.php"><i class='bx bxs-user-check icon'></i><b>COMI</b></a></li>
                    <li><a href="att_knights.php"><i class='bx bxs-user-check icon'></i>Knights</a></li>
                    <li><a href="att_leccom.php"><i class='bx bxs-user-check icon'></i>LecCom</a></li>
                    <li><a href="att_multimedia.php"><i class='bx bxs-user-check icon'></i>Multimedia</a></li>
                    <li><a href="att_usherette.php"><i class='bx bxs-user-check icon'></i>Usherettes</a></li>
                </ul>
            </li> 
            <li><a href="qr_index_altar-servers.php"><i class="bx bxs-check-circle icon"></i> Attendance Monitoring</a></li>
            <li><a href="calendar_blue.php"><i class="bx bxs-calendar icon"></i>Chapel Calendar</a></li>
            <li><a href="#"><i class="bx bxs-pin icon"></i> Organization Schedule</a></li>
            <li><a href="./heatmap.php"><i class="bx bxs-map icon"></i>Heatmap</a></li>
            <li><a href="feedback_admin.php"><i class="bx bxs-message icon"></i>Feedback</a></li>
            
    </section>
    <!-- SIDEBAR -->

    <!-- NAVBAR -->
    <section id="content">
        
        <!-- MAIN -->
         <main>
         <div class="main">
        
        <div class="attendance-container row">
            <div class="qr-container col-4">
                <div class="scanner-con">
                    <h5 class="text-center">Scan your QR Code here for your attendance</h5>
                    <video id="interactive" class="viewport" width="100%">
                </div>

                <div class="qr-detected-container" style="display: none;">
                    <form action="../endpoint_qr_comi/add-attendance.php" method="POST">
                        <h4 class="text-center">Org Member QR Detected!</h4>
                        <input type="hidden" id="detected-qr-code" name="qr_code">
                        <button type="submit" class="btn btn-dark form-control">Submit Attendance</button>
                    </form>
                </div>
            </div>

            <div class="attendance-list">
                <h4 align="center">List of Present in COMI</h4>
                <div class="table-wrapper">
                <div class="table-container table-responsive">
                    <table class="table text-center table-sm" id="attendanceTable">
                        <thead class="thead">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Organization Name</th>
                            <th scope="col">Time In</th>
                            <th scope="col">Login</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            // Include the database connection file
                            include ('../dbcon.php');
                            
                            try {
                                // Prepare the SQL statement
                                $query = "SELECT * FROM tbl_att_comi LEFT JOIN users ON users.id = tbl_att_comi.tbl_member_id";
                                $stmt = $pdo->prepare($query);
                                
                                // Execute the query
                                $stmt->execute();
                                
                                // Fetch all rows from the query result
                                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                
                                foreach ($rows as $row) {
                                    // Extract data from the result
                                    if ($row['org_name'] == 'COMI') {
                                        $attendanceID = htmlspecialchars($row["tbl_attendance_id"]);
                                        $memberName = htmlspecialchars($row["name"]);
                                        $orgName = htmlspecialchars($row["org_name"]);
                                        $timeIn = htmlspecialchars($row["time_in"]);
                                        ?>
                                        <tr>
                                            <th scope="row"><?= $attendanceID ?></th>
                                            <td><?= $memberName ?></td>
                                            <td><?= $orgName ?></td>
                                            <td><?= $timeIn ?></td>
                                            <td><p>Present</p></td>
                                            <td>
                                                <div class="action-button">
                                                    <button class="btn btn-danger delete-button" onclick="deleteAttendance(<?= $attendanceID ?>)">X</button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                            } catch (PDOException $e) {
                                // Handle connection or query errors
                                echo "Error: " . $e->getMessage();
                            }

                            // Close the connection
                            $pdo = null;
                            ?>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        
        </div>

    </div>
    

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    <!-- instascan Js -->
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <script>

        
        let scanner;

        function startScanner() {
            scanner = new Instascan.Scanner({ video: document.getElementById('interactive') });

            scanner.addListener('scan', function (content) {
                $("#detected-qr-code").val(content);
                console.log(content);
                scanner.stop();
                document.querySelector(".qr-detected-container").style.display = '';
                document.querySelector(".scanner-con").style.display = 'none';
            });

            Instascan.Camera.getCameras()
                .then(function (cameras) {
                    if (cameras.length > 0) {
                        scanner.start(cameras[0]);
                    } else {
                        console.error('No cameras found.');
                        alert('No cameras found.');
                    }
                })
                .catch(function (err) {
                    console.error('Camera access error:', err);
                    alert('Camera access error: ' + err);
                });
        }

        document.addEventListener('DOMContentLoaded', startScanner);

        function deleteAttendance(id) {
            if (confirm("Do you want to remove this attendance?")) {
                window.location = "../endpoint_qr_comi/delete-attendance.php?attendance=" + id;
            }
        }
    </script>
        </main>
        <!-- MAIN -->
        
    </section>
    <!-- NAVBAR -->
</body>
</html>