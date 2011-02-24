<?php    

 // Start the page
 require("template/header.php");
 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>Modify a Cave</div>";
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
             echo "Select a Cave to modify:<br/><br/>";
             echo "<form action='edit_cave.php' method='get'>";

             $res = $theDB->fetchQuery("select cave_id,name,county from caves;");

             if (!$res)
             {
                 echo "No caves found!";
                 die();
             }
             else
             {
                 echo "<select name=cave_id>";

                 for ($i=0; $i<count($res); $i++)
                 {
                     echo "<option value='".$res[$i]['cave_id']."'>".$res[$i]['county']." - ".$res[$i]['name']."</option>";
                 }

                 echo "</select>";
             }

             echo "<INPUT TYPE='submit' value='Modify Cave'/>";
             echo "</form>";
     }
 }
 
 // End the page
 echo "<div id='clear_both' style='clear:both;'></div></div>";
 require("template/footer.html");
?>
