<?php    
 require("template/header.php");
?>

<div class='newsbox'>
<div class='newstitle'>Document List</div>
<div class='newscontent'>

<?php
 if ($theSentry->login())
 {
     if ($theSentry->hasPermission(3))
     {
         if (isset($_POST['category_id']))
         {
             $result = 0;

             if ($_POST['category_id'] > 0)
             {
                 $result = $theDB->fetchQuery("select * from documents d, category_docs c where d.doc_id = c.doc_id and c.category_id = '".$_POST['category_id']."' order by c.doc_id");
             }
             else
             {
                 $result = $theDB->fetchQuery("select * from documents order by doc_id");
             }

             if(!$result)
             {
                 echo "No documents found for this category<br/>";
             }
             else
             {
                 echo '<center><table border=1 width=95%>';
                 echo '<tr bgcolor=grey>';
                 //echo '<td width=40%>Title</td><td width=20%>Filename</td><td width=20%>Type</td><td width=20%>Size</td>';
                 echo '<td width=60%>Title</td><td width=20%>Type</td><td width=20%>Size</td>';
                 echo '</tr>';

                 for ($i=0; $i < count($result); $i++)
                 {
                     echo '<tr>';
                     echo '<td width=60%><a href="get_document.php?doc_id='.$result[$i]['doc_id'].'">'.$result[$i]['title'].'</a></td>';
                     //echo '<td width=60%>'.$result[$i]['name'].'</td>';
                     echo '<td width=20%>'.$result[$i]['type'].'</td>';
                     echo '<td width=20%>'.$result[$i]['size'].'</td>';
                     echo '</tr>';
                 }
                 echo '</table></center>';
             }
            
             echo "<br/>Return to <a href='index.php'>main menu</a> or <a href='list_documents.php'>browse another category?</a><br/>";
         }
         else
         {
             echo "Select a Document Category to browse:<br/><br/>";

             echo "<form action='list_documents.php' method='post'>";

             $res = $theDB->fetchQuery("select * from category order by category_id");

             if (!$res)
             {
                 echo "No categories found!";
                 die();
             }
             else
             {
                 echo "<select name=category_id>";

                 echo "<option value='0'>All Documents</option>";

                 for ($i=0; $i<count($res); $i++)
                 {
                     echo "<option value='".$res[$i]['category_id']."'>".$res[$i]['category_name']."</option>";
                 }

                 echo "</select>";
             }

             echo "<INPUT TYPE='submit' value='View Documents'/>";
             echo "</form>";
         }
     }
 }
 else
 {
     echo "You need to be logged in to view this page - use the links above...";
 }
?>


</div>
</div>

<?php
 require("template/footer.html");
?>