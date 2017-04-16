<?php
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
    <title>Home Automation by MAR</title>
    <!-- Bootstrap -->
    <link rel="shortcut icon" href="" type="image/png">
    <?php include ('stylesheets.php'); ?>
</head>
<body>
    <header>
    </header>
    <div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1>Home Automation by MAR</h1>
            <div class = "switch">
            <div class="btn-group btn-toggle"  id = "switch1" value=<?php echo $states[0]?>> 
            <?php if ($states[0] == "on") {
                echo'<button class="btn btn-lg btn-primary active" value="on">ON</button>
                <button class="btn btn-lg btn-default" value="off">OFF</button>';
            } elseif ($states[0] == "off") {
                echo'<button class="btn btn-lg btn-default" value="on">ON</button>
                <button class="btn btn-lg btn-primary active" value="off">OFF</button>';
            }?>
  </div>
  </div>
        </div>
    </div>
    
</div>
  <?php include('javascript.php'); ?>  
  <script>
      $('.btn-toggle').click(function() {
        var switches = $(this).find('.btn');
        switches.toggleClass('active');  
        switches.toggleClass('btn-primary');
        switches.toggleClass('btn-default');
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