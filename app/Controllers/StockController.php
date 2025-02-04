<?php

namespace App\Controllers;

use App\Models\StockModel;
use CodeIgniter\Controller;

class StockController extends Controller
{
    public function index()
    {
        $stockModel = new StockModel();
        $data['stocks'] = $stockModel->getInStockItems(); // Fetch in-stock items

        return view('instock', $data);
    }
}
