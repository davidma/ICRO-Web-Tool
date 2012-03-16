<?php    

 // Start the page
 require("template/header.php");
 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>Link Documents to Rescues</div>";
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
         if (isset($_POST['doc_id']) && isset($_POST['rescue_id']))
         {
             $res = $theDB->doQuery("replace into rescue_docs (rescue_id,doc_id) values (".$_POST['rescue_id'].",".$_POST['doc_id'].");"); 

             if ($res)
             {
                 $theLogger->log("Doc_id ".$_POST['doc_id']." linked sucessfully to rescue_id ".$_POST['rescue_id']);
                 echo "Document linked sucessfully to Rescue<br/>";
             }
             else
             {
                 echo "Document linking failed - ".$theDB->lasterror()."<br/>";
             }
         }
         else
         {
             echo "<form action='link_rescue_docs.php' method='post'>";

             echo "Select a Document:<br/><br/>";

             $res = $theDB->fetchQuery("select doc_id,title,name from documents;");

             if (!$res)
             {
                 echo "No documents found!";
                 die();
             }
             else
             {
                 echo "<select name=doc_id>";

                 for ($i=0; $i<count($res); $i++)
                 {
                     echo "<option value='".$res[$i]['doc_id']."'>".$res[$i]['title']."</option>";
                 }

                 echo "</select>";
             }

             echo "<br/><br/>";

             echo "Select a Rescue:<br/><br/>";

             $res = $theDB->fetchQuery("select r.date,r.rescue_id,c.name,c.county from rescues r, caves c where r.cave_id = c.cave_id order by date desc;");

             if (!$res)
             {
                 echo "No rescues found!";
                 die();
             }
             else
             {
                 echo "<select name=rescue_id>";

                 for ($i=0; $i<count($res); $i++)
                 {
                     echo "<option value='".$res[$i]['rescue_id']."'>".$res[$i]['date']." - ".$res[$i]['name']."</option>";
                 }

                 echo "</select>";
             }

             echo "<br/><br/>";
             echo "<INPUT TYPE='submit' value='Link Doc to Rescue'/>";
             echo "</form>";
         }
     }
 }
 
 // End the page
 echo "<div id='clear_both' style='clear:both;'></div></div>";
 require("template/footer.html");
?>
