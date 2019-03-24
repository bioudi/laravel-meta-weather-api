<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 3/23/19
 * Time: 7:58 PM
 */

namespace Bioudi\LaravelMetaWeatherApi;

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
            return 'No result found !';
        }
        return 'Api service responds with '.$response->getStatusCode().' !';
    }

    private function getWeather($query, $date){
        $woeid = $this->getWoeid($query);
        if (!is_numeric($woeid)){
            return $woeid;
        }
        if(!is_null($date)){
            $woeid .= '/'.$date;
        }
        $response = $this->client->request('GET', ''.$woeid);
        if($response->getStatusCode() == 200){
            return  json_decode($response->getBody()->getContents());
        }
        return 'Api service responds with '.$response->getStatusCode().' !';
    }



    public function getByCityName($city, $date = null)
    {
        return $this->getWeather($city, $date);
    }

    public function getByCoordinates($lat, $lon, $date = null)
    {
        return $this->getWeather($lat.','.$lon, $date);
    }
}