<?php    
 require("template/header.php");
?>

<div class='newsbox'>
<div class='newstitle'>Incident Center</div>
<div class='newscontent'>

<?php

 if ($theSentry->login())
 {

     // Get and check the rescue data for this ID
     if (isset($_GET['id']))
     {
         $rescue = $theDB->fetchQuery('select r.*,c.*from rescues r, caves c  where c.cave_id = r.cave_id and r.rescue_id = ' . $_GET['id']);
   
         if (!$rescue)
         {
             echo "Invalid Rescue ID selected";
             die();
         }
     }
     else
     {
         echo 'No incident selected';
         die();
     }

     $type = ($rescue[0]['type'] == 1) ? 'Rescue' : 'Rescue Practice';
     $status = ($rescue[0]['status'] == 1) ? 'Ongoing' : 'Finished';

     echo "<div class='rmenubox'><img src='images/cavemaps/".$rescue[0]['cave_id'].".png'></div>";
     
     // General info
     echo "<div class='halfboxheader'><b>Cave</b></div><div class='halfbox'>".$rescue[0]['name'].", ".$rescue[0]['county']."</div>";
     echo "<div class='halfboxheader'><b>Callout Type</b></div><div class='halfbox'>$type</div>";
     echo "<div class='halfboxheader'><b>Time Started</b></div><div class='halfbox'>".$rescue[0]['date']."</div>";
     echo "<div class='halfboxheader'><b>Callout Status</b></div><div class='halfbox'>$status</div>";
        
     echo "<div id='clear_both' style='clear:both;'></div><br/>";

     // Rescue details go here - editable if you have permissions
     echo "<div class='fullboxheader'><a href='#' id='detailstg' onclick=\"toggleDiv('details','detailstg');\"/>[-]</a> <b>Incident Details</b></div>";
     echo "<div class='fullbox' id='details'><pre>";
     echo $rescue[0]['comments'];
     echo "</pre></div>";
     echo "<br/>";

     // Display last 5 log entries
     echo "<div class='fullboxheader'><a href='#' id='logstg' onclick=\"toggleDiv('log','logstg');\"/>[-]</a> <b>Recent Log Entries</b></div>";
     echo "<div class='fullbox' id='log'>";
     
     $log_data = $theDB->fetchQuery("select distinct time,message from rescue_log where rescue_id=".$_GET['id']." order by time DESC limit 5");
   
     if (!$log_data)
     {
         echo 'No log entries for this rescue yet!';
     }
     else
     {
         print "<table width=100%>";
         
         for ($i=0; $i<count($log_data); $i++)
         {
             print "<tr>";
             print "<td style='border:1px solid #999999; background:#dddddd;' width=20%>".$log_data[$i]['time']."</td>";
             print "<td style='border:1px solid #999999; background:#dddddd;' width=80%>".$log_data[$i]['message']."</td>";
             print "</tr>";
         }
          
         print "</table>";
         
     }
     
     echo "</div>";
     echo "<br/>";

     // List of links which may be used in the rescue
     echo "<div class='fullboxheader'><a href='#' id='optionstg' onclick=\"toggleDiv('options','optionstg');\"/>[-]</a> <b>Incident Options</b></div>";
     echo "<div class='fullbox' id='options'>";
     echo "<ul>";
     if ($rescue[0]['status'] == 1)
     {
         echo "<li><a href='modify_details.php?id=".$_GET['id']."'>Modify main callout details</a></li>";
     }
     echo "<li><a href='rescue_log.php?id=".$_GET['id']."'>View / Update the main rescue log</a></li>";
     echo "<li><a href='cave.php?cave_id=".$rescue[0]['cave_id']."'>Get more information about the Cave</a></li>";

     if ($rescue[0]['status'] == 1)
     {
         echo "<li><a href='end_rescue.php?id=".$_GET['id']."'>End the rescue</a></li>";
     }

     echo "</ul>";
     echo "</div>";
     echo "<br/>";

     if ($rescue[0]['status'] == 1)
     {
         echo "<div class='fullboxheader'><a href='#' id='mgtstg' onclick=\"toggleDiv('mgt','mgtstg');\"/>[-]</a> <b>Personnel Management</b></div>";
         echo "<div class='fullbox' id='mgt'>";
         echo "<ul>";
         echo "<li><a href='show_cavers.php?id=".$_GET['id']."'>View the list of cavers involved in this rescue</a></li>";
         echo "<li><a href='target_search.php?RID=".$_GET['id']."'>Find ICRO Members to assist in this callout</a>";
         echo "</ul>";
         echo "</div>";
     }
 }
 else
 {
     echo "You need to be logged in to view this page - use the links above...";
 }
?>


</div>
</div>

<?php
 require("template/footer.html");
?>

