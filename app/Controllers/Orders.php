<?php

namespace App\Controllers;
use App\Models\OrderModel;
use App\Models\CustomerModel;
use App\Models\SupplierModel;
use CodeIgniter\Controller;

class Orders extends BaseController {
    public function index() {
        $orderModel = new OrderModel();
        $orders = $orderModel
            ->select('orders.*, customers.customer_name, suppliers.supplier_name')
            ->join('customers', 'customers.customer_id = orders.customer_id')
            ->join('suppliers', 'suppliers.supplier_id = orders.supplier_id')
            ->findAll();

        return view('Pages/orders', ['orders' => $orders]);
    }

    public function newOrder() {
        $customerModel = new CustomerModel();
        $supplierModel = new SupplierModel();

        $data['customers'] = $customerModel->findAll();
        $data['suppliers'] = $supplierModel->findAll();

        return view('Pages/new_order', $data);
    }

    public function create() {
        $orderModel = new OrderModel();
        
        $data = [
            'customer_id' => $this->request->getPost('customer_id'),
            'supplier_id' => $this->request->getPost('supplier_id'),
            'items' => $this->request->getPost('items'),
            'status' => $this->request->getPost('status'),
            'date' => date('Y-m-d')
        ];

        $orderModel->insert($data);

        return redirect()->to('/orders')->with('success', 'Order created successfully');
    }
}
