<?php    
 // Start the page
 require("template/header.php");
 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>Training Search</div>";
 echo "<div class='newscontent'>";

 if ($theSentry->login())
 {
     if ($theSentry->hasPermission(5))
     {
         echo "<div class='fullbox'>";
         echo "<center>";
         echo "<form method=POST action='training_search.php'>";
         echo "Search for ";
         echo "<select name='valid_only'>";
         echo "<option value='1' selected> currently valid</option>";
         echo "<option value='0'>all</option>";
         echo "</select> ";
         echo " training events for users in ";
         echo "<select name='group'>";
         echo "<option value='2'>Wardens</option>";
         echo "<option value='3'>Core Team</option>";
         echo "<option value='4' selected>All Groups</option>";
         echo "</select> ";
         echo " with any (or none) of the following training:<br/><br/>";

         $roles = $theDB->fetchQuery('select * from training_courses');

         if (!$roles) { echo "No courses found"; die(); }

         echo "<select name='roles[]' multiple size=5>";

         for ($i=0; $i<count($roles); $i++)
         {
             echo "<option VALUE='".$roles[$i]['course_id']."'>".$roles[$i]['name']."</option>";
         }

         echo "</select>";
         echo "<br/><small><i>(use SHIFT or CTRL to select multiple values)</i></small>";
         echo "<br/><br/><input type=submit>";
         echo "</form>";
         echo "</center>";
         echo "</div>";

         // Time to show results?
         if (isset($_POST['group']))
         { 
             $role_array = $_POST['roles'];
             $role_sql   = "and tc.course_id in (0";

             for ($i=0; $i<count($role_array); $i++)
             {
                 $role_sql .= "," . $role_array[$i];
             }
      
             $role_sql .= ")";

             if ($_POST['valid_only'])
             {
                 $sqlstring = "select u.first_name,u.last_name,tc.name,t.valid_from,t.valid_to,if(t.valid_to > now(),1,0) as valid from users u, training t, training_courses tc where u.user_id = t.user_id and tc.course_id = t.course_id and t.valid_to > now() $role_sql"; 
             }
             else
             {
                 $sqlstring = "select u.first_name,u.last_name,tc.name,t.valid_from,t.valid_to,if(t.valid_to > now(),1,0) as valid from users u, training t, training_courses tc where u.user_id = t.user_id and tc.course_id = t.course_id $role_sql"; 
             }

             $userlist = $theDB->fetchQuery($sqlstring);

             if(!$userlist)
             {
                 echo "No data returned";
             }
             else
             {                  
                 // Tabulate the results
                 echo "<div class='fullbox'>";
                 echo "<table width=100% style='border:1px solid #999999'>";
 
                 echo "<tr><td width=30%><b>Name</b></td><td width=40%><b>Course</b></td><td width=15%><b>Date Attended</b></td><td width=15%><b>Valid Until</b></td></tr>";

                 $user_string="";
                 
                 for ($i=0; $i<count($userlist); $i++)
                 {
                     echo "<tr>";
                     echo "<td style='border:1px solid #999999' width=30%>".$userlist[$i]['first_name']." ".$userlist[$i]['last_name']."</td>"; 
                     echo "<td style='border:1px solid #999999' width=40%>".$userlist[$i]['name']."</td>"; 
                     echo "<td style='border:1px solid #999999' width=15%>".$userlist[$i]['valid_from']."</td>"; 
   
                     if ($userlist[$i]['valid'])
                     {
                         echo "<td style='border:1px solid #999999' width=15%>".$userlist[$i]['valid_to']."</td>"; 
                     }
                     else
                     {
                         echo "<td style='border:1px solid #999999; background: #FF0000;' width=15%>".$userlist[$i]['valid_to']."</td>"; 
                     }
                     echo "</tr>";
                 }

                 echo "</table>";
                 echo "</div>";
             }
         }
     }
     else
     {
         echo "You do not have permission to view this";
     }
 }
 else
 {
     echo "You must be logged in to view this page";
 } 

 // End the page
 echo "</div></div>";
 require("template/footer.html");
?>
