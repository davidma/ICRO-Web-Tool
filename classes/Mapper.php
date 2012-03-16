<?php

//-------------------------------------------------------------------------------------------------
// Mapper.php
//
// Class to generate Maps (currently via Google Maps API)
//
// Dave Masterson, Oct 2009
//-------------------------------------------------------------------------------------------------

class Mapper
{
    var $last_error;

    //-----------------------------------------------------------------------------------------
    // Creates a new SMS object
    //-----------------------------------------------------------------------------------------
    function Mapper()
    {
        // Need Google Maps API Key
        require('/var/www/html/ICRO-Web-Tool/config/config.php');
  
        // Initialise the login details
        $this->api_id   = $MAPS_API_KEY;
     
        // no errors yet
        $this->last_error = '';
    }


    //-----------------------------------------------------------------------------------------
    // Generates the code for the head section of html - required by google maps
    //-----------------------------------------------------------------------------------------
    function generateHeaderHTML()
    {
        $html = "<script src='http://maps.google.com/maps?file=api&v=2&key=".$this->api_id."' type='text/javascript'></script>";

        return $html;
    }


    //-----------------------------------------------------------------------------------------
    // Generates the HTML needed to display a static Map of a given address (to a specified 
    // width and height)
    // Returns HTML string
    //-----------------------------------------------------------------------------------------
    function generateStaticAddressMapHTML($address,$w,$h) 
    {
        $enc = urlencode($address);

        $html  = "<img border=1 src='http://maps.google.com/maps/api/staticmap?";
        $html .= "center=$enc&markers=color:blue|label:A|$enc&zoom=12&size=".$w;
        $html .= "x".$h."&maptype=roadmap&sensor=false&key=".$this->api_id."'>";

        return $html;
    }

    
    //-----------------------------------------------------------------------------------------
    // Generates the HTML needed to display a dynamic Map of a given Lat Long (to a specified 
    // width and height)
    // Returns HTML string
    //-----------------------------------------------------------------------------------------
    function generateDynamicLatLongMapHTML($lat,$long,$w,$h,$headerText,$descText,$draggable)
    {
        $html  = "<div id='map' style='width: ".$w."px; height: ".$h."px; border: 1px solid black;'> </div>\n";
	$html .= "<script type='text/javascript'>\n";
        $html .= "//<![CDATA[\n";
        $html .= "if (GBrowserIsCompatible()) {\n";
        $html .= "var map = new GMap2(document.getElementById('map'));\n";
        $html .= "map.setMapType(G_HYBRID_MAP);\n";
	$html .= "map.addControl(new GSmallMapControl());\n";
	$html .= "map.addControl(new GMapTypeControl());\n";
	//$html .= "map.addControl(new GNavLabelControl());\n";
        $html .= "var point = new GLatLng($lat,$long);\n";
        $html .= "map.setCenter(point,12);\n";
	if($draggable)
	{
		$html .= "var marker = new GMarker(point, {draggable: true, title: 'Move me to update location' });\n";	
		$html .= "GEvent.addListener(marker,'dragend', function(p) {\n";
	        $html .= "map.panTo(p);\n});";		
		$html .= "GEvent.addListener(marker, 'drag', function() {\n";
		$html .= "var point = marker.getLatLng();\n";
		$html .= "document.getElementById('latbox').value=point.y;document.getElementById('lonbox').value=point.x;});\n";
	}
	else
	{
		$html .= "var marker = new GMarker(point);\n";	
		$html .= "GEvent.addListener(marker,\"click\", function() {\n";
	        $html .= "var myHtml=\"<b>$headerText</b><br>$descText\";\n";
		$html .= "map.openInfoWindowHtml(point, myHtml); \n});\n";
	}	
	$html .= "map.addOverlay(marker);\n";	
	$html .= "}\n";
        $html .= "//]]>\n";
        $html .= "</script>\n";

        return $html;
    }

    //-----------------------------------------------------------------------------------------
    // Generates the HTML needed to display a dynamic Map+directions.Takes in 2 GPS points  
    // (cave+user) with associated names, width and height
    // Returns HTML string
    //-----------------------------------------------------------------------------------------
    function generateDynamicDirextions($cavelat,$cavelong,$cavename,$userlat,$userlong,$userfullname,$w,$h)
    {
	
	$html  = "<table class='directions'><tr><th>Map</th><th>Directions</th></tr>\n"; 
        $html .= "<tr><td valign='top'><div id='map' style='width: ".$w."px; height: 800px; border: 1px solid black;'> </div></td> \n";
	$html .= "<td valign='top'><div id='directions' style='width: ".$w."px; border: 1px solid black;'> </div></td></tr></table>\n";	
	$html .= "<script type='text/javascript'>\n";
        $html .= "//<![CDATA[\n";
        $html .= "if (GBrowserIsCompatible()) {\n";
        $html .= "var map = new GMap2(document.getElementById('map'));\n";
        //$html .= "map.setMapType(G_HYBRID_MAP);\n";
	$html .= "map.addControl(new GMapTypeControl());\n";
	$html .= "var directions = new GDirections(map, document.getElementById('directions'));\n";		
	$html .= "directions.load(\"from: $userfullname@$userlat,$userlong to: $cavename@$cavelat,$cavelong\");\n";
	$html .= "}\n";	
	$html .= "//]]>\n";
        $html .= "</script>\n";

        return $html;
    }
 
    //-----------------------------------------------------------------------------------------
    // Generates the HTML needed to display a dynamic Map showing where an array of (lat,lng,string) 
    // points are in relation to a single target point (to a specified width and height)
    //
    // point array need to has associative tags LAT, LNG and DSC for each entry
    //
    // Returns HTML string
    //-----------------------------------------------------------------------------------------
    function generateDynamicMultiLatLongMapHTML($tlat,$tlong,$cavename,$pointarray,$w,$h)
    {
        $html  = "<div id='map' style='width: ".$w."px; height: ".$h."px; border: 1px solid black;'> </div>\n";
	$html .= "<script type='text/javascript'>\n";
        $html .= "//<![CDATA[\n";
        $html .= "if (GBrowserIsCompatible()) {\n";
        $html .= "var map = new GMap2(document.getElementById('map'));\n";
        $html .= "map.setCenter(new GLatLng($tlat,$tlong), 7, G_HYBRID_MAP);\n";
        //$html .= "map.setCenter(new GLatLng(53.426502,-7.948641), 7, G_HYBRID_MAP);\n";
        $html .= "map.addControl(new GSmallMapControl());\n";
	$html .= "map.addControl(new GMapTypeControl());\n";
	$html .= "map.addControl(new GScaleControl());\n";
	//$html .= "map.addControl(new GNavLabelControl());\n";

        // Add the points in the array
        for ($i=0; $i< count($pointarray); $i++)
        {
            $clat = $pointarray[$i]['LAT'];
            $clng = $pointarray[$i]['LNG'];
            $desc = $pointarray[$i]['DSC'];

            $html .= "var point$i = new GLatLng($clat,$clng);\n";
            $html .= "var marker$i = new GMarker(point$i);\n";
            $html .= "GEvent.addListener(marker$i, 'click', function() {marker$i.openInfoWindowHtml('$desc');});";
            $html .= "map.addOverlay(marker$i);\n";
        }
 
        // Add a special icon for the cave...   
        $html .= "var pointX = new GLatLng($tlat,$tlong);\n";
        $html .= "var targetIcon = new GIcon(G_DEFAULT_ICON);\n";
        $html .= "targetIcon.image = 'images/regroup.png';\n";
        $html .= "markerOptions = { icon:targetIcon };";
        $html .= "var markerX = new GMarker(pointX,markerOptions);\n";
        $html .= "GEvent.addListener(markerX, 'click', function() {markerX.openInfoWindowHtml('$cavename');});";
        $html .= "map.addOverlay(markerX);\n";

        $html .= "};\n";
        $html .= "</script>\n";
        
        return $html;
    }


    //-----------------------------------------------------------------------------------------
    // Returns the last error string
    //-----------------------------------------------------------------------------------------
    function lastError()
    {
        return $this->last_error;
    }
}

?>
