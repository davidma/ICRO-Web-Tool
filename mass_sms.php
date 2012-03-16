<?php    
 require("template/header.php");
?>

<div class='newsbox'>
<div class='newstitle'>Mass SMS Tool</div>
<div class='newscontent'>

<?php
 if ($theSentry->login())
 {
     if (isset($_GET['message']) and isset($_GET['commit']))
     {
         if ($theSentry->hasPermission(1))
         {
             $result = $theDB->fetchQuery("select * from users u order by last_name");

             if(!$result)
             {
                 echo "No users found to alert...";
             }
             else
             {
                 for ($i=0; $i < count($result); $i++)
                 {
                     // Send an SMS to the user, alerting him rescue is over
                     $res = $theSMS->send($result[$i]['mobile_phone'],$_GET['message']);

                     if ($res)
                     {
                         echo $result[$i]['first_name']." ".$result[$i]['last_name']." was sucessfully messaged via SMS<br/>";
                     }
                     else
                     {
                         echo $result[$i]['first_name']." ".$result[$i]['last_name']." was NOT messaged via SMS - please inform manually! - ";
                         echo $theSMS->lastError();
                         echo "<br/>";
                     }
                 }
             }

             echo "<br/>Return to <a href='index.php'>Main Page?</a><br/>";
         }
         else
         {
             echo "You don't have permission to do this<br/>";
         }
     }
     else
     {
         echo "<b>WARNING</b> - This will SMS all members on this site - are you sure?<br/><br/>";
         echo "<form action='mass_sms.php' method='get'>";
         echo "<input type='text' name='message' style='width: 85%;' length='120' value='[ICRO] message goes here'>";
         echo "<input type='submit' name='commit' value='Send SMS!'>";
         echo "</form>"; 
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

