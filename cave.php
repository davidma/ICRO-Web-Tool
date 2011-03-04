<?php    
 require("template/header.php");
?>

<div class='newsbox'>
<div class='newstitle'>Cave Profile</div>
<div class='newscontent'>

<?php

 if ($theSentry->login())
 {
     if (isset($_GET['cave_id']))
     {
         $sqlstring = "select * from caves where cave_id = '".$_GET['cave_id']."'";

         $result = $theDB->fetchQuery($sqlstring);

         if(!$result)
         {
             echo "No data returned";
         }
         else
         {
             echo "<div class='rmenubox'><img src='images/cavemaps/".$result[0]['cave_id'].".png'></div>";

             echo "<div class='halfboxheader'><b>Cave</b></div><div class='halfbox'>".$result[0]['name']."</div>";
             echo "<div class='halfboxheader'><b>County</b></div><div class='halfbox'>".$result[0]['county']."</div>";
             echo "<div class='halfboxheader'><b>Latitude</b></div><div class='halfbox'>".$result[0]['lat']."</div>";
             echo "<div class='halfboxheader'><b>Longitude</b></div><div class='halfbox'>".$result[0]['lng']."</div>";
             echo "<div id='clear_both' style='clear:both;'></div>";

             echo "<br/>";

             echo "<div class='fullboxheader'><b>Description</b></div>";

             ## Allow some forum-style tags 
             $description = $result[0]['description'];

             $description = str_replace("\n",'<br/>',$description);
             $description = str_replace('[b]','<b>',$description);
             $description = str_replace('[/b]','</b>',$description);
             $description = str_replace('[u]','<u>',$description);
             $description = str_replace('[/u]','</u>',$description);
             $description = str_replace('[red]','<font color="red">',$description);
             $description = str_replace('[/red]','</font>',$description);
             $description = str_replace('[green]','<font color="green">',$description);
             $description = str_replace('[/green]','</font>',$description);
             $description = str_replace('[blue]','<font color="blue">',$description);
             $description = str_replace('[/blue]','</font>',$description);

             echo "<div class='fullbox'>".$description."</div>";

             echo "<br/>";
             
             echo "<div class='fullboxheader'><b>Linked Documents</b></div>";
             echo "<div class='fullbox'>";

             $result = $theDB->fetchQuery("select d.doc_id,d.name,d.title,d.type,d.size from documents d, cave_docs cd where cd.cave_id = ".$result[0]['cave_id']." and cd.doc_id = d.doc_id order by doc_id");

             if(!$result)
             {
                 echo "No linked documents";
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

             echo "</div>";

         }
     }
     else
     {
         echo "Missing parameter";
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

