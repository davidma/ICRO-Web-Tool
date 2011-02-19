<?php    
 require("template/header.php");

 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>Login to the System</div>";
 echo "<div class='newscontent'>";

 if(isset($_SESSION['username'])) 
 {
    echo 'You are already logged in, '.$_SESSION['username'].'.';
    echo "<meta http-equiv=\"refresh\" content=\"0;index.php\">";
 }

 if (isset($_POST['submit']))
 {
    if(!$_POST['uname'] | !$_POST['passwd']) 
    {
      echo 'You did not fill in a required field - <a href="login.php">try again?</a>';
    }
    else
    {
        if (!$theSentry->login($_POST['uname'],sha1($_POST['passwd'])))
        {
            print 'Login error - <a href="login.php">try again?</a>';
        }
        else
        {
            $theLogger->log("User ".$_SESSION['username']." logged in");
            echo "<meta http-equiv=\"refresh\" content=\"0;index.php\">";
        }
    }
 } 
 else 
 {
      echo '<br/>';
      echo '<form action="' . $_SERVER['PHP_SELF'] .'" method="post">';
      echo '<table align="center" border="1" cellspacing="0" cellpadding="3">';
      echo '<tr><td>Username:</td><td>';
      echo '<input type="text" name="uname" maxlength="40">';
      echo '</td></tr>';
      echo '<tr><td>Password:</td><td>';
      echo '<input type="password" name="passwd" maxlength="50">';
      echo '</td></tr>';
      echo '<tr><td colspan="2" align="right">';
      echo '<input type="submit" name="submit" value="Login">';
      echo '</td></tr>';
      echo '</table>';
      echo '</form>';
 }

 echo '</div></div>';

 require("template/footer.html");
?>
