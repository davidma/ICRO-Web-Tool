<?php    

 // Start the page
 require("template/header.php");
 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>Link Documents to Cave</div>";
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
         if (isset($_POST['doc_id']) && isset($_POST['cave_id']))
         {
             $res = $theDB->doQuery("replace into cave_docs (cave_id,doc_id) values (".$_POST['cave_id'].",".$_POST['doc_id'].");"); 

             if ($res)
             {
                 $theLogger->log("Doc_id ".$_POST['doc_id']." linked sucessfully to cave_id ".$_POST['cave_id']);
                 echo "Document linked sucessfully to cave<br/>";
             }
             else
             {
                 echo "Document linking failed - ".$theDB->lasterror()."<br/>";
             }
         }
         else
         {
             echo "<form action='link_cave_docs.php' method='post'>";

             echo "Select a Document:<br/><br/>";

             $res = $theDB->fetchQuery("select doc_id,title,name from documents;");

             if (!$res)
             {
                 echo "No caves found!";
                 die();
             }
             else
             {
                 echo "<select name=doc_id>";

                 for ($i=0; $i<count($res); $i++)
                 {
                     echo "<option value='".$res[$i]['doc_id']."'>".$res[$i]['title']." - ".$res[$i]['name']."</option>";
                 }

                 echo "</select>";
             }

             echo "<br/><br/>";

             echo "Select a Cave:<br/><br/>";

             $res = $theDB->fetchQuery("select cave_id,name,county from caves where enabled = '1' order by county,name;");

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

             echo "<br/><br/>";
             echo "<INPUT TYPE='submit' value='Link Doc to Cave'/>";
             echo "</form>";
         }
     }
 }
 
 // End the page
 echo "<div id='clear_both' style='clear:both;'></div></div>";
 require("template/footer.html");
?>
