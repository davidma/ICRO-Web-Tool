<?php    
 require("template/header.php");
?>

<div class='newsbox'>
<div class='newstitle'>Update Cave Maps</div>
<div class='newscontent'>

<?php
 if ($theSentry->login())
 {
     $result = $theDB->fetchQuery("select * from caves where enabled = '1'");

     if(!$result)
     {
         echo "No users found";
     }
     else
     {
         for ($i=0; $i < count($result); $i++)
         {
             $address = $result[$i]['lat'].",".$result[$i]['lng'];
             $url = "http://maps.google.com/maps/api/staticmap?center=".urlencode($address)."&zoom=12&size=415x170&maptype=hybrid&sensor=false";

             $data = file_get_contents($url);
             
             $fh = fopen("images/cavemaps/".$result[$i]['cave_id'].".png", "wb");
             fwrite($fh, $data);
             fclose($fh);

             ####file_put_contents("images/cavemaps/".$result[$i]['cave_id'].".png",$data);

             echo "Generated new map for ".$result[$i]['name']." (".$result[$i]['cave_id'].")<br/>";

             sleep(1);
         }
        
         $theLogger->log("Generated new maps for all caves");
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

