# laravel-meta-weather-api
Simple laravel package Consume the [MetaWeather  API](https://www.metaweather.com/api/).

---
## MetaWeather API Examples
Please note that the MetaWeather API does not require any form of authentication. See the [MetaWeather API documentation](https://www.metaweather.com/api/) for all supported methods and parameters.

**Important:** the API does not support CORS.
## Installation

To get the latest version of laravel-meta-weather-api on your project, require it from "composer":

	$ composer require bioudi/laravel-meta-weather-api
	
### Laravel

Register the provider directly in your app configuration file config/app.php `config/app.php`:

```php
'providers' => [
	// ...

	Bioudi\LaravelMetaWeatherApi\WeatherserviceProvider::class
]
```
## Usage
```php
use Bioudi\LaravelMetaWeatherApi\Weather;
$weather = new Weather();
```
### Search by city name
```php
$weather->getByCityName('casablanca');
```
#### Output
```json
{
  "consolidated_weather": [
    {
      "id": 6739825128374272,
      "weather_state_name": "Light Cloud",
      "weather_state_abbr": "lc",
      "wind_direction_compass": "NE",
      "created": "2019-03-24T10:23:58.103425Z",
      "applicable_date": "2019-03-24",
      "min_temp": 11.86,
      "max_temp": 24.58,
      "the_temp": 23.2,
      "wind_speed": 4.869768947042604,
      "wind_direction": 35.5,
      "air_pressure": 1014.9549999999999,
      "humidity": 56,
      "visibility": 13.852227988546886,
      "predictability": 70
    }
  ],
  "time": "2019-03-24T11:40:48.477916Z",
  "sun_rise": "2019-03-24T06:29:23.305030Z",
  "sun_set": "2019-03-24T18:44:48.967938Z",
  "timezone_name": "LMT",
  "parent": {
    "title": "Morocco",
    "location_type": "Country",
    "woeid": 23424893,
    "latt_long": "31.434200,-6.402450"
  },
  "sources": [
    {
      "title": "BBC",
      "slug": "bbc",
      "url": "http://www.bbc.co.uk/weather/",
      "crawl_rate": 180
    },
    {
      "title": "Forecast.io",
      "slug": "forecast-io",
      "url": "http://forecast.io/",
      "crawl_rate": 480
    },
    {
      "title": "Met Office",
      "slug": "met-office",
      "url": "http://www.metoffice.gov.uk/",
      "crawl_rate": 180
    },
    {
      "title": "OpenWeatherMap",
      "slug": "openweathermap",
      "url": "http://openweathermap.org/",
      "crawl_rate": 360
    },
    {
      "title": "Weather Underground",
      "slug": "wunderground",
      "url": "https://www.wunderground.com/?apiref=fc30dc3cd224e19b",
      "crawl_rate": 720
    },
    {
      "title": "World Weather Online",
      "slug": "world-weather-online",
      "url": "http://www.worldweatheronline.com/",
      "crawl_rate": 360
    },
    {
      "title": "Yahoo",
      "slug": "yahoo",
      "url": "http://weather.yahoo.com/",
      "crawl_rate": 180
    }
  ],
  "title": "Casablanca",
  "location_type": "City",
  "woeid": 1532755,
  "latt_long": "33.596611,-7.619340",
  "timezone": "Africa/Casablanca"
}
```
### Search by city name and date
```php
$weather->getByCityName('london', '2018/03/03');
```
### Search by coordinates
```php
$weather->getByCoordinates(36.96, -122.02);
```
### Search by coordinates and date
```php
$weather->getByCoordinates(36.96, -122.02, '2018/01/01');
```
## Credits
- Thanks to [MetaWeather](https://www.metaweather.com/) for providing an Open API to the Internet.


