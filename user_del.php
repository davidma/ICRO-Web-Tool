<?php    

 // Start the page
 require("template/header.php");
 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>Delete a user</div>";
 echo "<div class='newscontent'>";

 // If its a non-logged in user, display public text
 if (!$theSentry->login())
 {
     echo "You need to be logged in to view this page"; 
 }
 else
 {
     if ($theSentry->hasPermission(8))
     {
         if (isset($_POST['user_id']))
         {
              // delete the entry associated with that name....
              $res = $theDB->doQuery("delete u,ur,us from users u, user_roles ur, user_status us where ur.user_id = u.user_id and us.user_id = u.user_id and u.user_id = '".$_POST['user_id']."';");
       
              if (!$res)
              {
                   echo "Invalid username!";
                   die();
              }
              else
              {
                  echo "Information for user <b><u>".$_POST['username2']."</u></b> deleted successfully;";
              }
                
         }
         else
         {
             echo "Select a User to delete:<br/><br/>";
             echo "<form action='" . $_SERVER['PHP_SELF'] ."' method='post'>";
              
             $res = $theDB->fetchQuery("select user_id,first_name,last_name from users;");

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

             echo "<INPUT TYPE='submit' onClick='javascript:return confirm('Are you sure you want to delete this user?')' id='deleteCaver' value='Delete Caver'/>";
             echo "</form>";
         }
     }
 }
 
 // End the page
 echo "<div id='clear_both' style='clear:both;'></div></div>";
 require("template/footer.html");
?>

