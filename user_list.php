<?php    
 require("template/header.php");
?>

<div class='newsbox'>
<div class='newstitle'>User List</div>
<div class='newscontent'>

<?php
 if ($theSentry->login())
 {
     $result = $theDB->fetchQuery("select * from users order by last_name");

     if(!$result)
     {
         echo "No users found";
     }
     else
     {
         echo '<center><table border=1 width=95%>';
         echo '<tr bgcolor=grey>';
         echo '<td width=40%>Name</td><td width=25%>Town</td><td width=25%>County</td>';
         echo '</tr>';

         for ($i=0; $i < count($result); $i++)
         {
             echo '<tr>';
             echo '<td width=40%><a href="profile.php?user_id='.$result[$i]['user_id'].'">'.$result[$i]['last_name'].', '.$result[$i]['first_name'].'</a></td>';
             echo '<td width=25%>'.$result[$i]['town'].'</td>';
             echo '<td width=25%>'.$result[$i]['county'].'</td>';
             echo '</tr>';

         }
         echo '</table></center>';
     }
 }
 else
 {
     echo "You need to be logged in to view userlist - use the links above...";
 }
?>


</div>
</div>

<?php
 require("template/footer.html");
?>

