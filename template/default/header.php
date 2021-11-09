<?php
if (!defined('TIMECLOCK')) die();
$userIsWorking = $user->isWorking();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <title>TimeClock</title>

    <!-- Bootstrap core CSS -->
    <link href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/template/default/css/lumen_bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/template/default/css/timeclock.css" rel="stylesheet">
    <? if ($main) { ?>
    <link href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/template/default/css/clock-main.css" rel="stylesheet">
    <? } else {
        if ($userIsWorking) { ?>
    <link href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/template/default/css/clock-min-right.css" rel="stylesheet">
    <? } else { ?>
    <link href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/template/default/css/clock-min.css" rel="stylesheet">
    <? }
    }?>
    <!-- Jquery! -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!-- Bootstrap minified JS -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    
    <link href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/lib/fullcalendar-2.0.3/fullcalendar.css" rel='stylesheet' />
    <link href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/lib/fullcalendar-2.0.3/fullcalendar.print.css" rel='stylesheet' media='print' />
    <script src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/lib/fullcalendar-2.0.3/lib/moment.min.js"></script>
    <!--<script src='../lib/jquery.min.js'></script>
    <script src='../lib/jquery-ui.custom.min.js'></script>-->
    <script src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/lib/fullcalendar-2.0.3/fullcalendar.min.js"></script>


  </head>

  <body onload="updateClock(); setInterval('updateClock()', 1000 ) ">

  <div id="container">
  <?php if (DEV_DEBUG) {
    echo '<p class="text-danger">timeclock development <a href="versions">v'. $timeclock_version .'</a></p>';
  } ?>
  <div class="navbar navbar-default">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="/">TimeClock</a>
  </div>
  <div class="navbar-collapse collapse navbar-responsive-collapse">
    <ul class="nav navbar-nav">
      <li <?php if ($requestURI[0] == "") { echo 'class="active"'; } ?>><a href="/">Punches</a></li>
      <li <?php if ($requestURI[0] == "schedule") { echo 'class="active"'; } ?>><a href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/schedule">Schedule</a></li>
      <li <?php if ($requestURI[0] == "statistics") { echo 'class="active"'; } ?>><a href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/statistics">Statistics</a></li>
    </ul>
    
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['fn'] ." ". $_SESSION['ln']; ?> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <?php if($user->isAdmin()) { echo '<li><a href="https://'.$_SERVER['SERVER_NAME'].'/admin">Admin</a></li>' ; } ?>
          <li><a href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/edit">Edit Profile</a></li>
          <li class="divider"></li>
          <li><a href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/logout.php">Log out</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>

  <div id="workingBox">
<?php if ($userIsWorking) {
    //echo '<div class="alert alert-warning persistent" role="alert">Clocked in and working. Completed <span id="realtime">'.timeBetweenDatesWithSeconds($user->lastPunch()).'</span> hours.</div>';
    ?>
    
    <div class="panel panel-warning">
        <div class="panel-heading">
            <h3 class="panel-title">Clocked in and working. Completed <span id="realtime"><?php echo timeBetweenDatesWithSeconds($user->lastPunch()) ?></span> hours.</h3>
        </div>
    </div>

<?php } ?>
</div>

<div id="clockDisplay">
	<span id="clock">&nbsp;</span>
</div>