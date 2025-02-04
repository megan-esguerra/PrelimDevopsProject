<?php

namespace App\Controllers;

use App\Models\InStockModel;
use CodeIgniter\Controller;

class InStockController extends Controller
{
    public function index()
    {
        $model = new InStockModel();
        $data['stocks'] = $model->getAllStock();

        return view('in_stock', $data);
    }

    public function addStock()
    {
        return view('add_stock'); // View for adding new stock
    }

    public function saveStock()
    {
        $model = new InStockModel();
        $data = [
            'order_id'      => $this->request->getPost('order_id'),
            'product'       => $this->request->getPost('product'),
            'category'      => $this->request->getPost('category'),
            'sales_channel' => $this->request->getPost('sales_channel'),
            'instruction'   => $this->request->getPost('instruction'),
            'items'         => $this->request->getPost('items'),
            'status'        => $this->request->getPost('status'),
        ];

        $model->insert($data);
        return redirect()->to('/in-stock');
    }
}
