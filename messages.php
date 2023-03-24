<?php //messages.php
  require_once 'header.php';
  
  if (!$loggedin) die("</div></body></html>");

  if (isset($_GET['view'])) $view = $_GET['view'];
  else                      $view = $user;

  if (isset($_POST['text']))
  {
    $text = $_POST['text'];

    if ($text != "")
    {
      $pm   = substr($_POST['pm'],0,1);
      $time = time();
      queryMysql("INSERT INTO messages VALUES(NULL, '$user', '$view', '$pm', $time, '$text')");
    }
  }

  if ($view != "")
  {
    if ($view == $user) $name1 = $name2 = "Your";
    else
    {
      $name1 = "<a href='members.php?view=$view&r=$randstr'>$view</a>'s";
      $name2 = "$view's";
    }

    echo "<h3>$name1 Messages</h3>";
    showProfile($view);
    
    echo <<<_END
      <form method='post' action='messages.php?view=$view&r=$randstr'>
        <fieldset data-role="controlgroup" data-type="horizontal">
          <legend>Type here to leave a message</legend>
          <input type='radio' name='pm' id='public' value='0' checked='checked'>
          <label for="public">Public</label>
          <input type='radio' name='pm' id='private' value='1'>
          <label for="private">Private</label>
        </fieldset>
      <textarea name='text'></textarea>
      <input data-transition='slide' type='submit' value='Post Message'>
    </form><br>
_END;

    date_default_timezone_set('UTC');

    if (isset($_GET['erase']))
    {
      $erase = $_GET['erase'];
      queryMysql("DELETE FROM messages WHERE id='$erase' AND recip='$user'");
    }
    
    $query  = "SELECT * FROM messages WHERE recip='$view' ORDER BY time DESC";
    $result = queryMysql($query);
    $num    = $result->rowCount();

    while ($row = $result->fetch())
    {
      $id = $row['id'];
      $author = $row['auth'];
      $recipient = $row['recip'];
      $pm = $row['pm'];
      $time = $row['time'];
      $message_text = $row['message'];

      if ($pm == 0 || $author == $user || $recipient == $user)
      {
        echo date('M jS \'y g:ia:', $time);
        echo " <a href='messages.php?view=$author&r=$randstr'>$author</a> ";

        if ($pm == 0)
          echo "wrote: &quot;$message_text&quot; ";
        else
          echo "whispered: <span class='whisper'>&quot;$message_text&quot;</span> ";

        if ($recipient == $user)
          echo "[<a href='messages.php?view=$view&erase=$id&r=$randstr'>erase</a>]";

        echo "<br>";
      }
    }
  }

  if (!$num)
    echo "<br><span class='info'>No messages yet</span><br><br>";

  echo "<br><a data-role='button' href='messages.php?view=$view&r=$randstr'>Refresh messages</a>";
?>
</div>
</body>
</html>
