<?php    

 // Start the page
 require("template/header.php");
 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>Modify Course</div>";
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
         if (isset($_POST['name']))
         {
             if (!$_POST['name'] )
             {
                 echo('You did not fill in a required field. - <a href="course_mod.php">try again?</a>');
             }
             else
             {
                 $_POST['name']        = strip_tags($_POST['name']);

                 if (!get_magic_quotes_gpc())
                 {
                     $_POST['name']        = addslashes($_POST['name']);
                 }


                 $update = "update training_courses set name = '".$_POST['name']."',
                                                     role_id = '".$_POST['role_id']."',
                                                    validity = '".$_POST['validity']."',
                                                        tier = '".$_POST['tier']."'
                                             where course_id = '".$_POST['course_id']."';";

                 $result = $theDB->doQuery($update);

                 if (!result)
                 {
                     print 'Error inserting course - '.$theDB->lasterror().' - <a href="course_mod.php">try again?</a>';
                 }
                 else
                 {
                     $theLogger->log("Modified training course ".$_POST['name']);
                     echo '<br/>Course details successfully modified<br/><br/>';
                 }
             }
         }
         else if (isset($_POST['course_id']))
         {
             $data = $theDB->fetchQuery('select * from training_courses where course_id = '.$_POST['course_id']);

             if (!$data)
             {
                 echo "No such course exists - ".$theDB->lasterror()."<br/>";
             }
             else
             {
                 echo "<form action=\"course_mod.php\" method=\"post\">";
                 echo "<input type='hidden' name='course_id' value='".$_POST['course_id']."'/>";
                 echo "<table align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">";
                 echo "<tr><td>Name*:</td><td>";
                 echo "<input type=\"text\" name=\"name\" value=\"".$data[0]['name']."\" maxlength=\"50\">";
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
                         if ($res[$i]['role_id'] == $data[0]['role_id'])
                         {
                             echo "<option value='".$res[$i]['role_id']."' selected>".$res[$i]['role']."</option>";
                         }
                         else
                         {
                             echo "<option value='".$res[$i]['role_id']."'>".$res[$i]['role']."</option>";
                         }
                     }

                     echo "</select>";
                 }

                 echo "</td></tr>";
                 echo "<tr><td>Valid for (days):</td><td>";
                 echo "<input type=\"text\" name=\"validity\" value = '".$data[0]['validity']."' maxlength=\"50\">";
                 echo "</td></tr>";
                 echo "<tr><td>Importance Tier (1=highest):</td><td>";
                 echo "<input type=\"text\" name=\"tier\" value = '".$data[0]['tier']."' maxlength=\"50\">";
                 echo "</td></tr>";
                 echo "<tr><td colspan=\"2\" align=\"right\">";
                 echo "<input type=\"submit\" name=\"do_modify\" value=\"Modify Course\">";
                 echo "</td></tr>";
                 echo "</table>";
                 echo "</form>";
             }
         }
         else
         {
             echo "<form action=\"course_mod.php\" method=\"post\">";
             echo "Select a course to modify:<br/>";
                 
             $res = $theDB->fetchQuery("select * from training_courses;");

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
       
               echo "</select><br/>";
             }

             echo "<input type=\"submit\" name=\"do_modify\" value=\"Modify Course\"></form>";

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

