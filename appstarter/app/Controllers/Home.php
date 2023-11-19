<?php

namespace App\Controllers;

use App\Libraries\Api;

class Home extends BaseController
{
    public function index(): string
    {
        $city = "Lisbon";
        $days = 5;

        $results = Api::get($city, $days);
        if ($results['status'] == 'error') {
            return $results['messages'];
        }

        // vamos obter da API a informação que precisamos

        $location = Api::get_location($results);
        $current = Api::get_current($results);
        $forecast = Api::get_forecast($results);

        $data = [
            'location' => $location,
            'current'  => $current,
            'forecast' => $forecast,
        ];

        return view('index', $data);
    }
}
