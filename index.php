<?php    

 // Start the page
 require("template/header.php");


 // If its a non-logged in user, display public text
 if (!$theSentry->login())
 {
     echo "<div class='newsbox'>";
     echo "<div class='newstitle'>Login to the System</div>";
     echo "<div class='newscontent'>";

     echo '<br/>';
     echo '<form action="login.php" method="post">';
     echo '<table align="center" border="1" cellspacing="0" cellpadding="3">';
     echo '<tr><td>Username:</td><td>';
     echo '<input type="text" name="uname" maxlength="40">';
     echo '</td></tr>';
     echo '<tr><td>Password:</td><td>';
     echo '<input type="password" name="passwd" maxlength="50">';
     echo '</td></tr>';
     echo '<tr><td colspan="2" align="right">';
     echo '<input type="submit" name="submit" value="Login">';
     echo '</td></tr>';
     echo '</table>';
     echo '</form>';
     echo '<center>ICRO Member? Need an Account? Contact <a href="mailto:webmaster@icro.ie">ICRO</a> and we\'ll sort you out...</center><br/>';
     echo '<center>If you are interested in donating to ICRO, you\'ll find <a href="donations.php">all the info here</a></center><br/>';
 }
 // Otherwise display ICRO Menu
 else
 {
     echo "<div class='newsbox'>";
     echo "<div class='newstitle'>Welcome!</div>";
     echo "<div class='newscontent'>";

     echo "<br/>";
     echo "<div class='motdbanner'>";
     echo "<b>Message of the Day</b> - you can put a message for users here";
     echo "</div>";
     echo "<br/>";

     // Callout banner - displays if there are active rescues ongoing (according to the DB)
     $rescues = $theDB->fetchQuery('select c.name,c.county,r.rescue_id,r.type from rescues r, caves c where c.cave_id = r.cave_id and r.status = 1;');

     if ($rescues)
     {
         echo "<div class='rescuebanner'>";
         echo "<b>ATTENTION</b> - ".count($rescues)." Rescue(s) are currently ongoing: <ul>";

         for ($i=0; $i < count($rescues); $i++)
         {
             if ($rescues[$i]['type'] == '1')
             {
                 echo "<li>Callout at " . $rescues[$i]['name'] .", ".$rescues[$i]['county']." - view <a href='view_callout.php?id=".$rescues[$i]['rescue_id']."'>Incident Page?</a>";
             }
             else
             {
                 echo "<li>Rescue PRACTICE at " . $rescues[$i]['name'] .", ".$rescues[$i]['county']." - view <a href='view_callout.php?id=".$rescues[$i]['rescue_id']."'>Incident Page?</a>";
             }
         }

         echo "</ul></div>";
     }

     // Menus are displayed according to the users permissions
     // The numbers below correspond to role_ids in the DB
     // Only exceptions are admins - they see everything by default

     // Wardens
     if ($theSentry->hasPermission(2) || $theSentry->hasPermission(8))
     {
         echo "<div class='fullboxheader'><a href='#' id='ax' onclick=\"toggleDiv('a','ax');\"/>[-]</a> <b>Callout Tools</b></div>";
         echo "<div class='fullbox' id='a'>";
         echo "<ul>";
         echo "<li><a href='callout.php'>Start a Callout</a></li>";
         ///echo "<li><a href='send_sms.php'>Send Non-Callout Group SMS Messages</a></li>";
         echo "<li><a href='cave_add.php'>Create a new Cave File</a></li>";
         echo "<li><a href='quick_add.php'>Quickly Add a Basic User</a><br/></li>";
         echo "</ul>";
         echo "</div>";
     }

     // Core Team Members
     if ($theSentry->hasPermission(3))
     {
         echo "<div class='fullboxheader'><a href='#' id='bx' onclick=\"toggleDiv('b','bx');\"/>[-]</a> <b>Core Team Tools</b></div>";
         echo "<div class='fullbox' id='b'>";
         echo "<ul>";
         echo "<li><a href='list_documents.php'>Browse</a> / <a href='upload_document.php'>Upload</a> Documents</a></li>";
         echo "<li><a href='link_cave_docs.php'>Link</a> Documents to Cave files</a></li>";
         echo "<li><a href='link_rescue_docs.php'>Link</a> Documents to Callouts</a></li>";
         echo "<li><a href='categorise_docs.php'>Categorise</a> Documents</a></li>";
         echo "<li><a href='cave_mod.php'>Modify</a> Cave Files</li>";
         echo "</ul>";
         echo "</div>";
     }

     // General ICRO members
     if ($theSentry->hasPermission(4))
     {
         echo "<div class='fullboxheader'><a href='#' id='cx' onclick=\"toggleDiv('c','cx');\"/>[-]</a> <b>General Tools</b></div>";
         echo "<div class='fullbox' id='c'>";
         echo "<ul>";
         echo "<li><a href='gen_calloutlist.php'>Get an up-to-date Callout List</a></li>";
         echo "<li><a href='cave_list.php'>View</a> Cave Files</li>";
         echo "<li><a href='callout_archive.php'>View</a> old callouts</li>";
         echo "<li><a href='profile.php'>View</a> / <a href='edit_profile.php?user_id=".$_SESSION['user_id']."'>Edit</a> your Callout Information</a></li>";
         echo "<li><a href='change_password.php'>Change</a> your password</a></li>";
         echo "</ul>";
         echo "</div>";
     }

     // Personell stuff
     if ($theSentry->hasPermission(5) || $theSentry->hasPermission(8))
     {
         echo "<div class='fullboxheader'><a href='#' id='dx' onclick=\"toggleDiv('d','dx');\"/>[-]</a> <b>User Admin Tools</b></div>";
         echo "<div class='fullbox' id='d'>";
         echo "<ul>";
         echo "<li><a href='quick_add.php'>Quickly Add a Basic User</a><br/></li>";
         echo "<li><a href='user_add.php'>Add</a>&nbsp;/&nbsp;<a href='user_mod.php'>Modify</a>&nbsp;/&nbsp;<a href='user_del.php'>Delete</a> a User<br/></li>";
         echo "<li><a href='reset_password.php'>Reset</a> a users password</a></li>";
         echo "<li><a href='user_roles.php'>Change a users roles</a> / <a href='user_skills.php'>Change a users skills</a></li>";
         echo "</ul>";
         echo "</div>";
     }
 
     // Training specific stuff
     if ($theSentry->hasPermission(5) || $theSentry->hasPermission(7))
     {
         echo "<div class='fullboxheader'><a href='#' id='fx' onclick=\"toggleDiv('f','fx');\"/>[-]</a> <b>Training Tools</b></div>";
         echo "<div class='fullbox' id='f'>";
         echo "<ul>";
         echo "<li><a href='course_add.php'>Add Training Course</a><br/></li>";
         echo "<li><a href='course_mod.php'>Modify an existing Training Course</a><br/></li>";
         echo "<li><a href='link_user_course.php'>Record a users attendance at a Training Course</a><br/></li>";
         echo "<li><a href='training_search.php'>Search Training Records</a><br/></li>";
         echo "</ul>";
         echo "</div>";
     }
 
     // Admin specific stuff
     if ($theSentry->hasPermission(1))
     {
         echo "<div class='fullboxheader'><a href='#' id='ex' onclick=\"toggleDiv('e','ex');\"/>[-]</a> <b>Site Admin Tools</b></div>";
         echo "<div class='fullbox' id='e'>";
         echo "<ul>";
         echo "<li><a href='dump_db.php'>Dump DB (for backup or offline use)</a><br/></li>";
         echo "<li><a href='mass_sms.php'>SMS the entire userbase with any message you want</a><br/></li>";
         echo "<li><a href='gen_user_maps.php'>Re-generate</a> all users maps, lats and longs</a></li>";
         echo "<li><a href='gen_cave_maps.php'>Re-generate</a> all cave maps</a></li>";
         echo "<li><a href='system_log.php'>View System Logs</a></li>";
         echo "</ul>";
         echo "</div>";
     }
 }
 
 // End the page
 echo "<div id='clear_both' style='clear:both;'></div></div>";
 require("template/footer.html");
?>
