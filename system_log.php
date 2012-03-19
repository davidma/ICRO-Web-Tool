<?php    
 require("template/header.php");

 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>System Log</div>";
 echo "<div class='newscontent'>";

 if ($theSentry->login())
 {
     if ($theSentry->hasPermission(1)) 
     {
         // Display current log 
         $log_data = $theDB->fetchQuery("select distinct s.time,u.username,s.message from system_log s,users u where s.user_id = u.user_id order by s.log_id DESC");
   
         if (!$log_data)
         {
             echo 'No log entries<br/>'.$theDB->lastError();
         }
         else
         {
             print "<table width=100%>";
         
             for ($i=0; $i<count($log_data); $i++)
             {
                 print "<tr>";
                 print "<td style='border:1px solid #999999; background:#eeeeee;' width=20%>".$log_data[$i]['time']."</td>";
                 print "<td style='border:1px solid #999999; background:#eeeeee;' width=10%>".$log_data[$i]['username']."</td>";
                 print "<td style='border:1px solid #999999; background:#eeeeee;' width=70%>".$log_data[$i]['message']."</td>";
                 print "</tr>";
             }
              
             print "</table>";
         }
     }
     else
     {
         echo "Sorry - you don't have permission to view this page";
     }
 }
 else
 {
     echo "You need to be logged in to view this page - use the links above...";
 }

 // End the page
 echo "</div></div>";
 require("template/footer.html");
?>

