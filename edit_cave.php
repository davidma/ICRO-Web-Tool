<?php    

 // Start the page
 require("template/header.php");
 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>Modify Cave</div>";
 echo "<div class='newscontent'>";

 // If its a non-logged in user, display public text
 if (!$theSentry->login())
 {
     echo "You need to be logged in to view this page"; 
 }
 else
 {
     if ($theSentry->hasPermission(3))
     {
         if (isset($_POST['do_modify']))
         {
             if (!$_POST['name'] )
             {
                 echo('You did not fill in a required field. - <a href="user_mod.php">try again?</a>');
             }
             else
             {
                 $_POST['name']        = strip_tags($_POST['name']);
                 $_POST['county']      = strip_tags($_POST['county']);
                 $_POST['description'] = strip_tags($_POST['description']);
                 $_POST['lat']         = strip_tags($_POST['lat']);
                 $_POST['lng']         = strip_tags($_POST['lng']);

                 if (!get_magic_quotes_gpc())
                 {
                     $_POST['name']        = addslashes($_POST['name']);
                     $_POST['county']      = addslashes($_POST['county']);
                     $_POST['description'] = addslashes($_POST['description']);
                 }

                 $update = "update caves set name = '".$_POST['name']."',
                                           county = '".$_POST['county']."',
                                              lat = '".$_POST['lat']."',
                                              lng = '".$_POST['lng']."',
                                      description = '".$_POST['description']."'
                                    where cave_id = '".$_POST['cave_id']."'";

                 $result = $theDB->doQuery($update);

                 if (!result)
                 {
                     print 'Error updating cave - '.$theDB->lasterror().' - <a href="cave_mod.php">try again?</a>';
                 }
                 else
                 {
                     echo $update."<br/><br/>";
                     $theLogger->log("Modified cave file for ".$_POST['name']);
                     echo '<br/>Cave details successfully updated<br/><br/>';
                 }
             }
         }
         else if (isset($_GET['cave_id']))
         {
             // select the entry associated with that name....

             $res = $theDB->fetchQuery("select * from caves where cave_id = '".$_GET['cave_id']."';");

             if (!$res)
             {
                 echo "Invalid cave id!";
                 die();
             }
             else
             {
                 echo "<form action=\"edit_cave.php\" method=\"post\">";
                 echo "<table align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">";
                 echo "<tr><td><b>Name*:</b></td><td>";
                 echo "<input type=\"hidden\" name=\"cave_id\" value='".$_GET['cave_id']."'>";
                 echo "<input type=\"text\" name=\"name\" value='".$res[0]['name']."' maxlength=\"50\">";
                 echo "</td></tr>";
                 echo "<tr><td><b>County*:</b></td><td>";
                 echo "<input type=\"text\" name=\"county\" value='".$res[0]['county']."' maxlength=\"50\">";
                 echo "</td></tr>";
                 echo "<tr><td><b>Latitude:</b></td><td>";
                 echo "<input type=\"text\" name=\"lat\" value='".$res[0]['lat']."' maxlength=\"50\">";
                 echo "</td></tr>";
                 echo "<tr><td><b>Longitude:</b></td><td>";
                 echo "<input type=\"text\" name=\"lng\" value='".$res[0]['lng']."' maxlength=\"50\">";
                 echo "</td></tr>";
                 echo "<tr><td colspan=2><b>Description</b>:</td></tr>";
                 echo "<tr><td colspan=2>";
                 echo "<input type='button' value='Bold' onclick='formatText(\"ta1\",\"b\");'/>";
                 echo "<input type='button' value='Underline' onclick='formatText(\"ta1\",\"u\");'/>";
                 echo "<input type='button' value='Italic' onclick='formatText(\"ta1\",\"i\");'/>";
                 echo "<input type='button' value='Red' onclick='formatText(\"ta1\",\"red\");'/>";
                 echo "<input type='button' value='Green' onclick='formatText(\"ta1\",\"green\");'/>";
                 echo "<input type='button' value='Blue' onclick='formatText(\"ta1\",\"blue\");'/>";
                 echo "</td></tr><tr><td colspan=2>";
                 echo "<textarea id='ta1' name=\"description\" cols=80 rows=20>".$res[0]['description']."</textarea>";
                 echo "</td></tr>";
                 echo "<tr><td colspan=\"2\" align=\"right\">";
                 echo "<input type=\"submit\" name=\"do_modify\" value=\"Modify Cave\">";
                 echo "</td></tr>";
                 echo "</table>";
                 echo "</form>";
            }
         }
         else
         {
             echo "<br/>Missing parameter<br/><br/>";
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

