<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\SupplierModel;
use CodeIgniter\Controller;

class OrdersController extends Controller
{
    public function index()
    {
        $orderModel = new OrderModel();
        $supplierModel = new SupplierModel();

        $data['orders'] = $orderModel->getOrders();
        $data['suppliers'] = $supplierModel->findAll(); // Fetch suppliers for dropdown

        return view('Pages/orders', $data);
    }

    public function create()
    {
        $orderModel = new OrderModel();
        $data = [
            'date' => date('Y-m-d'),
            'supplier_id' => $this->request->getPost('supplier_id'),
            'items' => $this->request->getPost('items'),
            'status' => $this->request->getPost('status'),
        ];

        if ($orderModel->insert($data)) {
            return redirect()->to(base_url('orders'))->with('success', 'Order added successfully!');
        } else {
            return redirect()->to(base_url('orders'))->with('error', 'Failed to add order.');
        }
    }
}
