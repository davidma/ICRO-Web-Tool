<?php    

 // Start the page
 require("template/header.php");
 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>Callout Tool</div>";
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
       if (isset($_POST['cave_id']))
       {
         $cave_data = $theDB->fetchQuery("select name,county from caves where cave_id = ".$_POST['cave_id']." ");

         if (!$cave_data)
         {
             echo "No such cave - invalid cave_id";
             die;
         }
         
         $comments = mysql_real_escape_string($_POST['details']);

         $insert_sql = "INSERT INTO rescues (cave_id,user_id,date,status,comments,type) VALUES ("
                        . $_POST['cave_id'] . "," . $_SESSION['user_id'] . ",NOW(), 1,'$comments'," . $_POST['type'] . ");";

         if ($theDB->doQuery($insert_sql))
         {
           $ID = $theDB->fetchQuery("select rescue_id from rescues order by date DESC limit 1");
             
           $theDB->doQuery("INSERT into rescue_log set rescue_id = ".$ID[0]['rescue_id'].",TIME=now(),MESSAGE='Callout started by ".$_SESSION['username']."';");
             
           // Alert all the wardens and the PRO
           $data = $theDB->fetchQuery("SELECT u.* FROM users u, user_roles r WHERE u.user_id = r.user_id AND r.role_id in (1)");
              
           if ($_POST['dosms'] == 1)
           {
             for ($i=0; $i<count($data); $i++)
             {
               // Send an SMS, ask to put on standby
               if ($_POST['type'] == '2')
               {
                 $message = "[ICRO] Rescue PRACTICE commencing at ".$cave_data[0]['name'].", ".$cave_data[0]['county']." - please reply ABLE if you are attending";
                 $state = 4;
                 $status = "Callout requested";
               }
               else
               {
                 $message = "[ICRO] Rescue started at ".$cave_data[0]['name'].", ".$cave_data[0]['county']." - if available for STANDBY, please reply READY - if not, reply OFFLINE";
                 $state = 2;
                 $status = "Standby requested";
               }
               
               if ($theSMS->send($data[$i]['mobile_phone'],$message))
               {   
                 $theDB->doQuery("UPDATE user_status SET status_id = ".$state.", rescue_id=".$ID[0]['rescue_id']." where user_id=".$data[$i]['user_id'].";");
                 echo "UPDATE user_status SET status_id = ".$state.", rescue_id=".$ID[0]['rescue_id']." where user_id=".$data[$i]['user_id'].";";
                 $theDB->doQuery("INSERT into rescue_log set rescue_id = ".$ID[0]['rescue_id'].",TIME=now(),MESSAGE='".$data[$i]['first_name']." ".$data[$i]['last_name']." changed to state $state ($status)'");
                 echo $data[$i]['first_name']." ".$data[$i]['last_name']." changed to state $state ($status) - SMS sent!<br/>";
               }
               else
               {
                 echo "SMS not sent to ".$data[$i]['first_name']." ".$data[$i]['last_name']." - ". $theSMS->lastError() . " - NOT CALLED OUT!<br/>";
               }
             }

           }

           echo "<br/>"; 
                 
           $theDB->doQuery("update user_status SET status_id = 5, rescue_id=".$ID[0]['rescue_id']." where user_id=".$_SESSION['user_id'].";");
           echo "You are the current designated point of contact for this incident - you can change this on the next page<br/><br/>";                 

           echo "Callout details recorded - view <a href='view_callout.php?id=".$ID[0]['rescue_id']."'>Incident Status Page?</a>";
         }
         else
         {
           echo "Error recording details: ".$theDB->lastError();
         }
     }
     else
     {
       echo "To initiate the callout, I need a few basic details:<br/><br/>";
       echo "<form action='" . $_SERVER['PHP_SELF'] ."' method='post'>";
       echo "Cave Name:<br/>"; 

       $res = $theDB->fetchQuery("select cave_id,name,county from caves where enabled = '1' order by county,name;");

       if (!$res)
       {
           echo "No caves found!";
           die();
       }
       else
       {
           echo "<select name=cave_id>";

           for ($i=0; $i<count($res); $i++)
           {
               echo "<option value='".$res[$i]['cave_id']."'>".$res[$i]['county']." - ".$res[$i]['name']."</option>";
           }

           echo "</select>";
       }

       echo "<br/>";
       echo "<br/>";
       echo "Callout Type:<br/>"; 
       echo "<INPUT TYPE='RADIO' NAME='type' VALUE='1' > Real Rescue<br/>";
       echo "<INPUT TYPE='RADIO' NAME='type' VALUE='2' CHECKED> Rescue Practice";
       echo "<br/><br/>";
       echo "Alert Wardens/PRO Immediately by SMS?<br/>";
       echo "<INPUT TYPE='RADIO' NAME='dosms' VALUE='1'> Yes<br/>";
       echo "<INPUT TYPE='RADIO' NAME='dosms' VALUE='0' CHECKED> No";
       echo "<br/><br/>";
       echo "Incident details (Whatever we have so far):<br/>";
       echo "<textarea cols=80 rows=10 name='details'></textarea><br/><br/>";
       echo "<input type=submit onClick='javascript:return confirm(\"This will start a callout - proceed?\")' value='Start Callout'/>";

       echo "</form>";
     }
   }
 }
 
 // End the page
 echo "<div id='clear_both' style='clear:both;'></div></div>";
 require("template/footer.html");
?>

