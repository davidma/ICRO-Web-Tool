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

             $url = "http://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address)."&region=ie&sensor=false";

             $data = json_decode(file_get_contents($url));
             $lat  = $data->results[0]->geometry->location->lat;
             $lng  = $data->results[0]->geometry->location->lng;
           
             $res = $theDB->doQuery("update users set lat = '$lat', lng = '$lng' where user_id = '".$result[$i]['user_id']."'");

             if ($res)
             {
                 echo "Calculated new Lat/Long for ".$result[$i]['username']." - $lat,$lng - DB updated<br/>";
             }
             else
             {
                 echo "Calculated new Lat/Long for ".$result[$i]['username']." - $lat,$lng - DB not updated<br/>";
             }

             sleep(1);
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

