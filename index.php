<?php
$filename = 'state.txt';
$states = array();
$states_data=file($filename);
foreach($states_data as $state)
{
   $states[] = trim($state);
}
$filename = 'health.txt';
$health = array();
$health_data=file($filename);
foreach($health_data as $health_point)
{
   $health[] = trim($health_point);
}
$filename = 'schedule.txt';
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
    <link rel="shortcut icon" href="favicon.ico?" type="image/x-icon">
    <?php include ('stylesheets.php'); ?>
</head>
<body class = "exp">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
            <?php if (time() - $health[0] < 20){
                echo '<div class = "switch" id = "switch1" value='.$states[0].'>';
                if ($states[0] == "on") {
                    echo'<img class = "toggle active" src = "assets/bulb-on.jpg" width = "300px" value = "on"/>';
                    echo'<img class = "toggle inactive" src = "assets/bulb-off.jpg" width = "300px" value = "off"/></div>';
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
        </div> 
        <div class = "row">
            <div class = "col-sx-12 timer">
                <?php if ($new_states[0] > time()){
                date_default_timezone_set("Asia/Karachi");
                $new_state = explode('-',$new_states[0]);
                echo 'Will turn ' . $new_state[1] . ' at: ' . date("F j, Y, g:i a", $new_state[0]);}?>
                <form action = "timer.php" method = "POST" class="form-inline">
                    <label class="" for="inlineFormCustomSelect">Turn</label>
                    <select class="selectpicker" id="inlineFormCustomSelect" name = "new_state" data-width="auto">
                        <option value="off">off</option>
                        <option value="on">on</option>
                    </select>
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
  <!--<script>
      $(document).ready(function() {

    // process the form
    $('form').submit(function(event) {

        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var formData = {
            'new_state'              : $('input[name=name]').val(),
            'number'             : $('input[name=number]').val(),
            'units'    : $('input[name=units]').val()
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
                console.log(data); 

                // here we will handle errors and validation messages
            });

        // stop the form from submitting the normal way and refreshing the page
        event.preventDefault();
    });

});
</script>-->

</body>
</html>