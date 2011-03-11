<?php    

 // Start the page
 require("template/header.php");
 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>Record User Training</div>";
 echo "<div class='newscontent'>";

 // If its a non-logged in user, display public text
 if (!$theSentry->login())
 {
     echo "You need to be logged in to view this page"; 
 }
 else
 {
     if ($theSentry->hasPermission(5))
     {
         if (isset($_POST['user_id']) && isset($_POST['course_id']))
         {
             $data = $theDB->fetchQuery('select t.role_id, t.validity, r.role from training_courses t, roles r where r.role_id = t.role_id and t.course_id = '.$_POST['course_id']);

             if (!$data)
             {
                 echo "No such course!</br>";
                 die();
             }

             $date_until = date("Y-m-d",strtotime($_POST['date']." +".$data[0]['validity']." days"));
 
             $a = $_POST['user_id'];
             $b = $_POST['course_id'];
             $c = $_POST['date'];
             $d = $date_until;
          
             $res = $theDB->doQuery("insert into training (user_id,course_id,valid_from,valid_to) values ('$a','$b','$c','$d');"); 

             if ($res)
             {
                 $theLogger->log("User_id ".$_POST['user_id']." completed training course ".$_POST['course_id']);
                 echo "Training recorded sucessfully<br/>";
                 echo "Training will expire on $d<br/>";
             }
             else
             {
                 echo "Training recording failed - ".$theDB->lasterror()."<br/>";
             }

             $res = $theDB->doQuery("replace into user_roles set user_id = ".$_POST['user_id'].", role_id =".$data[0]['role_id'].";");  

             if ($res)
             {
                 $theLogger->log("User_id ".$_POST['user_id']." awarded ".$_POST['role']." role");
                 echo "User awarded ".$data[0]['role']." role<br/>";
                 echo "Role will be automatically revoked when training expires (unless extended by future training)<br/>";
             }
             else
             {
                 echo "Role addition failed - ".$theDB->lasterror()."<br/>";
             }
                 
             echo "<br/>";
             echo "Add <a href='link_user_course.php'>more training</a> or <a href='profile.php?user_id=".$_POST['user_id']."'>view users profile</a><br/>";

         }
         else
         {
             echo "<form action='link_user_course.php' method='post'>";

             echo "Select a User:<br/>";

             $res = $theDB->fetchQuery("select user_id,first_name,last_name from users order by last_name;");

             if (!$res)
             {
                 echo "No users found!";
                 die();
             }
             else
             {
                 echo "<select name=user_id>";

                 for ($i=0; $i<count($res); $i++)
                 {
                     echo "<option value='".$res[$i]['user_id']."'>".$res[$i]['first_name']." ".$res[$i]['last_name']."</option>";
                 }

                 echo "</select>";
             }

             echo "<br/><br/>";

             echo "Select a Course:<br/>";

             $res = $theDB->fetchQuery("select course_id,name from training_courses order by name;");

             if (!$res)
             {
                 echo "No courses found!";
                 die();
             }
             else
             {
                 echo "<select name=course_id>";

                 for ($i=0; $i<count($res); $i++)
                 {
                     echo "<option value='".$res[$i]['course_id']."'>".$res[$i]['name']."</option>";
                 }

                 echo "</select><br/><br/>";
             }

             echo "Date of course:<br/>";

	     $myCalendar = new tc_calendar("date", true, false);
	     $myCalendar->setIcon("calendar/images/iconCalendar.gif");
	     $myCalendar->setDate(date('d'), date('m'), date('Y'));
	     $myCalendar->setPath("calendar/");
	     $myCalendar->setYearInterval(2000, 2020);
	     $myCalendar->showInput(true);
	     $myCalendar->dateAllow('2000-01-01', '2020-12-31');
	     $myCalendar->writeScript();

             echo "<br/><br/>";
             echo "<INPUT TYPE='submit' value='Record User Training'/>";
             echo "</form>";
         }
     }
 }
 
 // End the page
 echo "<div id='clear_both' style='clear:both;'></div></div>";
 require("template/footer.html");
?>
