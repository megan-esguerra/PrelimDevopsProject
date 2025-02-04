<?php

namespace App\Controllers;

use App\Models\StockModel;
use CodeIgniter\Controller;

class StockController extends Controller
{
    public function index()
    {
        $stockModel = new StockModel();
        
        // Fetching stocks by category
        $data['stocks'] = [
            'category1' => $stockModel->where('category', 'Category 1')->where('status', 'in_stock')->findAll(),
            'category2' => $stockModel->where('category', 'Category 2')->where('status', 'in_stock')->findAll(),
            'category3' => $stockModel->where('category', 'Category 3')->where('status', 'in_stock')->findAll(),
        ];
    
        return view('stock/in_stock', $data);
    }
    
}
