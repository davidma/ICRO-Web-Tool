<?php    

 // Start the page
 require("template/header.php");
 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>Modify a user</div>";
 echo "<div class='newscontent'>";

 // If its a non-logged in user, display public text
 if (!$theSentry->login())
 {
     echo "You need to be logged in to view this page"; 
 }
 else
 {
     if ($theSentry->hasPermission(2))
     {
         if (isset($_POST['user_id']))
         {
              $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
              $pw_random = "";

              for ($p = 0; $p < 12; $p++) 
              {
                  $pw_random .= $characters[mt_rand(0, strlen($characters))];
              }

              $password = sha1($pw_random);

              $insert = "update users set password = '$password' where user_id = '".$_POST['user_id']."';"; 

              $result = $theDB->doQuery($insert);

              if (!result)
              {
                   print 'Error adding user to DB - '.$theDB->lasterror().' - <a href="user_add.php">try again?</a>';
              }
              else
              {
                  $res = $theDB->fetchQuery("select * from users where user_id = '".$_POST['user_id']."';");

                  $to = $res[0]['email'];
                  $subject = "[ICRO] Password Reset for Website";
                  $from = "ICRO Mailer <no-reply@icro.ie>";
                  $headers = "From: $from";
                  $url = "http://icro.dyndns-ip.com/icro";
                  $message = "Hello ".$res[0]['first_name'].",\n\nYour password has been reset for a demo of the icro web tool, temporarily hosted at $url\nYou can now log in with the following details:\n\nUsername: ".$res[0]['username']."\nPassword: ".$pw_random."\n\nOnce you log in, you can change your password from the main menu page.\n\nHave a good day!,\n\nICRO Web Team";

                  mail($to,$subject,$message,$headers);
                  
                  $theLogger->log("Password reset for user ".$res[0]['username']." and email sent");
                  echo "Password changed for user - email sent to ".$res[0]['email']."<br/>";
              }
         }
         else
         {
             echo "Select a User to modify:<br/><br/>";
             echo "<form action='reset_password.php' method='post'>";

             $res = $theDB->fetchQuery("select user_id,first_name,last_name from users order by last_name;");

             if (!$res)
             {
                 echo "No Users found!";
                 die();
             }
             else
             {
                 echo "<select name=user_id>";

                 for ($i=0; $i<count($res); $i++)
                 {
                     echo "<option value='".$res[$i]['user_id']."'>".$res[$i]['last_name'].", ".$res[$i]['first_name']."</option>";
                 }

                 echo "</select>";
             }

             echo "<INPUT TYPE='submit' onClick='javascript:return confirm('Are you sure you want to reset this users password?')' value='Reset Password'/>";
             echo "</form>";
         }
     }
 }
 
 // End the page
 echo "<div id='clear_both' style='clear:both;'></div></div>";
 require("template/footer.html");
?>
