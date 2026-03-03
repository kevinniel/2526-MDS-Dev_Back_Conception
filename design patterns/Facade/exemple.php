<?php


class GoogleMapApi
{
    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getElevation(float $lat, float $lon)
    {
        return json_decode(file_get_contents("https://maps.googleapis.com/maps/api/elevation/json?locations=$lat%2C$lon&key=$this->apiKey"))->results[0]->elevation;
    }
}


$api = new GoogleMapApi('AIzaSyB28h3dTAeiwgMFAOFQoexmB9obhpmeBoE');
var_dump($api->getElevation(39.7391536, -104.9847034));
