<?php    
 require("template/header.php");
?>

<div class='newsbox'>
<div class='newstitle'>Incident Resource List</div>
<div class='newscontent'>

<?php
 if ($theSentry->login())
 {
     if (isset($_GET['id']) and isset($_GET['commit']))
     {
         if ($theSentry->hasPermission(2) || $theSentry->hasPermission(8))
         {
             // Unlink all the users
             if ($theDB->doQuery("update user_status set status_id = 0, rescue_id = 0 where rescue_id = ".$_GET['id']))
             {
                 echo "All active rescuers unlinked from rescue, put back to available status<br/>";
             }
             
             if ($theDB->doQuery("update rescues set status = 0 where rescue_id = ".$_GET['id']))
             {
                 echo "Rescue state set to finished<br/>";
             }

             if ($theDB->doQuery("insert into rescue_log set rescue_id = ".$_GET['id'].", time=now(), message='Rescue ended by user ".$_SESSION['username']."'"))
             {
                 echo "Rescue finish time recorded into log<br/>";
             }

             echo "<br/>Return to <a href='index.php'>Main Page?</a><br/>";
         }
         else
         {
             echo "You don't have permission to end this rescue<br/>";
         }
     }
     else if (isset($_GET['id']))
     {
         echo "<b>WARNING</b> - pressing this button will end this rescue - are you sure?<br/><br/>";
         echo "<form action='end_rescue.php' method='get'>";
         echo "<input type='hidden' name='id' value='".$_GET['id']."'>";
         echo "<input type='submit' name='commit' value='End Rescue!'>";
         echo "</form>"; 
     }
     else
     {
         echo "No rescue specified!";
     }
 }
 else
 {
     echo "You need to be logged in to view this - use the links above...";
 }
?>


</div>
</div>

<?php
 require("template/footer.html");
?>

