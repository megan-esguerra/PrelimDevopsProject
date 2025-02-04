<?php

namespace App\Controllers;

use App\Models\ProductModel;


class StockController extends BaseController
{
    public function index()
    {
        $stockModel = new ProductModel();
        $data['products'] = $stockModel->getInStockItems(); // Fetch in-stock items

        return view('instock', $data);
    }
}
