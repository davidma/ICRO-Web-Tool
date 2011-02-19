<?php    

 // Start the page
 require("template/header.php");
 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>Download Current DB</div>";
 echo "<div class='newscontent'>";

 // If its a non-logged in user, display public text
 if (!$theSentry->login())
 {
     echo "You need to be logged in to view this page"; 
 }
 else
 {
     if ($theSentry->hasPermission(1)) // Admins only
     {
        // Connection details for the DB
        require('/var/www/html/icro/config/config.php');

        $timestamp = date("Ymd-Hms");
        system("rm -f $DB_NAME.*.sql $DB_NAME.*.sql.gz");
        system("mysqldump --quick -u$DB_USER -p$DB_PASS -h$DB_HOST $DB_NAME > $DB_NAME.$timestamp.sql");
        system("gzip $DB_NAME.$timestamp.sql");

        print "Click <a href='$DB_NAME.$timestamp.sql.gz'>here</a> to download a dump of the current DB<br/>";
     }
 }
 
 // End the page
 echo "<div id='clear_both' style='clear:both;'></div></div>";
 require("template/footer.html");
?>

