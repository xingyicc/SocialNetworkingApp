<?php
  session_start();

  echo <<<_INIT
  <!DOCTYPE html> 
  <html>
    <head>
      <meta charset='utf-8'>
      <meta name='viewport' content='width=device-width, initial-scale=1'> 
      <link rel='stylesheet' href='styles.css' type='text/css'>
      <link rel='stylesheet' href='./resources/jquery.mobile-1.4.5.min.css'>
      <script src='./resources/javascript.js'></script>
      <script src='./resources/jquery-2.2.4.min.js'></script>
      <script src='./resources/jquery.mobile-1.4.5.min.js'></script>
      <title>Social Networking App</title>
    </head>
    <body>
      <div data-role="header" id="header" >
  _INIT;

  require_once 'functions.php';
  require_once 'setup.php';
  
  $randstr = substr(md5(rand()), 0, 7);

  if (isset($_SESSION['user'])) {
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
  }
  else $loggedin = FALSE;

  // Override $user and $loggedin to enable testing for other pages
  // $user = "testttt";
  // $loggedin = TRUE;

  if ($loggedin) {
    echo <<<_LOGGEDIN
      <div data-role="navbar" id="navigation">
        <ul>
          <li><a href= ./index.php >Home</a></li>
          <li><a href= ./members.php >Members</a></li>
          <li><a href= ./messages.php >Messages</a></li>
        </ul>
      </div>
      <div class="ui-btn-right" id='user'>
        <button id="user-dropbtn" data-icon="gear">User: $user</button>
        <div id="user-dropdown-content">
          <a href= ./profile.php? >Profile</a>
          <a href= ./logout.php >Log Out</a>
        </div>
      </div>
    _LOGGEDIN;
  } else {
    echo <<<_GUEST
      <div data-role="navbar" id="navigation">
        <ul>
          <li><a href= ./index.php >Home</a></li>
          <li><a href= ./login.php >Log In</a></li>
          <li><a href= ./signup.php >Sign Up</a></li>
        </ul>
      </div>
    _GUEST;
  }

  echo <<<_END
    </div>
  _END;


?>
