<?php    
 require("template/header.php");
?>

<div class='newsbox'>
<div class='newstitle'>Document List</div>
<div class='newscontent'>

<?php
 if ($theSentry->login())
 {
     $result = $theDB->fetchQuery("select * from documents order by doc_id");

     if(!$result)
     {
         echo "No documents found";
     }
     else
     {
         echo '<center><table border=1 width=95%>';
         echo '<tr bgcolor=grey>';
         echo '<td width=40%>Title</td><td width=20%>Filename</td><td width=20%>Type</td><td width=20%>Size</td>';
         echo '</tr>';

         for ($i=0; $i < count($result); $i++)
         {
             echo '<tr>';
             echo '<td width=40%><a href="get_document.php?doc_id='.$result[$i]['doc_id'].'">'.$result[$i]['title'].'</a></td>';
             echo '<td width=20%>'.$result[$i]['name'].'</td>';
             echo '<td width=20%>'.$result[$i]['type'].'</td>';
             echo '<td width=20%>'.$result[$i]['size'].'</td>';
             echo '</tr>';

         }
         echo '</table></center>';
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

