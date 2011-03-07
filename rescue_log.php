<?php    
 require("template/header.php");

 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>Rescue Log</div>";
 echo "<div class='newscontent'>";

 if ($theSentry->login())
 {

     // Get and check the rescue data for this ID
     if (isset($_GET['id']))
     {
             // cheack if rescue is active
             $res = $theDB->fetchQuery("select status from rescues where rescue_id = ".$_GET['id']);

             $status = ($res) ? $res[0]['status'] : 0;

	     //display the form to add new entries, if you are a warden or callout officer
		 if ($status && ($theSentry->hasPermission(2) || $theSentry->hasPermission(8)))
		 {
		     $currdatetime = date('Y-m-d H:i:s');
		 
		     echo "<center>";
		     echo "<form method='get' action='rescue_log.php'>";
			 echo "<input type=text name='ctime' size=18 value='$currdatetime' readonly/>";
			 echo "<input type=text name='message' size=90 value = '' maxlength=500/>";
			 echo "<input type=hidden name=id value='".$_GET['id']."'/>";
			 echo "<input type=submit value='Log Message'/>";
			 echo "</form>";
			 echo "</center>";
	     }

         // Insert new record if set
         if (isset($_GET['message']) && isset($_GET['ctime']))
         {
             if (! $theDB->doQuery("insert into rescue_log set rescue_id=".$_GET['id'].",time='".$_GET['ctime']."',message='".mysql_escape_string($_GET['message'])."';"))
			 {
			     echo "ERROR - Couldn't record Log - ".$theDB->lastError()."<br/>";
			 }
		 }
	 
	     // Display current log  
         $log_data = $theDB->fetchQuery("select distinct time,message from rescue_log where rescue_id=".$_GET['id']." order by time DESC");
   
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
				 print "<td style='border:1px solid #999999; background:#eeeeee;' width=20%>".$log_data[$i]['time']."</td>";
				 print "<td style='border:1px solid #999999; background:#eeeeee;' width=80%>".$log_data[$i]['message']."</td>";
				 print "</tr>";
		     }
			  
			 print "</table>";
			 
			 echo "<center>";
			 echo "<br/>Return to <a href='view_callout.php?id=".$_GET['id']."'>Incident Page?</a>";
			 echo "</center>";
		 
		 }
     }
     else
     {
	     echo "Invalid Rescue ID selected";
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

