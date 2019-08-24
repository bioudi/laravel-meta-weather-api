<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 3/23/19
 * Time: 7:58 PM
 */

namespace Bioudi\LaravelMetaWeatherApi;

use Bioudi\LaravelMetaWeatherApi\Src\Exceptions\LaravelMetaWeatherApiException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TooManyRedirectsException;

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
        try{
            $response = $this->client->request('GET', 'search/?query='.$query);
            if($response->getStatusCode() == 200){
                $result = json_decode($response->getBody()->getContents());
                if (count($result) > 0){
                    return $result[0]->woeid;
                }
                return 'No result found !';
            }
        } 
        catch (ClientException | RequestException | ConnectException | ServerException | TooManyRedirectsException $e) {
            throw new LaravelMetaWeatherApiException($e->getMessage());
        }
    }

    private function getWeather($query, $date){
        $woeid = $this->getWoeid($query);
        if (!is_numeric($woeid)){
            return $woeid;
        }
        if(!is_null($date)){
            $woeid .= '/'.$date;
        }
        try{
            $response = $this->client->request('GET', ''.$woeid);
            if($response->getStatusCode() == 200){
                return  json_decode($response->getBody()->getContents());
            }
        } catch (ClientException | RequestException | ConnectException | ServerException | TooManyRedirectsException $e) {
            throw new LaravelMetaWeatherApiException($e->getMessage());
        }
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