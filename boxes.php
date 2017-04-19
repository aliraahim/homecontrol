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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
</head>
<body class = "">
    <div class="container">
    <div class="row">
        <div class="col-xs-6 col-lg-offset-2 col-lg-4">
      <div class="card">
        <div class="card-image">
          <!--<img src="http://materializecss.com/images/sample-1.jpg">-->
          <?php if ((time() - $health[0] < 20) || (debug)){
                echo '<div class = "switch" id = "switch1" value='.$states[0].'>';
                if ($states[0] == "on") {
                    echo'<img class = "toggle active" src = "assets/bulb-on.jpg" style="width:50%" value = "on"/>';
                    echo'<img class = "toggle inactive" src = "assets/bulb-off.jpg" style="width:50%" value = "off"/></div>';
                } elseif ($states[0] == "off") {
                    echo'<img class = "toggle inactive" src = "assets/bulb-on.jpg" width = "300px" value = "on"/>';
                    echo'<img class = "toggle active" src = "assets/bulb-off.jpg" width = "300px" value = "off"/></div>';
                }} else {
                    echo '<h1 style = "font-size: 7em;">&#9785;</h1>';
                    echo '<h2>Chotu is not working!</h2>';
                    echo '<a href =".">Check again</a>';
                }
                ?>
        </div>
        <div class="card-content">
        <!--<span class="card-title activator grey-text text-darken-4">Switch state</span>-->
          <p>Tap to turn on/off.</p>
        </div>
  </div>
        </div>
        <div class="col-xs-6 col-lg-4">
            <div class="card">
    <div class="card-image waves-effect waves-block waves-light">
      <img class="activator" style="width:75%" src="http://3.bp.blogspot.com/-ZAcbB0Nm-s0/V6R9zUIPZkI/AAAAAAAA5w8/K-Ej-SJ-wC8zLDFiTHrVZyB2aqr5I_VGACK4B/s1600/settings%2Bicon%2BN%2Bdark.png">
    </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">Settings</span>
      <p>Tap to display settings.</p>
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