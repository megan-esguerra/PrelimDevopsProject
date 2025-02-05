<?php

namespace App\Controllers;

use App\Models\StockModel;

class StockController extends BaseController
{
    public function index()
    {
        $stockModel = new StockModel();
        $data['products'] = $stockModel->getInStockItems(); // Fetch in-stock items

        // Debugging: Uncomment these lines if you still get an error
        // echo '<pre>';
        // print_r($data['products']);
        // echo '</pre>';
        // exit();

        return view('Pages/instock', $data);
    }
}
