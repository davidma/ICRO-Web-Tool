<?php    

 // Start the page
 require("template/header.php");
 echo "<div class='newsbox'>";
 echo "<div class='newstitle'>Categorise Documents</div>";
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
         if (isset($_POST['categories']))
         {
             $cat_array = $_POST['categories'];

             $theLogger->log("Clearing categories for document ".$_POST['doc_id']);
             $theDB->doQuery("delete from category_docs where doc_id = '".$_POST['doc_id']."';");

             for ($i=0; $i<count($cat_array); $i++)
             {
                 $res = $theDB->doQuery("insert into category_docs values (".$cat_array[$i].",".$_POST['doc_id'].");");
  
                 if ($res)
                 {
                     $theLogger->log("Added category ".$cat_array[$i]." for doc id ".$_POST['doc_id']);
                     echo "Added category ".$cat_array[$i]." for document<br/>";
                 }
                 else
                 {
                     echo "Failed to add category ".$cat_array[$i]." for document ".$theDB->lasterror()."<br/>";
                 }
             }
            
             echo "<br/>Return to <a href='index.php'>main menu?</a><br/>";
         }
         else if (isset($_POST['doc_id']) or isset($_GET['doc_id']))
         {
             $curr_doc_id = isset($_POST['doc_id']) ? $_POST['doc_id'] : $_GET['doc_id'];

             echo "Select the categories you want the document (doc_id: $curr_doc_id) to be a part of:<br/><br/>";
             echo "<form action='categorise_docs.php' method='post'>";
             echo "<input type='hidden' name='doc_id' value='$curr_doc_id'>";

             $result = $theDB->fetchQuery("select category_id from category_docs where doc_id = '$curr_doc_id'");

             $doc_categories = array();
             for ($i=0; $i<count($result); $i++)
             {
                 array_push($doc_categories,$result[$i]['category_id']);
             }

             $categories = $theDB->fetchQuery('select * from category;');
             if (!$categories) { echo "No categories found"; die(); }

             for ($i=0; $i<count($categories); $i++)
             {
                 if (in_array($categories[$i]['category_id'],$doc_categories))
                 {
                     echo "<INPUT NAME='categories[]' TYPE='CHECKBOX' VALUE='".$categories[$i]['category_id']."' CHECKED>".$categories[$i]['category_name']."  ";
                 }
                 else
                 {
                     echo "<INPUT NAME='categories[]' TYPE='CHECKBOX' VALUE='".$categories[$i]['category_id']."'>".$categories[$i]['category_name']."  ";
                 }

                 echo "<br/>";
             }

             echo "<br/><input type=submit value='Update Categories'>";
             echo "</form>";
         }
         else
         {
             echo "Select a Document to categorise:<br/><br/>";
             echo "<form action='categorise_docs.php' method='post'>";

             $res = $theDB->fetchQuery("select doc_id,title,name from documents order by doc_id desc;");

             if (!$res)
             {
                 echo "No docs found!";
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

             echo "<INPUT TYPE='submit' value='Categorise Document'/>";
             echo "</form>";
         }
     }
 }
 
 // End the page
 echo "<div id='clear_both' style='clear:both;'></div></div>";
 require("template/footer.html");
?>