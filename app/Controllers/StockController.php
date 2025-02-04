<?php

namespace App\Controllers;

use App\Models\StockModel;


class StockController extends BaseController
{
    public function index()
    {
        $stockModel = new StockModel();
        $data['stocks'] = $stockModel->getInStockItems(); // Fetch in-stock items

        return view('instock', $data);
    }
}
