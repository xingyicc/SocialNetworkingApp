<?php
  session_start();

  require_once 'header.php';

  echo <<<_START
    <div id='content'>
      <h1 id='welcome'> Social Networking App </h1>
  _START;

  echo "Welcome";
  if ($loggedin) echo " $user, you are logged in.";
  else           echo ' guest, please sign up or log in.';
  
  echo <<<_END
      </div>
    </body>
  </html>
  _END;

?>
