<?php    

 // Start the page
 require("template/header.php");
 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>Change Password</div>";
 echo "<div class='newscontent'>";

 // If its a non-logged in user, display public text
 if (!$theSentry->login())
 {
     echo "You need to be logged in to view this page"; 
 }
 else
 {
     if (isset($_POST['do_modify']))
     {
             if (!$_POST['passwd1'] | !$_POST['passwd2'] | !$_POST['passwd'])
             {
                 echo('You did not fill in a required field. - <a href="change_password">try again?</a>');
             }
             else
             {
                 if ($_POST['passwd1'] != $_POST['passwd2'])
                 {
                     echo 'Passwords do not match - <a href="change_password">try again?</a>';
                 }
                 else
                 {
                     $res = $theDB->fetchQuery("select password from users where user_id = '".$_SESSION['user_id']."';");

                     if (!$res)
                     {
                         echo "Unknown user";
                         die();
                     }
                     else
                     {
                         if (sha1($_POST['passwd']) == $res[0]['password'])
                         {
                             $update = "update users set password = '".sha1($_POST['passwd1'])."' where user_id = '".$_SESSION['user_id']."';";

                             $result = $theDB->doQuery($update);

                             if (!result)
                             {
                                 print 'Error updating password in DB - '.$theDB->lasterror().' - <a href="change_password.php">try again?</a>';
                             }
                             else
                             {
                                 $theLogger->log("Password manually changed for user ".$_SESSION['username']);
                                 echo '<br/>Password details successfully updated<br/><br/>';
                             }
                        }
                        else
                        {
                             echo 'Current Password does not match records - <a href="change_password">try again?</a>';
                        }
                    }
               }
          }
     }
     else
     {
                 echo "<form action=\"change_password.php\" method=\"post\">";
                 echo "<table align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">";
                 echo "<tr><td>Current Password*:</td><td>";
                 echo "<input type=\"password\" name=\"passwd\" maxlength=\"50\">";
                 echo "</td></tr>";
                 echo "<tr><td>New Password*:</td><td>";
                 echo "<input type=\"password\" name=\"passwd1\" maxlength=\"50\">";
                 echo "</td></tr>";
                 echo "<tr><td>Confirm New Password*:</td><td>";
                 echo "<input type=\"password\" name=\"passwd2\" maxlength=\"50\">";
                 echo "</td></tr>";
                 echo "<tr><td colspan=\"2\" align=\"right\">";
                 echo "<input type=\"submit\" name=\"do_modify\" value=\"Change Password\">";
                 echo "</td></tr>";
                 echo "</table>";
                 echo "</form>";
     }
 }
 
 // End the page
 echo "<div id='clear_both' style='clear:both;'></div></div>";
 require("template/footer.html");
?>

