<?php    
 require("template/header.php");

 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>Manual State Change</div>";
 echo "<div class='newscontent'>";


 if ($theSentry->login() && ($theSentry->hasPermission(2) || $theSentry->hasPermission(8)))
 {
    if (isset($_GET['user_id']) && isset($_GET['rescue_id'])) 
    { 

      if (isset($_GET['state']))
      {
          if ($theDB->doQuery('update user_status set status_id = '.$_GET['state'].', rescue_id = '.$_GET['rescue_id'].' where USER_ID = '.$_GET['user_id']))
          {
              $data = $theDB->fetchQuery('select * from users u,user_status us, status s where u.user_id = us.user_id and us.status_id = s.status_id and u.user_id = '.$_GET['user_id']);
              echo "State changed sucessfully - ";
              echo $data[0]['first_name']." ".$data[0]['last_name']." is currently marked as ".$data[0]['status']."<br/><br/>";

              $theDB->doQuery("INSERT into rescue_log set rescue_id = ".$_GET['rescue_id'].",TIME=now(),message='".$data[0]['first_name']." ".$data[0]['last_name']." is now ".$data[0]['status']."'");
          }
          else
          {
              echo "Couldn't change state - ".$theDB->lastError();
          }
     
          echo "Return to <a href='view_callout.php?id=".$_GET['rescue_id']."'>Incident Page?</a>";
      }
      else
      {
        echo "<form action='change_state.php' method='get'>";
      
        $data = $theDB->fetchQuery('select * from users u,user_status us, status s where u.user_id = us.user_id and us.status_id = s.status_id and u.user_id = '.$_GET['user_id']);

        echo $data[0]['first_name']." ".$data[0]['last_name']." is currently marked as ".$data[0]['status']."<br/><br/>";

        echo "His contact details - you need to <u>manually</u> notify him of this update:";
        echo "<ul>";
        echo "<li><b>Home:</b> +".$data[0]['home_phone']."</li>";
        echo "<li><b>Mobile:</b> +".$data[0]['mobile_phone']."</li>";
        echo "<li><b>Work:</b> +".$data[0]['work_phone']."</li>";
        echo "<li><b>Other:</b> +".$data[0]['other_phone']."</li>";
        echo "</ul>";

        echo "Please select the new state: ";           
        echo "<select name='state'>";

        $data = $theDB->fetchQuery('select * from status where status_id not in (2,4)');

        for ($i=0; $i<count($data); $i++)
        {
            echo "<option value='".$data[$i]['status_id']."'>".$data[$i]['status']."</option>";
        }

        echo "</select><br/><br/>";
        echo "<input type='hidden' name='user_id' value='".$_GET['user_id']."'/>";
        echo "<input type='hidden' name='rescue_id' value='".$_GET['rescue_id']."'/>";
        echo "<input type='submit' value='Change State'/></form>";
      }
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
