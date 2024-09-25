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
            /* background-color: teal; */
        }
        .navbar .nav-link, .navbar-brand{
            color:black;
        }
        .thead{
            background-color: #1775F1;
            /* background-color: teal; */
            position: sticky;
            top: 0px;
        }
        .nav-item:hover{
            /* background-color: wheat; */
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
            /* background-color: teal; */
            /* color: wheat; */
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
            /* background-color: wheat; */
            background-color: white;
        }
</style>
<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand ml-4" href="#">Attendance Monitoring</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item1">
                    <a class="nav-link" href="./qr_index_altar-servers.php"> Altar Servers <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./qr_index_choir.php"> Choir <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./qr_index_comi.php"> COMI <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
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
                <h2 align="center">List of Presents in Altar Servers</h2>
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
                            </tr>
                        </thead>
                        <tbody>
                        <!-- CHOIR -->
                        <?php
                            // Include the database connection file
                            include ('../dbcon.php');
                            
                            try {
                                $pdo = new PDO($dsn, $username, $password);
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                // Prepare the SQL statement
                                $query = "SELECT * FROM tbl_att_choir LEFT JOIN users ON users.id = tbl_att_choir.tbl_member_id";
                                $stmt = $pdo->prepare($query);
                                
                                // Execute the query
                                $stmt->execute();
                                
                                // Fetch all rows from the query result
                                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                
                                foreach ($rows as $row) {
                                    // Extract data from the result
                                    if ($row['org_name'] == 'Choir') {
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
                        <!-- CHOIR -->
                        <tr>
                            <th scope="row">---</th>
                            <td>---</td>
                            <td>---</td>
                            <td>---</td>
                            <td>---</td>
                        </tr>
                        <!-- COMI -->
                        <?php
                            // Include the database connection file
                            include ('../dbcon.php');
                            
                            try {
                                $pdo = new PDO($dsn, $username, $password);
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
                        <!-- COMI -->
                        <tr>
                            <th scope="row">---</th>
                            <td>---</td>
                            <td>---</td>
                            <td>---</td>
                            <td>---</td>
                        </tr>
                        <!-- KNIGHTS -->
                        <?php
                            // Include the database connection file
                            include ('../dbcon.php');
                            
                            try {
                                $pdo = new PDO($dsn, $username, $password);
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
                        <tr>
                            <th scope="row">---</th>
                            <td>---</td>
                            <td>---</td>
                            <td>---</td>
                            <td>---</td>
                        </tr>
                        <!-- LECCOM -->
                        <?php
                            // Include the database connection file
                            include ('../dbcon.php');
                            
                            try {
                                $pdo = new PDO($dsn, $username, $password);
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                // Prepare the SQL statement
                                $query = "SELECT * FROM tbl_att_leccom LEFT JOIN users ON users.id = tbl_att_leccom.tbl_member_id";
                                $stmt = $pdo->prepare($query);
                                
                                // Execute the query
                                $stmt->execute();
                                
                                // Fetch all rows from the query result
                                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                
                                foreach ($rows as $row) {
                                    // Extract data from the result
                                    if ($row['org_name'] == 'LecCom') {
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
                        <!-- LECCOM -->
                        <tr>
                            <th scope="row">---</th>
                            <td>---</td>
                            <td>---</td>
                            <td>---</td>
                            <td>---</td>
                        </tr>
                        <!-- MULTIMEDIA -->
                        <?php
                            // Include the database connection file
                            include ('../dbcon.php');
                            
                            try {
                                $pdo = new PDO($dsn, $username, $password);
                                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                // Prepare the SQL statement
                                $query = "SELECT * FROM tbl_att_multi LEFT JOIN users ON users.id = tbl_att_multi.tbl_member_id";
                                $stmt = $pdo->prepare($query);
                                
                                // Execute the query
                                $stmt->execute();
                                
                                // Fetch all rows from the query result
                                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                
                                foreach ($rows as $row) {
                                    // Extract data from the result
                                    if ($row['org_name'] == 'Multimedia') {
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
                        <!-- MULTIMEDIA -->
                        <tr>
                            <th scope="row">---</th>
                            <td>---</td>
                            <td>---</td>
                            <td>---</td>
                            <td>---</td>
                        </tr>
                    <!-- USHERETTES -->
                    <?php
                            // Include the database connection file
                            include ('../dbcon.php');
                            
                            try {
                                // Prepare the SQL statement
                                $query = "SELECT * FROM tbl_att_usherette LEFT JOIN users ON users.id = tbl_att_usherette.tbl_member_id";
                                $stmt = $pdo->prepare($query);
                                
                                // Execute the query
                                $stmt->execute();
                                
                                // Fetch all rows from the query result
                                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                
                                foreach ($rows as $row) {
                                    // Extract data from the result
                                    if ($row['org_name'] == 'Usherette') {
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
                        <!-- USHERETTES -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>