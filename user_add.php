<?php    
 require("template/header.php");
?>

<div class='newsbox'>
<div class='newstitle'>Add a New User</div>
<div class='newscontent'>


<?php

if (isset($_POST['submit'])) 
{
  if (!$_POST['uname'] | !$_POST['passwd'] | !$_POST['passwd_again'] | !$_POST['email'] | !$_POST['fname'] | !$_POST['lname'] | !$_POST['location1'] | !$_POST['location2'] | !$_POST['mobile']) 
  {
      echo('You did not fill in a required field. - <a href="user_add.php">try again?</a>');
  }
  else
  {
      if (!get_magic_quotes_gpc()) 
      {
          $_POST['uname'] = addslashes($_POST['uname']);
      }

      $name_check = $theDB->fetchQuery("SELECT username FROM users WHERE username = '".$_POST['uname']."'");

      if (isset($name_check['username'])) 
      {
          echo('Sorry, the username: <strong>'.$_POST['uname'].'</strong> is already taken, please <a href="user_add.php">pick another one</a>.');
      }
      else
      {
          if ($_POST['passwd'] != $_POST['passwd_again']) 
          {
              echo('Passwords did not match - <a href="user_add.php">try again?</a>');
          }
          else
          {
              if ($_POST['email'] != $_POST['email_again'])
              {
                  echo('Email Addresses did not match - <a href="user_add.php">try again?</a>');
              }
              else
              {
                  if (!$theValidator->validateEmail($_POST['email'])) 
                  {
                      echo('Invalid e-mail address - <a href="user_add.php">try again?</a>');
                  } 
                  else
                  {
                      $_POST['uname'] = strip_tags($_POST['uname']);
                      $_POST['passwd'] = strip_tags($_POST['passwd']);
                      $_POST['location'] = strip_tags($_POST['location']);

                      $_POST['passwd'] = sha1($_POST['passwd']);

                      if (!get_magic_quotes_gpc()) 
                      {
                          $_POST['passwd'] = addslashes($_POST['passwd']);
                          $_POST['email'] = addslashes($_POST['email']);
                          $_POST['location'] = addslashes($_POST['location']);
                      }

                      $regdate = date('Y-m-d H:i:s');

                      $insert = "INSERT INTO users (
                                       username,
                                       first_name,
				       last_name, 
                                       password, 
                                       active,
                                       lat,
                                       lng,
                                       regdate, 
                                       email, 
                                       address_line1,
				       address_line2,
				       town,
				       county,
				       postcode, 
                                       mobile_phone,
                                       home_phone,
                                       work_phone,
                                       other_phone,
				       ffs_num) 
                                       VALUES (
                                       '".$_POST['uname']."', 
                                       '".$_POST['fname']."',
				       '".$_POST['lname']."', 
                                       '".$_POST['passwd']."', 
                                       1,
                                       53.1265,
                                       -6.75655,
                                       '$regdate', 
                                       '".$_POST['email']."', 
                                       '".$_POST['location1']."', 
                                       '".$_POST['location2']."',
				       '".$_POST['locationTown']."',
				       '".$_POST['county']."',
				       '".$_POST['postcode']."',
				       '".$_POST['mobile']."',
                                       '".$_POST['home']."',
                                       '".$_POST['work']."',
                                       '".$_POST['other']."',
				       '".$_POST['ffsno']."')";


                      $result = $theDB->doQuery($insert);

                      if (!result) 
                      {
                          print 'Error adding user to DB - '.$theDB->lasterror().' - <a href="user_add.php">try again?</a>';
                      }
                      else
                      {
                          $res = $theDB->fetchQuery("select user_id from users where username = '".$_POST['uname']."'");

                          if ($theDB->doQuery("insert into user_status set user_id = ".$res[0]['user_id']))
                          {
                              if ($theDB->doQuery("insert into user_roles set user_id = ".$res[0]['user_id'].", role_id = 4"))
                              {
                                  $theLogger->log("Created new user ".$_POST['uname']." using full user add page"); 
                                  $theLogger->log("User ".$_POST['uname']." assigned Status 0 (Available)");
                                  $theLogger->log("User ".$_POST['uname']." assigned Role 4 (General Member)");


                                  echo 'User details added to the DB<br/><br/>'; 
                                  echo 'They can now <a href="login.php">login</a> to access the sites features.';
                              }
                              else
                              {
                                  echo 'Error adding default Role entry for user<br/><br/>';
                              }
                          }
                          else
                          {
                              echo 'Error adding Status entry for user<br/><br/>';
                          }
                      }
                  }
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
<tr><td>Username*:</td><td>
<input type="text" name="uname" maxlength="50">
</td></tr>
<tr><td>First Name*:</td><td>
<input type="text" name="fname" maxlength="50">
</td></tr>
<tr><td>Last Name*:</td><td>
<input type="text" name="lname" maxlength="50">
</td></tr>
<tr><td>Password*:</td><td>
<input type="password" name="passwd" maxlength="50">
</td></tr>
<tr><td>Confirm Password*:</td><td>
<input type="password" name="passwd_again" maxlength="50">
</td></tr>
<tr><td>E-Mail*:</td><td>
<input type="text" name="email" maxlength="100">
</td></tr>
<tr><td>Confirm E-Mail*:</td><td>
<input type="text" name="email_again" maxlength="100">
</td></tr>
<tr><td>Address Line 1:*</td><td>
<input type="text" name="location1" maxlength="100">
</td></tr>
<tr><td>Address Line 2:*</td><td>
<input type="text" name="location2" maxlength="100">
</td></tr>
<tr><td>Town:</td><td>
<input type="text" name="locationTown" maxlength="100">
</td></tr>
<tr><td>County:*</td><td>
<input type="text" name="county" maxlength="100">
</td></tr>
<tr><td>Postcode:</td><td>
<input type="text" name="postcode" maxlength="100">
</td></tr>
<tr><td>Mobile Contact Number:*</td><td>
<input type="text" name="mobile" maxlength="100">
</td></tr>
<tr><td>Home Contact Number:</td><td>
<input type="text" name="home" maxlength="100">
</td></tr>
<tr><td>Work Contact Number:</td><td>
<input type="text" name="work" maxlength="100">
</td></tr>
<tr><td>Other Contact Number:</td><td>
<input type="text" name="other" maxlength="100">
</td></tr>
<tr><td>FFS Insurance No:</td><td>
<input type="text" name="ffsno" maxlength="100">
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
