<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../style/style.css">
    <title>Chapel Calendar</title>
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
    .container{
        background-color: #79addc;
    }
    #buttonText{
        background: #79addc;
    }
</style>

<body>
    
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand"><i class='bx bxs-church icon'></i>San Lorenzo Diakono Chapel</a>
        <ul class="side-menu">
            <li><a href="dashboard_knights.php"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
            <li class="divider" data-text="main">Main</li>
            <li><a href="././qr_code_knights.php"><i class="bx bx-qr icon"></i>QR Code for Attendance</a></li>
            <li>
                <a href="././att_index_knights.php"><i class='bx bx-qr-scan icon'></i> Attendance </a>
            </li> 
            <li><a href="././calendar.php" class="active"><i class="bx bxs-calendar icon"></i>Chapel Calendar</a></li>
            <li><a href="heatmap.php"><i class="bx bxs-map icon"></i>Heatmap</a></li>
            <li><a href="feedback.php"><i class="bx bxs-message icon"></i>Feedback</a></li>
            
    </section>
    <!-- SIDEBAR -->

    <!-- NAVBAR -->
    <section id="content">
        
        <!-- MAIN -->
        <main>
            <div class="container">
                <h1><center><b>&emsp;&emsp;Chapel Calendar</b></center></h2>
                <div id="calendar"></div>
            </div>
            <br>
        </main>
        <!-- MAIN -->

    </section>
    <!-- NAVBAR -->

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../../js/script.js"></script>
</body>
</html>

<?php
include('../../connection.php');

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
            select: function()
            {
                document.getElementById("calendar").style.cursor = "pointer";
                $('#myModal').modal('toggle');
            },
            header:
            {
                left: 'month, agendaWeek, agendaDay, list',
                center: 'title',
                right: 'prev, today, next'
            },
            buttonText:
            {
                today: 'Today',
                month: 'Month',
                week: 'Week',
                day: 'Day',
                list: 'List'
            },
            events:[
                <?php
                // Fetching events from the database using PDO
                foreach ($events as $result) {
                    ?>
                {
                    id: '<?php echo $result['id']; ?>',
                    title: '<?php echo $result['title']; ?>',
                    start: '<?php echo $result['start_date']; ?>',
                    end: '<?php echo $result['end_date']; ?>',
                    color: 'white',
                    textColor: 'black'
                },
                <?php } ?>
            ],
            eventClick: function(event)
            {
                // You can add logic for when an event is clicked here
            }
        });
    });
</script>

