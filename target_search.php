<?php    
 // Start the page
 require("template/header.php");
 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>Targeted User Search</div>";
 echo "<div class='newscontent'>";

 if ($theSentry->login())
 {
     if (isset($_GET['RID']))
     {
         echo "<div class='fullbox'>";
         echo "<center>";
         echo "<form method=GET action='target_search.php'>";
         echo "<input type=hidden name=LAT value=".$_GET['LAT'].">";
         echo "<input type=hidden name=LNG value=".$_GET['LNG'].">";
         echo "<input type=hidden name=RID value=".$_GET['RID'].">";
         echo "Search for ";
         echo "<select name='num'>";
         echo "<option value='5'>5</option>";
         echo "<option value='10'>10</option>";
         echo "<option value='15'>15</option>";
         echo "<option value='20'>20</option>";
         echo "<option value='50'>50</option>";
         echo "<option value='500' selected>All</option>";
         echo "</select> ";
         echo " available cavers in ";
         echo "<select name='group'>";
         echo "<option value='2'>Wardens</option>";
         echo "<option value='3'>Core Team</option>";
         echo "<option value='4' selected>All Groups</option>";
         echo "</select> ";
         echo "within "; 
         echo "<select name='distance'>";
         echo "<option value='20'>20</option>";
         echo "<option value='50'>50</option>";
         echo "<option value='100'>100</option>";
         echo "<option value='500' selected>Any</option>";
         echo "</select> miles of incident ";
         echo "with any (or none) of the following roles:<br/><br/>";

         $roles = $theDB->fetchQuery('select * from roles where role_id > 4;');

         if (!$roles) { echo "No roles found"; die(); }

         echo "<table width=100% style='border:1px solid #999999'><tr>";

         for ($i=1; $i<count($roles); $i++)
         {
             echo "<td width=20%><INPUT NAME='roles[]' TYPE='CHECKBOX' VALUE='".$roles[$i]['role_id']."'>".$roles[$i]['role']."</td>";
   
             // Newline every 5 checkboxes
             if ($i > 0 && $i % 5 == 0)
             {
                 echo "</tr><tr>";
             }
         }
         echo "</tr></table>";

         echo "<br/><input type=submit>";
         echo "</form>";
         echo "</center>";
         echo "</div>";

         // Time to show results?
         if (isset($_GET['group']) && isset($_GET['distance']))
         { 
             // if any roles were selected
             if (isset($_GET['roles']))
             {
                 $role_array = $_GET['roles'];
                 $role_sql   = "and r.role_id in (0";

                 for ($i=0; $i<count($role_array); $i++)
                 {
                     $role_sql .= "," . $role_array[$i];
                 }
      
                 $role_sql .= ")";
             }

             $cave_data =  $theDB->fetchQuery("select c.lat,c.lng from caves c, rescues r where c.cave_id = r.cave_id and r.rescue_id = ".$_GET['RID']);

             $cave_lat = $cave_data[0]['lat'];
             $cave_lng = $cave_data[0]['lng'];

             $sqlstring = "select DISTINCT u.lat, u.lng, CONCAT(u.first_name,' ',u.last_name) as dsc, u.mobile_phone, u.user_id, ROUND(((ACOS(SIN(".$cave_lat." * PI() / 180) * SIN(u.lat * PI() / 180) + COS(".$cave_lat."* PI() / 180) * COS(u.lat * PI() / 180) * COS((".$cave_lng." - u.lng) * PI() / 180)) * 180 / PI()) * 60 * 1.1515),3) AS distance from users u, user_roles r where u.user_id = r.user_id and u.user_id in (select u.user_id from users u, user_roles r, user_status s where u.user_id = r.user_id and u.user_id = s.user_id and s.status_id = 0 and r.role_id = ".$_GET['group'].") $role_sql HAVING distance < ".$_GET['distance']." ORDER BY distance limit " . $_GET['num'];
    
             echo $sqlstring;
 
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
 
                 echo "<tr><td width=40%><b>Name</b></td><td width=30%><b>Mobile Number</b></td><td width=30%><b>Miles from Incident</b></td><td colspan=2><b>Callout</b></td></tr>";

                 $user_string="";
                 
                 for ($i=0; $i<count($userlist); $i++)
                 {
                     echo "<tr>";
                     echo "<td style='border:1px solid #999999' width=30%>".$userlist[$i]['dsc']."</td>"; 
                     echo "<td style='border:1px solid #999999' width=30%>+".$userlist[$i]['mobile_phone']."</td>"; 
                     echo "<td style='border:1px solid #999999' width=30%>".$userlist[$i]['distance']."</td>"; 
                     echo "<td style='border:1px solid #999999' width=5%><a href='rescue_sms_out.php?rescue_id=".$_GET['RID']."&user_ids[]=".$userlist[$i]['user_id']."'>SMS</a></td>";
                     echo "<td style='border:1px solid #999999' width=5%><a href='change_state.php?rescue_id=".$_GET['RID']."&user_id=".$userlist[$i]['user_id']."'>Manual</a></td>";
                     echo "</tr>";
                     
                     $user_string .= "&user_ids[]=".$userlist[$i]['user_id'];
                 }

                 echo "<tr><td colspan=4 align=center><a href='rescue_sms_out.php?rescue_id=".$_GET['RID']."$user_string'>Send an SMS to all these ICRO Members</a></td></tr>";
                 echo "</table>";
                 echo "</div>";
             }
         }
		 				 				 
		 echo "<center>";
		 echo "<br/>Return to <a href='view_callout.php?id=".$_GET['RID']."'>Incident Page?</a>";
		 echo "</center>";
     }
     else
     {
         echo "You must specify a valid rescue";
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
