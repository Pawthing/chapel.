<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style/style.css">
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
            <li><a href="dashboard_blue.php"><i class='bx bxs-dashboard icon'></i> Dashboard</a></li>
            <li class="divider" data-text="main">Main</li>
            <li>
                <a href=""><i class='bx bx-qr-scan icon'></i> Attendance <i class='bx bx-chevron-right icon-right'></i></a>
                <ul class="side-dropdown">
                    <li><a href="att_altar-server.php"><i class='bx bxs-user-check icon'></i>Altar Servers</a></li>
                    <li><a href="att_usherette.php"><i class='bx bxs-user-check icon'></i>Usherettes</a></li>
                    <li><a href="att_choir.php"><i class='bx bxs-user-check icon'></i>Choir</a></li>
                    <li><a href="att_comi.php"><i class='bx bxs-user-check icon'></i>Comi</a></li>
                    <li><a href="att_leccom.php"><i class='bx bxs-user-check icon'></i>LecCom</a></li>
                    <li><a href="att_multimedia.php"><i class='bx bxs-user-check icon'></i>Multimedia</a></li>
                </ul>
            </li> 
            <li><a href="calendar_blue.php" class="active"><i class="bx bxs-calendar icon"></i>Chapel Calendar</a></li>
            <li><a href="#"><i class="bx bxs-map icon"></i>Heatmap</a></li>
            <li><a href="feedback_blue.php"><i class="bx bxs-message icon"></i>Feedback</a></li>
            
    </section>
    <!-- SIDEBAR -->

    <!-- NAVBAR -->
    <section id="content">
        <!-- NAVBAR -->
         <!-- <nav>
            <i class='bx bx-menu toggle-sidebar'></i>
            <form action="#">
                <div class="form-group">
                    <input type="text" placeholder="Search...">
                    <i class='bx bx-search icon'></i>
                </div>
            </form>
            <a href="#" class="nav-link">
                <i class='bx bxs-bell icon'></i>
                <span class="badge">5</span>
            </a>
            <a href="#" class="nav-link">
                <i class='bx bxs-message-square-dots'></i>
                <span class="badge">8</span>
            </a>
            <span class="divider"></span>
            <div class="profile">
                <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8cGVvcGxlfGVufDB8fDB8fHww" alt="">
                <ul class="profile-link">
                    <li><a href="#"><i class='bx bxs-user-circle icon'></i> Profile </a></li>
                    <li><a href="#"><i class='bx bxs-cog'></i> Settings </a></li>
                    <li><a href="log2.php"><i class='bx bxs-log-out-circle'></i> Logout </a></li>
                </ul>
            </div>
         </nav> -->
        <!-- NAVBAR -->

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
    <script src="js/script.js"></script>
</body>
</html>

<?php
include('connection.php');

if(isset($_REQUEST['save-event']))
{
    $title = $_REQUEST['title'];
    $start_date = $_REQUEST['start_date'];
    $end_date = $_REQUEST['end_date'];

    $insert_query = mysqli_query($connection, "insert into tbl_event set title='$title', start_date='$start_date', end_date='$end_date'");
    if($insert_query)
    {
        header('location:view-calendar.php');
    }
    else
    {
        $msg = "Event not created";
    }
}
$fetch_event = mysqli_query($connection, "select * from tbl_event");
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
                while($result = mysqli_fetch_array($fetch_event))
                    {?>
                {
                    id: '<?php echo $result['id'];?>',
                    title: '<?php echo $result['title'];?>',
                    start: '<?php echo $result['start_date'];?>',
                    end: '<?php echo $result['end_date'];?>',
                    color: 'white',
                    textColor: 'black'
                },
                <?php } ?>
                ],
                eventClick: function(event)
                {
            }
        });
    });
</script>
