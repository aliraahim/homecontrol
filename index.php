<?php
$debug=true;
$filename = 'gs://simplehomecontrolauto.appspot.com/state.txt';
$states = array();
$states_data=file($filename);
foreach($states_data as $state)
{
    $states[] = trim($state);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Simple Home Control</title>
    <!-- Bootstrap -->
    <link rel="shortcut icon" href="newfavicon.ico?v=1" type="image/x-icon">
    <?php include ('stylesheets.php'); ?>

</head>
<body class = "cards">
<div id="timer" class="overlay">

    <!-- Button to close the overlay navigation -->
    <a href="javascript:void(0)" class="closebtn" onclick="closeTimer()">&times;</a>

    <!-- Overlay content -->
    <div class="overlay-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class = "timerInfoOverlay" style ="display:none">
                        <p class = "timerMessage"></p>
                        <div class = "timerButtons">
                            <button type="submit" class="btn btn-warning removeTimer">Remove timer</button>
                            <button type="submit" class="btn btn-primary newTimer">Set new timer</button>
                        </div>
                    </div>
                </div>
            </div>
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
                        <input type="number" class="form-control" name="number" id = "number" min="1" max="2000" placeholder="Enter number" required>
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
<div id="settings" class="overlay">

    <!-- Button to close the overlay navigation -->
    <a href="javascript:void(0)" class="closebtn" onclick="closeSettings()">&times;</a>

    <!-- Overlay content -->
    <div class="overlay-content">
        <div class="container">
            <div class="row">
                <div class="col-xs-9 col-sm-offset-3 col-sm-4 settingsLabel">
                    <span>Google Home Integration</span>
                </div>
                <div class="col-xs-3 col-sm-2 settingsInput">
                    <input type="checkbox" id = "googleHome" checked data-toggle="toggle" data-onstyle="primary" data-size="large">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-9 col-sm-offset-3 col-sm-4 settingsLabel">
                    <span>SMS Integration</span>
                </div>
                <div class="col-xs-3 col-sm-2 settingsInput">
                    <input type="checkbox" id = "SMS" checked data-toggle="toggle" data-onstyle="primary" data-size="large">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class ="row">
        <div class ="col-sm-12">
            <div class = "logo">
                <img src = "assets/logo.png">
            </div>

        </div>
    </div>
    <div class="row toprow">
        <!--<div class="col-xs-6 col-lg-offset-2 col-lg-4 mycard">-->
        <!--http://shoelace.io/#830fe4793d41c811597b2576c0abfedf-->
        <div class="col-sm-offset-3 col-sm-6">
            <!-- The overlay -->


            <!-- Use any element to open/show the overlay navigation menu -->
            <div class="card">
                <?php
                    echo '<div class = "switch" id = "switch1" value='.$states[0].'>';
                    if ($states[0] == "on") {
                        echo'<img class = "toggle active" src = "assets/new-bulb-on.jpg" style="width:300px" value = "on"/>';
                        echo'<img class = "toggle inactive" src = "assets/new-bulb-off.jpg" style="width:300px" value = "off"/></div>';
                    } elseif ($states[0] == "off") {
                        echo'<img class = "toggle inactive" src = "assets/new-bulb-on.jpg" style="width:300px" value = "on"/>';
                        echo'<img class = "toggle active" src = "assets/new-bulb-off.jpg" style="width:300px" value = "off"/></div>';
                    }
                ?>

                <span class ="healthInfo">Health:<span class ="health"></span><i class="fa fa-refresh healthCheckButton"></i></span>
                <span class =" timerInfo"></span>
                <span class ="guide"><img src = "assets/guide.png"></span>
            </div>
        </div>
        <!--<div class="col-xs-6 col-lg-4 mycard">-->
    </div>
    <div class="row">
        <!--<div class="col-xs-6 col-lg-offset-2 col-lg-4 mycard">-->
        <div class="col-xs-6 col-sm-offset-3 col-sm-3 cardColumn">
            <div class ="card timerCard" onclick="openTimer()">
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
        <div class="col-xs-6 col-sm-3 cardColumn" style ="margin-bottom:30px">
                <div class ="card settingsCard" onclick="openSettings()">
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
    <div class ="row">
        <div class ="col-sm-12">
            <p style ="text-align:center; color:white; ">Built by Raahim</p>
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
    window.setInterval(function(){
        checkState();
    }, 5000);
    var timerData = null;

    function timerButtonRestore() {
        var text = "Set timer";
        $('.timer-btn').text(text);
        $('.timer-btn').css('background-color','#337ab7');
        $('.timer-btn').css('cursor','auto');
        $('.timer-btn').disabled = '';
        $('#new_state').val('off');
        $('#number').val('');
        $('#units').val('minutes');


    }

    /* Open when someone clicks on the span element */
    function openTimer() {
        if (timerData.timerSet == true){
            $('.timerMessage').html("Timer is set!" + "<br>" + "Switch will turn " + timerData.new_state + " at: " + timerData.time);
            $('.timerInfoOverlay').css('display','block');
            $('.removeTimer').css('display','inline');
            $('.timerForm').css('display','none');
        } else {
            $('.timerForm').css('display','block');
            $('.timerInfoOverlay').css('display','none');
        }


        document.getElementById("timer").style.width = "100%";
    }

    /* Close when someone clicks on the "x" symbol inside the overlay */
    function closeTimer() {
        document.getElementById("timer").style.width = "0%";
        timerButtonRestore();
        checkTimer();
    }

    function openSettings() {
        checkSettings();
        document.getElementById("settings").style.width = "100%";
    }

    /* Close when someone clicks on the "x" symbol inside the overlay */
    function closeSettings() {
        document.getElementById("settings").style.width = "0%";
    }

    function checkHealth() {
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'checkHealth.php', // the url where we want to POST
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true,
            beforeSend : function(){
                $('.health').html('<i class="fa fa-circle checking"></i>');
                // do your stuff here

            }
        })
        // using the done promise callback
            .done(function(data) {
                // log data to the console so we can see
                if (data.success == true){
//                    $('.health').text('Online');
                    $('.health').html('<i class="fa fa-circle online"></i>');
                } else {
//                    $('.health').text('Offline');
                    $('.health').html('<i class="fa fa-circle offline"></i>');
                }


                // here we will handle errors and validation messages
            });
    }

    function checkTimer() {
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'checkTimer.php', // the url where we want to POST
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true,
        })
        // using the done promise callback
            .done(function(data) {
                // log data to the console so we can see
                if (data.timerSet == true){
                    $('.timerInfo').text('Timer active');
                } else {
                    $('.timerInfo').text('');
                }
                timerData = data;
                // here we will handle errors and validation messages
            });
    }

    function checkState() {
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'checkState.php', // the url where we want to POST
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true
        })
        // using the done promise callback
            .done(function(data) {
                // log data to the console so we can see
                if (data.state == 'on'){
//                    $('.health').text('Online');
                    $("img[value='on']").addClass('active');
                    $("img[value='on']").removeClass('inactive');
                    $("img[value='off']").addClass('inactive');
                    $("img[value='off']").removeClass('active');
                } else {
                    $("img[value='on']").addClass('inactive');
                    $("img[value='on']").removeClass('active');
                    $("img[value='off']").addClass('active');
                    $("img[value='off']").removeClass('inactive');
                }
            });
    }

    function checkSettings() {
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'checkSettings.php', // the url where we want to POST
            dataType    : 'json', // what type of data do we expect back from the server
            encode          : true
        })
        // using the done promise callback
            .done(function(data) {
                // log data to the console so we can see
                if (data[0].split('-')[1] == 'on') {
                    $('#googleHome').bootstrapToggle('on');
                } else {
                    $('#googleHome').bootstrapToggle('off');
                }

                if (data[1].split('-')[1] == 'on') {
                    $('#SMS').bootstrapToggle('on');
                } else {
                    $('#SMS').bootstrapToggle('off');
                }

            });
    }

</script>
<script>
    $(document).ready(function() {

        checkHealth();
        checkTimer();
        checkSettings();

        $("#googleHome").change(function() {
            var setting;
            if ($(this).prop('checked') == true){
                setting = 'on';
            } else {
                setting = 'off';
            }

            var toggleValue = {
                'googleHome'    : setting
            };
            $.ajax({
                type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
                url         : 'settings.php', // the url where we want to POST
                data        : toggleValue,
                dataType    : 'json', // what type of data do we expect back from the server
                encode          : true
            });
        });
        $("#SMS").change(function() {
            var setting;
            if ($(this).prop('checked') == true){
                setting = 'on';
            } else {
                setting = 'off';
            }

            var toggleValue = {
                'SMS'    : setting
            };
            $.ajax({
                type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
                url         : 'settings.php', // the url where we want to POST
                data        : toggleValue,
                dataType    : 'json', // what type of data do we expect back from the server
                encode          : true
            });
        });



        $( ".healthCheckButton" ).click(function() {
            checkHealth();
            checkState();
        });

        $( ".newTimer" ).click(function() {
            $('.timerForm').css('display','block');
            $('.timerInfoOverlay').css('display','none');
        });

        $( ".removeTimer" ).click(function() {
            var formData = {
                'new_state': 'off',
                'number'   : '-200',
                'units'    : 'minutes'
            };

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
                        $('.timerMessage').html("Timer removed!");
                        $('.removeTimer').css('display','none');

                    } else {
                        alert('Sadness');
                    }


                    // here we will handle errors and validation messages
                });
        });

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
                        $('.timer-btn').css('cursor','not-allowed');
                    } else {
                        alert('Timer could not be set!');
                    }
                });
            // stop the form from submitting the normal way and refreshing the page
            event.preventDefault();
        });
    });
</script>

</body>
</html>