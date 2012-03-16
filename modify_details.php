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
     if (isset($_GET['id']) || isset($_POST['id']))
     {
         $rid = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
      
         $rescue = $theDB->fetchQuery('select r.*,c.* from rescues r, caves c  where c.cave_id = r.cave_id and r.rescue_id = ' . $rid);
   
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

     if (isset($_POST['details']))
     {
         $comments = mysql_real_escape_string($_POST['details']);

         if ($theDB->doQuery("UPDATE rescues set comments = '".$comments."' where rescue_id = ".$_POST['id']))
         {
             $theDB->doQuery("INSERT into rescue_log set rescue_id = ".$_POST['id'].",time=now(),message='Incident details updated'");
           
             echo "Details updated sucessfully<br/>";
         }
         else
         {
             echo "ERROR - couldn't update details - ".$theDB->lastError();
         }

         echo "<br/>Return to <a href='view_callout.php?id=".$_POST['id']."'>Incident Page?</a>"; 
     }
     else
     {
         echo "<form target='modify_details.php' method=post>";

         echo "Current details:<br/>";
         echo "<input type='button' value='Bold' onclick='formatText(\"ta1\",\"b\");'/>";
         echo "<input type='button' value='Underline' onclick='formatText(\"ta1\",\"u\");'/>";
         echo "<input type='button' value='Italic' onclick='formatText(\"ta1\",\"i\");'/>";
         echo "<input type='button' value='Red' onclick='formatText(\"ta1\",\"red\");'/>";
         echo "<input type='button' value='Green' onclick='formatText(\"ta1\",\"green\");'/>";
         echo "<input type='button' value='Blue' onclick='formatText(\"ta1\",\"blue\");'/>";
         echo "<br/>";
         echo "<textarea id='ta1' name=\"details\" cols=80 rows=20>".$rescue[0]['comments']."</textarea>";
         echo "<br/>";
         echo "<input type=hidden name='id' value='".$_GET['id']."'/>";
         echo "<input type=submit value='Save New Details'/>";
         echo "</form>";
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

