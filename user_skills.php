<?php    

 // Start the page
 require("template/header.php");
 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>Update User Skills</div>";
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
         if (isset($_POST['roles']))
         {
             $role_array = $_POST['roles'];

             $theLogger->log("Clearing skills for user id ".$_POST['user_id']);
             $theDB->doQuery("delete from user_roles where user_id = '".$_POST['user_id']."' and role_id > 100;");

             for ($i=0; $i<count($role_array); $i++)
             {
                 $res = $theDB->doQuery("insert into user_roles values (".$_POST['user_id'].",".$role_array[$i].");");
  
                 if ($res)
                 {
                     $theLogger->log("Added role ".$role_array[$i]." for user id ".$_POST['user_id']);
                     echo "Added skill ".$role_array[$i]." for user <br/>";
                 }
                 else
                 {
                     echo "Failed to add skill ".$role_array[$i]." for user ".$theDB->lasterror()."<br/>";
                 }
             }
            
             echo "<br/>View users <a href='profile.php?user_id=".$_POST['user_id']."'>profile?</a><br/>";
         }
         else if (isset($_POST['user_id']))
         {
             echo "Select the skills appropriate to this user:<br/><br/>";
             echo "<form action='user_skills.php' method='post'>";
             echo "<input type='hidden' name='user_id' value='".$_POST['user_id']."'>";

             $result = $theDB->fetchQuery('select role_id from user_roles where user_id = '.$_POST['user_id']);

             $user_roles = array();
             for ($i=0; $i<count($result); $i++)
             {
                 array_push($user_roles,$result[$i]['role_id']);
             }

             $roles = $theDB->fetchQuery('select * from roles where role_id > 100;');
             if (!$roles) { echo "No roles found"; die(); }

             for ($i=0; $i<count($roles); $i++)
             {
                 if (in_array($roles[$i]['role_id'],$user_roles))
                 {
                     echo "<INPUT NAME='roles[]' TYPE='CHECKBOX' VALUE='".$roles[$i]['role_id']."' CHECKED>".$roles[$i]['role']."  ";
                 }
                 else
                 {
                     echo "<INPUT NAME='roles[]' TYPE='CHECKBOX' VALUE='".$roles[$i]['role_id']."'>".$roles[$i]['role']."  ";
                 }

                 echo "<br/>";
             }

             echo "<br/><input type=submit value='Update Skills'>";
             echo "</form>";
         }
         else
         {
             echo "Select a User to modify:<br/><br/>";
             echo "<form action='user_skills.php' method='post'>";

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

             echo "<INPUT TYPE='submit' value='Modify User Skills'/>";
             echo "</form>";
         }
     }
 }
 
 // End the page
 echo "<div id='clear_both' style='clear:both;'></div></div>";
 require("template/footer.html");
?>

