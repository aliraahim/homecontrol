<?php
$debug=true;
$filename = 'gs://simplehomecontrolauto.appspot.com/state.txt';
$states = array();
$states_data=file($filename);
foreach($states_data as $state)
{
    $states[] = trim($state);
}
$filename = 'gs://simplehomecontrolauto.appspot.com/health.txt';
$health = array();
$health_data=file($filename);
foreach($health_data as $health_point)
{
    $health[] = trim($health_point);
}

$filename = 'gs://simplehomecontrolauto.appspot.com/schedule.txt';
$new_states = array();
$new_states_data=file($filename);
foreach($new_states_data as $new_state)
{
    $new_states[] = $new_state;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Home Automation</title>
    <!-- Bootstrap -->
    <link rel="shortcut icon" href="favicon.ico?v=1" type="image/x-icon">
    <?php include ('stylesheets.php'); ?>

</head>
<body class = "cards">
<br>
<br>
<br>
<div id="timer" class="overlay">

    <!-- Button to close the overlay navigation -->
    <a href="javascript:void(0)" class="closebtn" onclick="closeTimer()">&times;</a>

    <!-- Overlay content -->
    <div class="overlay-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <form action = "" method = "" class="form-inline timerForm">
<!--                        <label class="" for="inlineFormCustomSelect">Turn</label>-->
                        <span class="labels">Turn</span>
                        <select class="selectpicker" id="new_state" name = "new_state" data-width="auto">
                            <option value="off">off</option>
                            <option value="on">on</option>
                        </select>
                        <br>
                        <span class="labels">after</span>
                        <input type="number" class="form-control" name="number" id = "number" min="1" max="2000" placeholder="5" required>
                        <select class="selectpicker" name = "units" id="units" data-width="auto">
                            <option value="minutes">minutes</option>
                            <option value="hours">hours</option>
                        </select>
                        </br>
                        </br>
                        <button type="submit" class="btn btn-primary timer-btn">Set timer</button>
                    </form>
                </div>
            </div>
        </div>


    </div>

</div>
<div class="container">
    <div class="row toprow">
        <!--<div class="col-xs-6 col-lg-offset-2 col-lg-4 mycard">-->
        <!--http://shoelace.io/#830fe4793d41c811597b2576c0abfedf-->
        <div class="col-sm-offset-3 col-sm-6">
            <!-- The overlay -->


            <!-- Use any element to open/show the overlay navigation menu -->
            <div class="card">
                <?php if ((time() - $health[0] < 20) || (debug)){
                    echo '<div class = "switch" id = "switch1" value='.$states[0].'>';
                    if ($states[0] == "on") {
                        echo'<img class = "toggle active" src = "assets/new-bulb-on.jpg" style="width:300px" value = "on"/>';
                        echo'<img class = "toggle inactive" src = "assets/new-bulb-off.jpg" style="width:300px" value = "off"/></div>';
                    } elseif ($states[0] == "off") {
                        echo'<img class = "toggle inactive" src = "assets/new-bulb-on.jpg" style="width:300px" value = "on"/>';
                        echo'<img class = "toggle active" src = "assets/new-bulb-off.jpg" style="width:300px" value = "off"/></div>';
                    }} else {
                    echo '<h1 style = "font-size: 7em;">&#9785;</h1>';
                    echo '<h2>Chotu is not working!</h2>';
                    echo '<a href =".">Check again</a>';
                }
                ?>
            </div>
        </div>
        <!--<div class="col-xs-6 col-lg-4 mycard">-->
    </div>
    <div class="row">
        <!--<div class="col-xs-6 col-lg-offset-2 col-lg-4 mycard">-->
        <div class="col-xs-6 col-sm-offset-3 col-sm-3 cardColumn">
            <div class ="card" onclick="openTimer()">
                <div class ="cardImage">
                    <img src="assets/timer.png">
                </div>
                <div class="container">
                    <h4><b>Timer</b></h4>
                    <p>Auto on/off.</p>
                </div>
            </div>

        </div>
        <!--<div class="col-xs-6 col-lg-4 mycard">-->
        <div class="col-xs-6 col-sm-3 cardColumn">
            <div class ="card" onclick="openSettings()">
                <div class ="card" onclick="openSettings()">
                    <div class ="cardImage">
                        <img src="assets/settings.png">
                    </div>
                    <div class="container">
                        <h4><b>Settings</b></h4>
                        <p>Tap to modify.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php include('javascript.php'); ?>
<script>
    $('.switch').click(function() {
        var switches = $(this).find('.toggle');
        switches.toggleClass('inactive');
        switches.toggleClass('active');
        $(this).attr('value',$(this).find('.active').attr('value'));
        switches.attr('disabled',true);
        var url = 'homeauto.php' + '?' + $(this).attr('id') + '=' + $(this).attr('value');
        $.ajax({
            url: url,
            type: 'get',
        }).done(function(data) {
            switches.attr('disabled',false);
        });
    });
</script>
<script>
    function timerButtonRestore() {
        var text = "Set timer";
        $('.timer-btn').text(text);
        $('.timer-btn').css('background-color','#337ab7');
        $('.timer-btn').disabled = '';

    }

    /* Open when someone clicks on the span element */
    function openTimer() {
        document.getElementById("timer").style.width = "100%";
    }

    /* Close when someone clicks on the "x" symbol inside the overlay */
    function closeTimer() {
        document.getElementById("timer").style.width = "0%";
        timerButtonRestore();
    }
</script>
<script>
    $(document).ready(function() {

        // process the form
        $('form').submit(function(event) {

            // get the form data
            // there are many ways to get this data using jQuery (you can use the class or id also)
            var formData = {
                'new_state': $('#new_state').val(),
                'number'   : $('#number').val(),
                'units'    : $('#units').val()
            };

            // process the form
            $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : 'timer.php', // the url where we want to POST
                data        : formData, // our data object
                dataType    : 'json', // what type of data do we expect back from the server
                encode          : true
            })
            // using the done promise callback
                .done(function(data) {

                    // log data to the console so we can see
                    if (data.success == true){
                        var number = $('#number').val();
                        var units = $('#units').val();
                        if (number == 1){
                            units = units.slice(0, -1);
                        }

                        var text = "Timer set for " + number + " " + units + "!";
                        $('.timer-btn').text(text);
                        $('.timer-btn').css('background-color','green');
                        $('.timer-btn').disabled = 'disabled';
                    } else {
                        alert('Sadness');
                    }


                    // here we will handle errors and validation messages
                });

            // stop the form from submitting the normal way and refreshing the page
            event.preventDefault();
        });

    });
</script>

</body>
</html>