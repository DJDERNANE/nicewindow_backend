<?php

namespace App\Helpers;

class Geolocation {
  public static function get_lat_lon($address)
  {
    $address = urlencode($address);
    
    $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?key=AIzaSyAsmEvYMC-56OfGlxq8QOsqCnlfSthYAFU&address=$address&sensor=false");
    $json = json_decode($json);

    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

    return ['latitude' => $lat, 'longitude' => $long];
  }

  public static function distanceInKm($lat1, $lon1, $lat2, $lon2)
  {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    return $dist * 60 * 1.45 * 1.609344;
  }
}