<?php

namespace App\Controllers;

use App\Models\StockModel;
use CodeIgniter\Controller;

class StockController extends Controller
{
    public function index()
    {
        $stockModel = new StockModel();
        $data['products'] = $stockModel->findAll();
        return view('Pages/instock', $data);
    }

    public function store()
    {
        $stockModel = new StockModel();

        $data = [
            'order_id' => $this->request->getPost('order_id'),
            'product' => $this->request->getPost('product'),
            'category' => $this->request->getPost('category'),
            'sales_channel' => $this->request->getPost('sales_channel'),
            'instruction' => $this->request->getPost('instruction'),
            'items' => $this->request->getPost('items'),
            'status' => $this->request->getPost('status'),
        ];

        if ($stockModel->insert($data)) {
            return $this->response->setJSON(['success' => true]);
        } else {
            return $this->response->setJSON(['success' => false]);
        }
    }
}
