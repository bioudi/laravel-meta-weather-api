<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 3/23/19
 * Time: 7:55 PM
 */

namespace Bioudi\LaravelMetaWeatherApi;

use Bioudi\LaravelWeather\Weather;
use Illuminate\Support\ServiceProvider;

class WeatherserviceProvider extends ServiceProvider {

    public function boot()
    {
    }

    public function register()
    {
        $this->app->singleton('Weather', function()
        {
            return new Weather();
        });
    }
}