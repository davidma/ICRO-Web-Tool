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
 }
 // Otherwise display ICRO Menu
 else
 {
     echo "<div class='newsbox'>";
     echo "<div class='newstitle'>Welcome!</div>";
     echo "<div class='newscontent'>";

     // Menus are displayed according to the users permissions
     // The numbers below correspond to role_ids in the DB
     // Only exceptions are admins - they see everything by default

     // Wardens
     if ($theSentry->hasPermission(2))
     {
         echo "<div class='fullboxheader'><a href='#' id='ax' onclick=\"toggleDiv('a','ax');\"/>[-]</a> <b>Warden Tools</b></div>";
         echo "<div class='fullbox' id='a'>";
         echo "<ul>";
         echo "<li><a href='callout.php'>Start a Callout</a></li>";
         echo "<li><a href='send_sms.php'>Send Non-Callout Group SMS Messages</a></li>";
         echo "</ul>";
         echo "</div>";
     }

     // Core Team Members
     if ($theSentry->hasPermission(3))
     {
         echo "<div class='fullboxheader'><a href='#' id='bx' onclick=\"toggleDiv('b','bx');\"/>[-]</a> <b>Core Team Tools</b></div>";
         echo "<div class='fullbox' id='b'>";
         echo "<ul>";
         echo "<li><a href='file_search.php'>Search</a> / <a href='file_upload_form.php'>Upload</a> Files</a></li>";
         echo "</ul>";
         echo "</div>";
     }

     // General ICRO members
     if ($theSentry->hasPermission(4))
     {
         echo "<div class='fullboxheader'><a href='#' id='cx' onclick=\"toggleDiv('c','cx');\"/>[-]</a> <b>General Tools</b></div>";
         echo "<div class='fullbox' id='c'>";
         echo "<ul>";
         echo "<li><a href='gen_calloutlist.php'>Generate a Callout List</a></li>";
         echo "<li><a href='profile.php'>View</a> / <a href='edit_profile.php?user_id=".$_SESSION['user_id']."'>Edit</a> your Callout Information</a></li>";
         echo "<li><a href='change_password.php'>Change</a> your password</a></li>";
         echo "</ul>";
         echo "</div>";
     }

     // Admin specific stuff
     if ($theSentry->hasPermission(1))
     {
         echo "<div class='fullboxheader'><a href='#' id='dx' onclick=\"toggleDiv('d','dx');\"/>[-]</a> <b>Site Admin Tools</b></div>";
         echo "<div class='fullbox' id='d'>";
         echo "<ul>";
         echo "<li><a href='dump_db.php'>Dump DB (for backup or offline use)</a><br/></li>";
         echo "<li><a href='quick_add.php'>Quickly Add a Basic User</a><br/></li>";
         echo "<li><a href='user_add.php'>Add</a>&nbsp;/&nbsp;<a href='user_mod.php'>Modify</a>&nbsp;/&nbsp;<a href='user_del.php'>Delete</a> a User<br/></li>";
         echo "<li><a href='reset_password.php'>Reset</a> a users password</a></li>";
         echo "<li><a href='user_roles.php'>Change</a> a users roles</a></li>";
         echo "</ul>";
         echo "</div>";
     }
 }
 
 // End the page
 echo "<div id='clear_both' style='clear:both;'></div></div>";
 require("template/footer.html");
?>

