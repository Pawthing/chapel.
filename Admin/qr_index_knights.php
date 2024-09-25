<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Monitoring</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/qr_index.css">
    
</head>
<style>
        .navbar {
            background-color: #1775F1;
        }
        .navbar .nav-link, .navbar-brand{
            color:black;
        }
        .thead{
            background-color: #1775F1;
            position: sticky;
            top: 0px;
        }
        .nav-item:hover{
            background-color: beige;
        }
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

        .outer-wrapper {
            border: 1px solid black;
            box-shadow: 0px 0px 3px black;

            margin: 20px;
            max-width: fit-content;
        }
        .nav-item1, .nav-item2, .nav-item3, .nav-item4, .nav-item5, .nav-item6{
            background-color: white;
        }
</style>
<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand ml-3" href="#">Attendance Monitoring</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./qr_index_altar-servers.php"> Altar Servers <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./qr_index_choir.php"> Choir <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./qr_index_comi.php"> COMI <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item1">
                    <a class="nav-link" href="./qr_index_knights.php"> Knights <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./qr_index_leccom.php"> LecCom <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./qr_index_multimedia.php"> Multimedia <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./qr_index_usherette.php"> Usherettes <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./dashboard_admin.php"><i class='bx bxs-dashboard icon'></i>&nbsp;Dashboard</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="main">
        
        <div class="attendance-container row">
            <div class="attendance-list"> 
                <h2 align="center">List of Presents in Knights</h2>
                <!-- <div class="outer-wrapper"> -->
                <div class="table-wrapper">
                <div class="table-container table-responsive">
                    <table class="table text-center table-sm" id="attendanceTable">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Organization Name</th>
                            <th>Time In</th>
                            <th>Login</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- KNIGHTS -->
                        <?php
                                // Include the database connection file
                                include ('../dbcon.php');

                                try {
                                    // Prepare the SQL statement
                                    $query = "SELECT * FROM tbl_att_knights LEFT JOIN users ON users.id = tbl_att_knights.tbl_member_id";
                                    $stmt = $pdo->prepare($query);
                                    
                                    // Execute the query
                                    $stmt->execute();
                                    
                                    // Fetch all rows from the query result
                                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    
                                    foreach ($rows as $row) {
                                        // Extract data from the result
                                        if ($row['org_name'] == 'Knights') {
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
                        <!-- KNIGHTS -->
                        </tbody>
                    </table>
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
        function deleteAttendance(id) {
            if (confirm("Do you want to remove this attendance?")) {
                window.location = "../endpoint_qr_knights/delete-attendance.php?attendance=" + id;
            }
        }
    </script>
</body>
</html>