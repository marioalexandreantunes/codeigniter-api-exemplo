<?php

namespace App\Libraries;

class Api{

    public static function get($city, $days){
        $curl = curl_init();
        
        /*
            Vamos ler ficheiro .env onde terá a API_KEY de acesso.
            API_KEY = qwertyuiopasdfghjklçzxcvbnmqwert
        */

        $api_key = getenv('API_KEY');

        curl_setopt_array($curl, [
          CURLOPT_URL => "http://api.weatherapi.com/v1/forecast.json?key=" . $api_key . "&q=" . $city . "&days=" . $days . "&aqi=no&alerts=no&lang=pt",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => [
            "Accept: */*",
          ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            return[ 
                'status' => 'error' ,
                'message' => $err,
                'data' => null
            ];
        } else {
            return[ 
                'status' => 'success' ,
                'message' => null,
                'data' =>  $response
            ];
        }
    }

    public static function get_location ($results){
        $data = json_decode($results['data'], true);
        $location = [];
        $location['name'] = $data['location']['name'];
        $location['region'] = $data['location']['region'];
        $location['country'] = $data['location']['country'];
        $location['current_time'] = $data['location']['localtime'];
        return $location;
    }

    public static function get_current ($results){
        $data = json_decode($results['data'], true);
        $current = [];
        $current['info'] = 'Neste momento:';
        $current['temperature'] = $data['current']['temp_c'];
        $current['condition'] = $data['current']['condition']['text'];
        $current['condition_icon'] = $data['current']['condition']['icon'];
        return $current;
    }

    public static function get_forecast ($results) {
        $data = json_decode($results['data'], true);
        $forecast = [];
        foreach($data['forecast']['forecastday'] as $day){
            $forecast_day = [];
            $forecast_day['info'] = null;
            $forecast_day['date'] = $day['date'];
            $forecast_day['condition'] = $day['day']['condition']['text'];
            $forecast_day['condition_icon'] = $day['day']['condition']['icon'];
            $forecast_day['max_temp'] = $day['day']['maxtemp_c'];
            $forecast_day['min_temp'] = $day['day']['mintemp_c'];
            $forecast[] = $forecast_day;
        }
        return $forecast;
    }

}