<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../style/style.css">
    <title>Organization Schedule</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<style>
    .box
    {
        width: 100%;
        max-width: 600px;
        background-color: #f9f9f9;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 16px;
        margin: 0 auto;
        cursor: pointer;
    }
    input.parsley-success,
    select.parsley-success,
    textarea.parsley-success {
        color: #468847;
        background-color: #DFF0D8;
        border: 1px solid #D6E9C6;
    }

    input.parsley-error,
    select.parsley-error,
    textarea.parsley-error {
        color: #B94A48;
        background-color: #F2DEDE;
        border: 1px solid #EED3D7;
    }

    .parsley-errors-list {
        margin: 2px 0 3px;
        padding: 0;
        list-style-type: none;
        font-size: 0.9em;
        line-height: 0.9em;
        opacity: 0;

        transition: all .3s ease-in;
        -o-transition: all .3s ease-in;
        -moz-transition: all .3s ease-in;
        -webkit-transition: all .3s ease-in;
    }

    .parsley-errors-list.filled {
        opacity: 1;
    }

    .parsley-type, .parsley-required, .parsley-equalto{
        color: #ff0000;
    }
    .error
    {
        color: red;
        font-weight: 700;
    }
    .container {
        background-color:  #adf7b6;
        /* Calendar BG Color Pallete
            #79addc; (blue) 
            #ffc09f; (red)
            #ffee93; (yellow)
            #fcf5c7; (light yellow)
            #adf7b6; (green)*/
    }
</style>
<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand"><i class='bx bxs-church icon'></i>DASHBOARD ADMIN</a>
        <ul class="side-menu">
            <li><a href="./dashboard_admin.php"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
            <li class="divider" data-text="main">Main</li>

            <li><a href="masterlist_alt-serv.php"><i class='bx bx-qr-scan icon'></i> QR Code Attendance </a></li> 
            <li><a href="qr_index-orgs.php"><i class="bx bxs-check-circle icon"></i> Attendance Monitoring</a></li>
            <li><a href="calendar_admin.php"><i class="bx bxs-calendar icon"></i>Chapel Calendar</a></li>
            <li><a href="schedule.php" class="active"><i class="bx bxs-pin icon"></i> Organization Schedule</a></li>
            <li><a href="#"><i class="bx bx-list-ol icon"></i> Chapel Rules</a></li>
            <li><a href="heatmap.php"><i class="bx bxs-map icon"></i>Heatmap</a></li>
            <li><a href="feedback.php"><i class="bx bxs-message icon"></i>Feedback</a></li>
            <!-- <li class="divider" data-text="table and forms">Table and forms</li><BR></BR> -->

            <!-- <li><i class="bx bxs-table icon"></i> Tables</li> -->
            <!-- <li>
                <a href="#"><i class="bx bxs-notepad icon"></i> Forms <i class="bx bxs-chevron-right icon-right"></i></a>
                <ul class="side-dropdown">
                    <li><a href="#"><i class="bx bxs-map icon"></i>Heatmap</a></li>
                    <li><a href="feedback_blue.php"><i class="bx bxs-message icon"></i>Feedback</a></li>
                </ul>
            </li> -->
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- <button><a href="dashboard_admin.php">Dashboard</button></a> -->

    <section id="content">
        <!-- MAIN -->
        <main>
    <div class="container">
    <h1><center><b>&emsp;&emsp;Organization Schedule</b></center></h2>
        <div id="calendar"></div>
    </div>
    <br>
        </main>
        <!-- MAIN -->
    </section>
    <!-- NAVBAR -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../js/script.js"></script>
</body>
</html>

<?php
include('../connection.php');

    if (isset($_REQUEST['save-event'])) {
        $title = $_REQUEST['title'];
        $start_date = $_REQUEST['start_date'];
        $end_date = $_REQUEST['end_date'];

        try {
            // Prepare the SQL statement using named placeholders
            $insert_query = $con->prepare("INSERT INTO tbl_calendar (title, start_date, end_date) VALUES (:title, :start_date, :end_date)");

            // Bind the form values to the placeholders
            $insert_query->bindParam(':title', $title);
            $insert_query->bindParam(':start_date', $start_date);
            $insert_query->bindParam(':end_date', $end_date);

            // Execute the query
            if ($insert_query->execute()) {
                header('location:view-calendar.php');
            } else {
                $msg = "Event not created";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    try {
        // Fetch the events from the database
        $fetch_event = $con->query("SELECT * FROM tbl_calendar");
        
        // Fetch all events as an associative array
        $events = $fetch_event->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>


<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            selectable: true,
            selectHelper: true,
            select: function() {
                document.getElementById("calendar").style.cursor = "pointer";
                $('#myModal').modal('toggle');
            },
            header: {
                left: 'month, agendaWeek, agendaDay, list',
                center: 'title',
                right: 'prev, today, next'
            },
            buttonText: {
                today: 'Today',
                month: 'Month',
                week: 'Week',
                day: 'Day',
                list: 'List'
            },
            events: [
                <?php
                foreach ($events as $result) {
                    ?>
                {
                    id: '<?php echo $result['id']; ?>',
                    title: '<?php echo $result['title']; ?>',
                    start: '<?php echo $result['start_date']; ?>',
                    end: '<?php echo $result['end_date']; ?>',
                    color: '#5bb450',
                    textColor: 'black'
                },
                <?php } ?>
            ],
            editable: true,
            eventDrop: function(event) {
                var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                var title = event.title;
                var id = event.id;
                $.ajax({
                    url: "update.php",
                    type: "POST",
                    data: {
                        title: title,
                        start: start,
                        end: end,
                        id: id
                    },
                    success: function(response) {
                        alert("Event Updated Successfully!");
                    },
                    error: function(xhr, status, error) {
                        alert("Error: " + error);
                    }
                });
            },
            eventClick: function(event) {
                if (confirm("Are you sure you want to remove it?")) {
                    var id = event.id;
                    $.ajax({
                        url: "delete.php",
                        type: "POST",
                        data: { id: id },
                        success: function(response) {
                            alert("Event Removed Successfully!");
                            window.location.reload();
                        },
                        error: function(xhr, status, error) {
                            alert("Error: " + error);
                        }
                    });
                }
            }
        });
    });
</script>


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 align="center"><b>Create Event</b></h3><br/>
        </div>
        <div class="box">
                <form method=post>
                    <div class="form-group">
                        <label for="title">Enter Title of the Event</label>
                        <input type="text" name="title" id="title" placeholder="Enter Title" required data-parsley-type="title" data-parsley-trigger="keyup" class="form-control"/>
       </div>
        <div class="form-group">
            <label for="date">Start Date</label>
            <input type="datetime-local" name="start_date" id="start_date" required data-parsley-type="datetime" data-parsley-trigger="keyup" class="form-control"/>
      </div>
        <div class="form-group">
            <label for="date">End Date</label>
            <input type="datetime-local" name="end_date" id="end_date" required data-parsley-type="datetime" data-parsley-trigger="keyup" class="form-control"/>
      </div>
        <div class="form-group">
             <input type="submit" id="save-event" name="save-event" value="Save Event" class="btn btn-success" />
            </div>
            <p class="error"><?php if(!empty($msg)){ echo $msg; } ?></p>
                </form>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
      </div>
      
    </div>
</div>