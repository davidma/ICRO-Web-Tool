<?php    
 require("template/header.php");
?>

<div class='newsbox'>
<div class='newstitle'>Archived Callout Records</div>
<div class='newscontent'>

<?php
 if ($theSentry->login())
 {
     $result = $theDB->fetchQuery("select * from rescues r,caves c where r.cave_id = c.cave_id and status = '0' order by date");

     if(!$result)
     {
         echo "No callouts found";
     }
     else
     {
         echo '<center><table border=1 width=95%>';
         echo '<tr bgcolor=grey>';
         echo '<td width=40%>Cave</td><td width=30%>Type</td><td width=30%>Date</td>';
         echo '</tr>';

         for ($i=0; $i < count($result); $i++)
         {
             $type = ($result[$i]['type'] == 1) ? 'Rescue' : 'Rescue Practice';             
             echo '<tr>';
             echo '<td width=40%><a href="view_callout.php?id='.$result[$i]['rescue_id'].'">'.$result[$i]['name'].', '.$result[$i]['county'].'</a></td>';
             echo "<td width=30%>$type</td>";
             echo '<td width=30%>'.$result[$i]['date'].'</td>';
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

