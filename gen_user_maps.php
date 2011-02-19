<?php    
 require("template/header.php");
?>

<div class='newsbox'>
<div class='newstitle'>Update User Maps</div>
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
         for ($i=0; $i < count($result); $i++)
         {
             $address = $result[$i]['town'].", ".$result[$i]['county'].", ".$result[$i]['postcode'];
             $address = preg_replace('/, ,/',',',$address);
             $address = preg_replace('/, $/','',$address);
             $address = preg_replace('/^, /','',$address);

             $url = "http://maps.google.com/maps/api/staticmap?center=".urlencode($address)."&zoom=14&size=415x440&maptype=hybrid&sensor=false";

             $data = file_get_contents($url);
             file_put_contents("images/usermaps/".$result[$i]['user_id'].".png",$data);

             echo "Generated new map for ".$result[$i]['username']."<br/>";
         }
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

