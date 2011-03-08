<?php    

 // Start the page
 require("template/header.php");
 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>Create Course</div>";
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
         if (isset($_POST['do_modify']))
         {
             if (!$_POST['name'] )
             {
                 echo('You did not fill in a required field. - <a href="course_add.php">try again?</a>');
             }
             else
             {
                 $_POST['name']        = strip_tags($_POST['name']);

                 if (!get_magic_quotes_gpc())
                 {
                     $_POST['name']        = addslashes($_POST['name']);
                 }


                 $update = "insert into training_courses set name = '".$_POST['name']."',
                                                          role_id = '".$_POST['role_id']."',
                                                         validity = '".$_POST['validity']."',
                                                             tier = '".$_POST['tier']."';";

                 $result = $theDB->doQuery($update);

                 if (!result)
                 {
                     print 'Error inserting course - '.$theDB->lasterror().' - <a href="course_add.php">try again?</a>';
                 }
                 else
                 {
                     $theLogger->log("Created new training course ".$_POST['name']);
                     echo '<br/>Course details successfully added<br/><br/>';
                 }
             }
         }
         else
         {
                 echo "<form action=\"course_add.php\" method=\"post\">";
                 echo "<table align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">";
                 echo "<tr><td>Name*:</td><td>";
                 echo "<input type=\"text\" name=\"name\" maxlength=\"50\">";
                 echo "</td></tr>";
                 echo "<tr><td>Awarded Role*:</td><td>";

                 $res = $theDB->fetchQuery("select * from roles where role_id > 100;");

                 if (!$res)
                 {
                     echo "No roles found!";
                     die();
                 }
                 else
                 {
                     echo "<select name=role_id>";

                     for ($i=0; $i<count($res); $i++)
                     {
                         echo "<option value='".$res[$i]['role_id']."'>".$res[$i]['role']."</option>";
                     }

                     echo "</select>";
                 }

                 echo "</td></tr>";
                 echo "<tr><td>Valid for (days):</td><td>";
                 echo "<input type=\"text\" name=\"validity\" value = '730' maxlength=\"50\">";
                 echo "</td></tr>";
                 echo "<tr><td>Importance Tier (1=highest):</td><td>";
                 echo "<input type=\"text\" name=\"tier\" value = '1' maxlength=\"50\">";
                 echo "</td></tr>";
                 echo "<tr><td colspan=\"2\" align=\"right\">";
                 echo "<input type=\"submit\" name=\"do_modify\" value=\"Create Course\">";
                 echo "</td></tr>";
                 echo "</table>";
                 echo "</form>";
         }
     }
     else
     {
         echo "<br/>Permission Denied - Sorry!<br/><br/>";
     }
         
 }
 
 // End the page
 echo "<div id='clear_both' style='clear:both;'></div></div>";
 require("template/footer.html");
?>

