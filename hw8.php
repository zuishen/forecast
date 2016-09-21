<?php

    if(!isset($_GET["street"])) echo "no street";
    else {
        $street = $_GET["street"];
        if(!isset($_GET["city"])) echo ",no city";
        else {
            $city = $_GET["city"];
            if(!isset($_GET["state"])) echo ",no state";
            else {
                $state = $_GET["state"];
                if(!isset($_GET["unit"])) echo ", no unit!";
                else {
                    $xurl = $street.",".$city.",".$state;
                    $xurl = str_replace(" ","+", $xurl);
                    $xurl = "https://maps.google.com/maps/api/geocode/xml?address=".$xurl."&key=AIzaSyA67Lzzve9wYGkJGz9OFfPPuP8ddan_jj8";

                    
                    $xoutput = file_get_contents($xurl);
                    $xml=simplexml_load_string($xoutput);
                    if($xml->status != "OK")
                    {
                        echo "Cannot get the xml data, please try again later!";
                    }  else {
                    $lat = $xml->result->geometry->location->lat;
                    $lng = $xml->result->geometry->location->lng;
 //                   echo $lat, $lng;
                    
                    
                    
      //             echo "c28f86b770fbba73f3db6eb2195fee7f";
                    $unit = $_GET["unit"];
                    $jurl = "https://api.forecast.io/forecast/c28f86b770fbba73f3db6eb2195fee7f/".$lat.",".$lng."?units=".$unit."&exclude=flags";
                    

                    
                   // header("Content-Type:application/json");
                    $joutput =  file_get_contents($jurl);
                    echo $joutput;
                        
                        
                    }
                }
            }
        }
    }
?>