<?php    
 require("template/header.php");
?>

<div class='newsbox'>
<div class='newstitle'>Cave List</div>
<div class='newscontent'>

<?php
 if ($theSentry->login())
 {
     $result = $theDB->fetchQuery("select * from caves order by county,name");

     if(!$result)
     {
         echo "No caves found";
     }
     else
     {
         echo '<center><table border=1 width=95%>';
         echo '<tr bgcolor=grey>';
         echo '<td width=60%>Name</td><td width=40%>County</td>';
         echo '</tr>';

         for ($i=0; $i < count($result); $i++)
         {
             echo '<tr>';
             echo '<td width=60%><a href="cave.php?cave_id='.$result[$i]['cave_id'].'">'.$result[$i]['name'].'</a></td>';
             echo '<td width=40%>'.$result[$i]['county'].'</td>';
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

