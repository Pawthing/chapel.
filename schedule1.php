<!DOCTYPE html>
<head>
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
</style>
<body>
    <button><a href="dashboard_admin.php">Dashboard</button></a>
    <h1><center><b>&emsp;&emsp;Organization Schedule</b></center></h2>
    <div class="container">
        <div id="calendar"></div>
    </div>
    <br>
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
        header('location:schedule.php');
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
                    {?>,
                {
                    id: '<?php echo $result['id'];?>',
                    title: '<?php echo $result['title'];?>',
                    start: '<?php echo $result['start_date'];?>',
                    end: '<?php echo $result['end_date'];?>',
                    color: 'shuffle',
                    textColor: 'black'
                },
                <?php } ?>
                ],
                editable: true,
                eventDrop: function(event)
                {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url: "update.php",
                        type: "POST",
                        data: {title: title, start: start, end: end, id:id},
                        success: function()
                        {
                            alert("Event Updated Successfully!");
                        }
                    });
                },
                eventClick: function(event)
                {
                    if(confirm("Are you sure you want to remove it?"))
                    {
                    var id = event.id;
                    $.ajax({
                        url: "delete.php",
                        type: "POST",
                        data: { id: id},
                        success: function()
                        {
                            alert("Event Removed Successfully!");
                            window.location.reload();
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