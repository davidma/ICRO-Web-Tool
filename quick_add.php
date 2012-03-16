<?php    
 require("template/header.php");
?>

<div class='newsbox'>
<div class='newstitle'>Add a New User (Quickly)</div>
<div class='newscontent'>


<?php

if (isset($_POST['submit'])) 
{
  if (!$_POST['fname'] | !$_POST['lname'] | !$_POST['mobile']) 
  {
      echo('You did not fill in a required field. - <a href="user_add.php">try again?</a>');
  }
  else
  {
      ## Quick username and password
      $username = strtolower($_POST['fname'] . "." . $_POST['lname']);
      $username = str_replace("'",'',$username);
      $username = str_replace("-",'',$username);

      $name_check = $theDB->fetchQuery("SELECT username FROM users WHERE username = '".$username."'");

      if (isset($name_check['username'])) 
      {
          echo('Sorry, the username: <strong>'.$username.'</strong> is already taken, please <a href="quick_add.php">pick another one</a>.');
      }
      else
      {

          $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
          $pw_random = "";    

          for ($p = 0; $p < 12; $p++) {
              $pw_random .= $characters[mt_rand(0, strlen($characters))];
          }

          $password = sha1($pw_random);
          $regdate = date('Y-m-d H:i:s');

          $insert = "INSERT INTO users (
                                       username,
                                       first_name,
				       last_name, 
                                       password, 
                                       email,
                                       active,
                                       county,
                                       lat,
                                       lng,
                                       regdate, 
                                       mobile_phone)
                                       VALUES (
                                       '".$username."', 
                                       '".addslashes($_POST['fname'])."',
				       '".addslashes($_POST['lname'])."', 
                                       '".$password."', 
				       '".addslashes($_POST['email'])."', 
                                       1,
                                       'Dublin',
                                       53.1265,
                                       -6.75655,
                                       '$regdate', 
				       '".$_POST['mobile']."')";

                      $result = $theDB->doQuery($insert);

                      if (!result) 
                      {
                          print 'Error adding user to DB - '.$theDB->lasterror().' - <a href="user_add.php">try again?</a>';
                      }
                      else
                      {
                          $res = $theDB->fetchQuery("select user_id from users where username = '".$username."'");

                          if ($theDB->doQuery("insert into user_status set user_id = ".$res[0]['user_id']))
                          {
                              if ($theDB->doQuery("insert into user_roles set user_id = ".$res[0]['user_id'].", role_id = 4"))
                              {
                                  $theLogger->log("Created new user ".$username." using quick user add page");
                                  $theLogger->log("User ".$username." assigned Status 0 (Available)");
                                  $theLogger->log("User ".$username." assigned Role 4 (General Member)");

                                  echo 'User details added to the DB<br/>';
                                  echo '<br/>'; 
                                  echo 'Username: '.$username.'<br/>';
                                  echo 'Password: '.$pw_random.'<br/>';
                                  echo '<br/>'; 
                                  echo 'They can now <a href="login.php">login</a> to access the sites features.';
                              }
                              else
                              {
                                  echo 'Error adding default Role entry for user<br/><br/>';
                                  echo $theDB->lastError().'<br/>';
                              }
                          }
                          else
                          {
                              echo 'Error adding Status entry for user<br/><br/>';
                              echo $theDB->lastError().'<br/>';
                          }
                      }
      }
  } 
} 
else 
{

?>

<br/>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<table align="center" border="1" cellspacing="0" cellpadding="3">
<tr><td>First Name*:</td><td>
<input type="text" name="fname" maxlength="50">
</td></tr>
<tr><td>Last Name*:</td><td>
<input type="text" name="lname" maxlength="50">
</td></tr>
<tr><td>Mobile Contact Number:*</td><td>
<input type="text" name="mobile" maxlength="100">
</td></tr>
<tr><td>Email Address (if known):</td><td>
<input type="text" name="email" maxlength="100">
</td></tr>
<tr><td colspan="2" align="right">
<input type="submit" name="submit" value="Create User">
</td></tr>
</table>
</form>

<?php

}

?>

</div>
</div>

<?php
 require("template/footer.html");
?>
