<?php
 require("template/header.php");

 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>Process Incoming SMS</div>";
 echo "<div class='newscontent'>";

 if (isset($_GET['from']) && isset($_GET['text']))
 {
     // Get the userid based on the number - search all 4 fields
     $id_data = $theDB->fetchQuery("SELECT * FROM users WHERE (mobile_phone = '".$_GET['from']."' OR home_phone = '".$_GET['from']."' OR work_phone = '".$_GET['from']."' OR other_phone = '".$_GET['from']."');");
     
     if (!$id_data)
     {
         $theSMS->send($_GET['from'],"[ICRO] ERROR - Unrecognised Number - you must use a number associated with your profile");
         die("ERROR - unrecognised number - ".$theDB->lastError());
     }

     // Get current state - find last state from DB for this user
     $state_data = $theDB->fetchQuery("SELECT * FROM user_status WHERE user_id = '".$id_data[0]['user_id']."'");

     if (!$state_data)
     {
         $theSMS->send($_GET['from'],"[ICRO] ERROR - Internal error - ring Dave Masterson +353879648274");
         die("Error - no state data found - ".$theDB->lastError());
     }
     else
     {
         $cstate = $state_data[0]['status_id'];
     }

     $name  = $id_data[0]['first_name']." ".$id_data[0]['last_name'];
     $rid   = $state_data[0]['rescue_id'];
     $uid   = $id_data[0]['user_id'];
     $error = "Internal error - ring Dave Masterson +353879648274"; 
     $from  = $_GET['from']; 
   
    // Parse the message for valid commands
    if (preg_match("/READY/i", $_GET['text']))
    {
        // Process READY command - signals user wants to move to standby status (status 3)
        // works if current state is 2
        if ($cstate == 2)
        {
             $res = $theDB->doQuery("UPDATE user_status SET status_id = '3' WHERE user_id = '$uid'");
             
             if ($res)
             {
                 $theDB->doQuery("INSERT into rescue_log set rescue_id = $rid ,time=now(),message='$name has accepted standby'");
                 $theSMS->send($from,"[ICRO] You are now on standby - get gear ready, rest and await instructions");
                 echo "User $name ($from) marked on Standby";
             }
             else
             {
                 $theSMS->send($from,"[ICRO] ERROR - $error");
                 echo "ERROR - ".$theDB->lastError();
             }
        }
        else
        {
            $theSMS->send($from,"[ICRO] ERROR - you have not been asked to go on standby, message ignored");
            echo "ERROR - Invalid state change";
        }
    }
    else if (preg_match("/ABLE/i", $_GET['text']))
    {
        // Process ABLE command - signals user wants to move to callout status (status 5)
        // works if current state is 4
        if ($cstate == 4)
        {
             $res = $theDB->doQuery("UPDATE user_status SET status_id = '5' WHERE user_id = '$uid'");

             if ($res)
             {
                 $theDB->doQuery("INSERT into rescue_log set rescue_id = $rid ,time=now(),message='$name has accepted callout'");
                 $theSMS->send($from,"[ICRO] You are called out - please report to the Rescue Store - reply ONTHEWAY with estimated travel time in mins when leaving e.g. ONTHEWAY 120");
                 echo "User $name ($from) marked on callout";
             }
             else
             {
                 $theSMS->send($from,"[ICRO] ERROR - $error");
                 echo "ERROR - ".$theDB->lastError();
             }
        }
        else
        {
            $theSMS->send($from,"[ICRO] ERROR - you have not been asked to go on callout, message ignored");
            echo "ERROR - Invalid state change";
        }
    }
    else if (preg_match("/ONTHEWAY/i", $_GET['text']))
    {
        // Process ONTHEWAY command - signals user is on the way, and can optionally provide an ETA
        // Works if current state is 5 or 6
        if ($cstate == 5 || $cstate == 6)
        {
             // is their a usable ETA attached?
 
             $eta = 0;
             if (preg_match('/ONTHEWAY ([0-9]+)/i', $_GET['text'], $matches))
             {
                 $eta = $matches[1];
             }

             $res = $theDB->doQuery("UPDATE user_status SET status_id = '6', eta = $eta WHERE user_id = '$uid'");

             if ($res)
             {
                 $theDB->doQuery("INSERT into rescue_log set rescue_id = $rid ,time=now(),message='$name is on the way - ETA $eta mins'");
                 $theSMS->send($from,"[ICRO] Update noted - You are on the way - ETA $eta mins - thanks");
                 echo "User $name ($from) is on the way, ETA $eta mins";
             }
             else
             {
                 $theSMS->send($from,"[ICRO] ERROR - $error");
                 echo "ERROR - ".$theDB->lastError();
             }
        }
        else
        {
            $theSMS->send($from,"[ICRO] ERROR - you have not been asked to travel to the rescue, message ignored");
            echo "ERROR - Invalid state change";
        }
    }
    else if (preg_match("/OFFLINE/i", $_GET['text']))
    {
        // Process OFFLINE command - signals user is not available (status 1)
        // Works if current state is 0,1,2,3,4,5,6
        if ($cstate >=0 && $cstate <= 6)
        {
             $res = $theDB->doQuery("UPDATE user_status SET status_id = '1', rescue_id = '0' WHERE user_id = '$uid'");

             if ($res)
             {
                 $theDB->doQuery("INSERT into rescue_log set rescue_id = $rid ,time=now(),message='$name is unavailable for rescue duty'");
                 $theSMS->send($from,"[ICRO] You are now marked as unavailable for callout - reply ONLINE to become available again");
                 echo "User $name ($from) is unavailable";
             }
             else
             {
                 $theSMS->send($from,"[ICRO] ERROR - $error");
                 echo "ERROR - ".$theDB->lastError();
             }
        }
        else
        {
            $theSMS->send($from,"[ICRO] ERROR - you cannot become availabe right now");
            echo "ERROR - Invalid state change";
        }
    }
    else if (preg_match("/ONLINE/i", $_GET['text']))
    {
        // Process ONLINE command - signals user is available (status 0)
        // Only works if current state is 1 (not available)
        if ($cstate == 1)
        {
             $res = $theDB->doQuery("UPDATE user_status SET status_id = '0' WHERE user_id = '$uid'");

             if ($res)
             {
                 $theDB->doQuery("INSERT into rescue_log set rescue_id = $rid ,time=now(),message='$name is now available for rescue duty'");
                 $theSMS->send($from,"[ICRO] You are now marked as available for callout - reply OFFLINE to become unavailable again");
                 echo "User $name ($from) is available";
             }
             else
             {
                 $theSMS->send($from,"[ICRO] ERROR - $error");
                 echo "ERROR - ".$theDB->lastError();
             }
        }
        else
        {
            $theSMS->send($_GET['from'],"[ICRO] ERROR - you are already available for rescue duty, ignored");
            echo "ERROR - Invalid state change - $cstate to 0";
        }
    }
    else if (preg_match("/^OK/i", $_GET['text']))
    {
        // Process OK command - reply to standard sms test
        $theSMS->send($from,"[ICRO] Reply noted - system working - many thanks for testing!");

        echo "OK reply recieved from $name ($from) at ".date("Y-m-d H:i:s")."<br/>";

        // write result to file
        $fh = fopen("sms_reply_file.txt", 'a') or die("can't open file");
        fwrite($fh, " ** OK reply recieved from $name ($from) at ".date("Y-m-d H:i:s")."\n");
        fclose($fh);
    }
    else
    {
        // Unrecognised command
        $theSMS->send($from,"[ICRO] ERROR - sorry, I do not recognise your command - check the usage guide on the ICRO website");
        echo "ERROR - Invalid command";
    }
 }
 else
 {
     echo "<form action='rescue_sms_in.php' method='get'>";
     echo "From:<br/><input type='text' name='from' maxlength='50'><br/><br/>";
     echo "Message:<br/><input type='text' name='text' maxlength='50'><br/><br/>";
     echo "<input type='submit' value='Send Message'>";
     echo "</form>";
 }

 echo "</div></div>";
 require("template/footer.html");
?>


