<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 3/23/19
 * Time: 7:58 PM
 */

namespace Bioudi\LaravelWeather;

use GuzzleHttp\Client;

class Weather
{
    protected $url = 'https://www.metaweather.com/api/location/';
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->url,
            'timeout'  => 10.0,
        ]);
    }

    private function getWoeid($query){
        $response = $this->client->request('GET', 'search/?query='.$query);
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody()->getContents());
            if (count($result) > 0){
                return $result[0]->woeid;
            }
        }
    }

    private function getWeather($woeid){
        $response = $this->client->request('GET', ''.$woeid);
        if($response->getStatusCode() == 200){
            return  json_decode($response->getBody()->getContents());
        }
    }



    public function getByCityName($city, $date = null)
    {
        $woeid = $this->getWoeid($city);
        return $this->getWeather($woeid);
    }

    public function getByCoordinates($lat, $lon, $date = null)
    {
        $woeid = $this->getWoeid($lat.','.$lon);
        return $this->getWeather($woeid);
    }
}