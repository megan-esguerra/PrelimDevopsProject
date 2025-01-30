<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Orders extends BaseController
{
    public function index()
    {
        $data = [
            'orders' => [
                [
                    'id' => '#7676',
                    'date' => '06/30/2022',
                    'customer' => 'Ramesh Chaudhary',
                    'sales_channel' => 'Store name',
                    'destination' => 'Lalitpur',
                    'items' => 3,
                    'status' => 'Completed',
                ],
                [
                    'id' => '#7676',
                    'date' => '06/30/2022',
                    'customer' => 'Ramesh Chaudhary',
                    'sales_channel' => 'Store name',
                    'destination' => 'Lalitpur',
                    'items' => 3,
                    'status' => 'Pending',
                ],
                // Add more mock data here
            ],
        ];

        return view('orders', $data);
    }
}
