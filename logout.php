<?php
  require_once 'header.php';

  if (isset($_SESSION['user'])) {
    destroySession();
    header('Location: index.php');
    exit;
  }
  else echo "<div class='center'>You cannot log out because
             you are not logged in</div>";
?>
    </div>
  </body>
</html>
