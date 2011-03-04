<?php    
 require("template/header.php");

 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>Send Rescue SMS</div>";
 echo "<div class='newscontent'>";


 if ($theSentry->login() && ($theSentry->hasPermission(2) || $theSentry->hasPermission(8)))
 {
    if (isset($_GET['text']))
    {
        $user_ids = $_GET['user_ids'];

        for ($i=0; $i<count($user_ids); $i++)
        {
            //look up phone number for userid
            $data = $theDB->fetchQuery("select * from users where user_id = ".$user_ids[$i] ." limit 1");

            if (!$data)
            {
                echo "No data for User ID ".$user_ids[$i];
            }
            else
            {
                //send sms
                if ($theSMS->send($data[0]['mobile_phone'],$_GET['text']))
                {
                    $theDB->doQuery("UPDATE user_status SET status_id = ".$_GET['state'].", rescue_id=".$_GET['rescue_id']." where user_id=".$user_ids[$i].";");
                    echo "Message sent to ".$data[0]['first_name']." ".$data[0]['last_name']." and status updated<br/>";
                }
                else
                { 
                    echo "Message NOT sent to ".$data[0]['first_name']." ".$data[0]['last_name']."<br/>";
                }

                if ($_GET['state'] == 4)
                {
                    $theDB->doQuery("insert into rescue_log set rescue_id=".$_GET['rescue_id'].",time=now(),message='".$data[0]['first_name']." ".$data[0]['last_name']." callout requested';");
                }
                if ($_GET['state'] == 2)
                {
                    $theDB->doQuery("insert into rescue_log set rescue_id=".$_GET['rescue_id'].",time=now(),message='".$data[0]['first_name']." ".$data[0]['last_name']." standby requested';");
                }
            }
        }

        echo "<br/>Return to <a href='view_callout.php?id=".$_GET['rescue_id']."'>Incident Page?</a><br/>";
    }
    else if (isset($_GET['user_ids']) && isset($_GET['rescue_id'])) 
    { 
        echo "This form will send SMS messages to the people you selected and then update their rescue status<br/>";
        echo "You need to use one of the preformatted message templates, listed below<br/><br/>";
        
        echo "<form action='rescue_sms_out.php' method='get'>";
       
        $user_ids = $_GET['user_ids'];
        for ($i=0; $i<count($user_ids); $i++)
        {
            echo "<input type='hidden' name='user_ids[]' value='".$user_ids[$i]."'/>";
        }
       
        echo "<input type='hidden' name='rescue_id' value='".$_GET['rescue_id']."'/>";

        //get the name of the cave for the SMS
        $cave_data = $theDB->fetchQuery('select c.name,c.county,r.type from caves c, rescues r where r.cave_id = c.cave_id and r.rescue_id = '.$_GET['rescue_id']);
       
        if ($cave_data[0]['type'] == 2 )
        { 
            $msg_sby = "[ICRO] Rescue PRACTICE at ".$cave_data[0]['name'].", ".$cave_data[0]['county']." - if available for STANDBY, please reply READY - if not, reply OFFLINE";
            $msg_clt = "[ICRO] Rescue PRACTICE at ".$cave_data[0]['name'].", ".$cave_data[0]['county']." - if available for CALLOUT, please reply ABLE - if not, reply OFFLINE";
        }
        else
        {
            $msg_sby = "[ICRO] Rescue at ".$cave_data[0]['name'].", ".$cave_data[0]['county']." - if available for STANDBY, please reply READY - if not, reply OFFLINE - not a test!";
            $msg_clt = "[ICRO] Rescue at ".$cave_data[0]['name'].", ".$cave_data[0]['county']." - if available for CALLOUT, please reply ABLE - if not, reply OFFLINE - not a test!";
        }

        echo "<input type='hidden' name='rescue_id' value='".$_GET['rescue_id']."'/>";
        
        echo "<select name='sms_messages' onchange='updateFields(this.value)'>";
        echo "<option value='0%0'>Select one...</option>";
        echo "<option value='2%$msg_sby'>$msg_sby</option>";
        echo "<option value='4%$msg_clt'>$msg_clt</option>";
        echo "</select><br/><br/>";
        echo "<input type='hidden' name='state'>";
        echo "<input type='hidden' name='text'>";
        echo "<input type='submit' value='Send SMS Messages'/></form>";
    } 
    else 
    {
        echo "You didn't specify a required value";
    }
 }
 else
 {
    print "You must be logged in with sufficient permissions to view this";
 }

 echo "</div></div>";

 require("template/footer.html");
?>
