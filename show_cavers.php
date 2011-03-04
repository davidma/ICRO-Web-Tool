<?php    
 require("template/header.php");
?>

<div class='newsbox'>
<div class='newstitle'>Incident Resource List</div>
<div class='newscontent'>

<?php
 if ($theSentry->login())
 {
     if (isset($_GET['id']))
	 {
         $userlist = $theDB->fetchQuery("SELECT DISTINCT *  FROM user_status us, status s, users u WHERE us.status_id = s.status_id AND us.user_id = u.user_id and us.rescue_id = ".$_GET['id']." ORDER by us.status_id desc;");

         if(!$userlist)
         {
             echo "No users found";
         }
         else
         {
             echo "<table width=100%>";
 
             echo "<tr><td width=45%><b>Name</b></td><td width=20%><b>Status</b></td><td width=14%><b>ETA (mins)</b></td><td colspan=2><b>Change Status</b></td></tr>";
			 
             for ($i=0; $i<count($userlist); $i++)
             {
                 echo "<tr>";
                 echo "<td style='border:1px solid #999999; background:#eeeeee;' width=45%>".$userlist[$i]['first_name']." ".$userlist[$i]['last_name']."</td>"; 
                 echo "<td style='border:1px solid #999999; background:#eeeeee;' width=20%>".$userlist[$i]['status']."</td>"; 
                 if ($userlist[$i]['status'] == 'On Route')
                 {
                     echo "<td style='border:1px solid #999999; background:#eeeeee;' width=14%>".$userlist[$i]['eta']."</td>";
                 }
                 else
                 {
                     echo "<td style='border:1px solid #999999; background:#eeeeee;' width=14%>n/a</td>";
                 }
                 echo "<td style='border:1px solid #999999; background:#eeeeee;' width=8%><a href='rescue_sms_out.php?rescue_id=".$_GET['id']."&user_ids[]=".$userlist[$i]['user_id']."'>SMS</a></td>";
                 echo "<td style='border:1px solid #999999; background:#eeeeee;' width=8%><a href='change_state.php?rescue_id=".$_GET['id']."&user_id=".$userlist[$i]['user_id']."'>Manual</a></td>";

                 echo "</tr>";
             }

             echo "</table>";
         }
		 			 
		 echo "<center>";
	     echo "<br/>Return to <a href='view_callout.php?id=".$_GET['id']."'>Incident Page?</a>";
	     echo "</center>";
     }
	 else
	 {
	     echo "No rescue specified!";
     }
 }
 else
 {
     echo "You need to be logged in to view userlist - use the links above...";
 }
?>


</div>
</div>

<?php
 require("template/footer.html");
?>

