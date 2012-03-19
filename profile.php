<?php    
 require("template/header.php");
?>

<div class='newsbox'>
<div class='newstitle'>User Profile</div>
<div class='newscontent'>

<?php

 if ($theSentry->login())
 {
     if (isset($_GET['user_id']))
     {
         $sqlstring = "select * from users where user_id = '".$_GET['user_id']."'";
     }
     else
     {
         $sqlstring = "select * from users where user_id = '".$_SESSION['user_id']."'";
     }

     $result = $theDB->fetchQuery($sqlstring);

     if(!$result)
     {
         echo "No data returned - check that a valid user_id was supplied.";
     }
     else
     {
         $theLogger->log("Viewing profile for user ".$result[0]['username']);

         // Pretty up the address
         $address = $result[0]['address_line1'].", ".$result[0]['address_line2'].", ".$result[0]['town'].", ".$result[0]['county'].", ".$result[0]['postcode'];
         $address = preg_replace('/, ,/',',',$address);
         $address = preg_replace('/, $/','',$address);
         $address = preg_replace('/^, /','',$address);


         echo "<div class='rmenubox'><img src='images/usermaps/".$result[0]['user_id'].".png'></div>";
     
         // General info
         echo "<div class='halfboxheader'><b>Username</b></div><div class='halfbox'>".$result[0]['username']."</div>";
         echo "<div class='halfboxheader'><b>Real Name</b></div><div class='halfbox'>".$result[0]['first_name']." ".$result[0]['last_name'] ."</div>";
         echo "<div class='halfboxheader'><b>Address</b></div><div class='halfbox'>$address</div>";
         echo "<div class='halfboxheader'><b>Email</b></div><div class='halfbox'>".$result[0]['email']."</div>";
         echo "<div class='halfboxheader'><b>Mobile</b></div><div class='halfbox'>+".$result[0]['mobile_phone']."</div>";
         echo "<div class='halfboxheader'><b>Home</b></div><div class='halfbox'>+".$result[0]['home_phone']."</div>";
         echo "<div class='halfboxheader'><b>Work</b></div><div class='halfbox'>+".$result[0]['work_phone']."</div>";
         echo "<div class='halfboxheader'><b>Other</b></div><div class='halfbox'>+".$result[0]['other_phone']."</div>";
         echo "<div class='halfboxheader'><b>Registered</b></div><div class='halfbox'>".$result[0]['regdate']."</div>";
         echo "<div class='halfboxheader'><b>Last Activity</b></div><div class='halfbox'>".$result[0]['last_login']."</div>";
        
         echo "<div id='clear_both' style='clear:both;'></div>";
       
         echo "<div class='fullboxheader'><a href='#' id='optionstg' onclick=\"toggleDiv('options','optionstg');\"/>[-]</a> <b>Roles & Skills defined for this User</b></div>";
         echo "<div class='fullbox' id='options'>";
         echo "<ul>";

         // Get the list of user roles
         $roles = $theDB->fetchQuery('select role from user_roles, roles where roles.role_id = user_roles.role_id and user_roles.user_id = '.$result[0]['user_id']);

         for ($i = 0; $i < count($roles); $i++)
         {
             echo "<li>".$roles[$i]['role']."</li>";
         }
         
         echo "</ul></div>";


         echo "<div class='fullboxheader'><a href='#' id='tx' onclick=\"toggleDiv('t','tx');\"/>[-]</a> <b>Training Completed by this User</b></div>";
         echo "<div class='fullbox' id='t'>";
         echo "<ul>";

         // Get the list of training
         $roles = $theDB->fetchQuery('select tc.name,date_format(t.valid_from,"%Y-%m-%d") as stime,date_format(t.valid_to,"%Y-%m-%d") as etime, if(valid_to > now(),1,0) as valid from training_courses tc, training t where t.course_id = tc.course_id and t.user_id = '.$result[0]['user_id'].' order by t.valid_to desc');

         for ($i = 0; $i < count($roles); $i++)
         {
             if ($roles[$i]['valid'])
             {
                 echo "<li>".$roles[$i]['stime']." - ACTIVE - ".$roles[$i]['name']." (valid until ".$roles[$i]['etime'].")</li>";
             }
             else
             {
                 echo "<li>".$roles[$i]['stime']." - EXPIRED - ".$roles[$i]['name']." (valid until ".$roles[$i]['etime'].")</li>";
             }
         }

         echo "</ul></div>";


         echo "<div class='fullbox'><center>View <a href='user_list.php'>other users profiles</a> or <a href='edit_profile.php?user_id=".$_SESSION['user_id']."'>edit your own?</a></center></div>";
     }
 }
 else
 {
     echo "You need to be logged in to view your profile - use the links above...";
 }
?>


</div>
</div>

<?php
 require("template/footer.html");
?>

