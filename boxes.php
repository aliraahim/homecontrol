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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
    <?php include ('stylesheets.php'); ?>
    
</head>
<body class = "cards">
<br>
<br>
<br>
    <div class="container">
    <div class="row toprow">
        <!--<div class="col-xs-6 col-lg-offset-2 col-lg-4 mycard">-->
        <!--http://shoelace.io/#830fe4793d41c811597b2576c0abfedf-->
        <div class="col-xs-6 col-sm-offset-2 col-sm-4 col-md-offset-3 col-md-3 mycard">
      <div class="card">
        <div class="card-image">
          <!--<img src="http://materializecss.com/images/sample-1.jpg">-->
          <?php if ((time() - $health[0] < 20) || (debug)){
                echo '<div class = "switch" id = "switch1" value='.$states[0].'>';
                if ($states[0] == "on") {
                    echo'<img class = "toggle active" src = "assets/new-bulb-on.jpg" style="width:150px" value = "on"/>';
                    echo'<img class = "toggle inactive" src = "assets/new-bulb-off.jpg" style="width:150px" value = "off"/></div>';
                } elseif ($states[0] == "off") {
                    echo'<img class = "toggle inactive" src = "assets/new-bulb-on.jpg" style="width:150px" value = "on"/>';
                    echo'<img class = "toggle active" src = "assets/new-bulb-off.jpg" style="width:150px" value = "off"/></div>';
                }} else {
                    echo '<h1 style = "font-size: 7em;">&#9785;</h1>';
                    echo '<h2>Chotu is not working!</h2>';
                    echo '<a href =".">Check again</a>';
                }
                ?>
        </div>
        <div class="card-content">
        <!--<span class="card-title activator grey-text text-darken-4">Switch state</span>-->
          <p>Tap to turn on/off</p>
        </div>
  </div>
        </div>
        <!--<div class="col-xs-6 col-lg-4 mycard">-->
        <div class="col-xs-6 col-sm-4 col-md-3 mycard">
            <div class="card">
    <div class="card-image waves-effect waves-block waves-light">
    <?php if ($new_states[0] > time()){
                date_default_timezone_set("Asia/Karachi");
                $new_state = explode('-',$new_states[0]);
                echo '<p class ="timertext">Will turn ' . $new_state[1] . ' at<br> ' . date("F j, Y, g:i a", $new_state[0]) . '</p>';}?>
      <!--<img class="activator" style="width:111px" src="assets/settings.png">-->
    </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">Timer</span>
      <p>Taps here to modify</p>
    </div>
    <div class="card-reveal timerform">
    <!--<p><i class="material-icons right">close</i></p>-->
      <i class="material-icons right">close</i>
      <form action = "timer.php" method = "POST" class="form-inline">
                    <label class="" for="inlineFormCustomSelect">Turn</label>
                    <select class="selectpicker" id="inlineFormCustomSelect" name = "new_state" data-width="auto">
                        <option value="off">off</option>
                        <option value="on">on</option>
                    </select>
                    <br>
                    <br>
                    <label class="" for="number">after</label>
                    <input type="number" class="form-control" name="number" id = "inlineFormInput" min="1" max="2000" placeholder="5" required>
                    <select class="selectpicker" name = "units" id="inlineFormCustomSelect" data-width="auto">
                        <option value="minutes">minutes</option>
                        <option value="hours">hours</option>
                    </select>
                    </br>
                    </br>
                    <button type="submit" class="btn btn-primary">Set timer</button>
                </form>
    </div>
  </div>
        </div>
    </div>
    <div class="row">
        <!--<div class="col-xs-6 col-lg-offset-2 col-lg-4 mycard">-->
        <div class="col-xs-6 col-sm-offset-2 col-sm-4 col-md-offset-3 col-md-3 mycard">
      <div class="card">
        <div class="card-image">
          <!--<img src="http://materializecss.com/images/sample-1.jpg">-->
          <?php if ((time() - $health[0] < 20) || (debug)){
                echo '<div class = "switch" id = "switch1" value='.$states[0].'>';
                if ($states[0] == "on") {
                    echo'<img class = "toggle active" src = "assets/new-bulb-on.jpg" style="width:150px" value = "on"/>';
                    echo'<img class = "toggle inactive" src = "assets/new-bulb-off.jpg" style="width:150px" value = "off"/></div>';
                } elseif ($states[0] == "off") {
                    echo'<img class = "toggle inactive" src = "assets/new-bulb-on.jpg" style="width:150px" value = "on"/>';
                    echo'<img class = "toggle active" src = "assets/new-bulb-off.jpg" style="width:150px" value = "off"/></div>';
                }} else {
                    echo '<h1 style = "font-size: 7em;">&#9785;</h1>';
                    echo '<h2>Chotu is not working!</h2>';
                    echo '<a href =".">Check again</a>';
                }
                ?>
        </div>
        <div class="card-content">
        <!--<span class="card-title activator grey-text text-darken-4">Switch state</span>-->
          <p>Tap to turn on/off</p>
        </div>
  </div>
        </div>
        <!--<div class="col-xs-6 col-lg-4 mycard">-->
        <div class="col-xs-6 col-sm-4 col-md-3 mycard">
            <div class="card">
    <div class="card-image waves-effect waves-block waves-light">
      <img class="activator" style="width:111px" src="http://3.bp.blogspot.com/-ZAcbB0Nm-s0/V6R9zUIPZkI/AAAAAAAA5w8/K-Ej-SJ-wC8zLDFiTHrVZyB2aqr5I_VGACK4B/s1600/settings%2Bicon%2BN%2Bdark.png">
    </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">Settings</span>
      <p>Tap to display settings</p>
    </div>
    <div class="card-reveal">
    <!--<p><i class="material-icons right">close</i></p>-->
      <span class="card-title grey-text text-darken-4">Settings<i class="material-icons right">close</i></span>
      <p>Here you can configure settings.</p>
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

</body>
</html>