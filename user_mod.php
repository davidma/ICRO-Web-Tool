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
             echo "Select a User to modify:<br/><br/>";
             echo "<form action='edit_profile.php' method='get'>";

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

             echo "<INPUT TYPE='submit' value='Modify User'/>";
             echo "</form>";
     }
 }
 
 // End the page
 echo "<div id='clear_both' style='clear:both;'></div></div>";
 require("template/footer.html");
?>
