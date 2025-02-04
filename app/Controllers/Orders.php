<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\CustomerModel;
use App\Models\SupplierModel;
use CodeIgniter\Controller;

class Orders extends BaseController
{
    public function index()
    {
        $orderModel = new OrderModel();
        $customerModel = new CustomerModel();
        $supplierModel = new SupplierModel();

        // Fetch orders with customer and supplier names
        $orders = $orderModel
            ->select('orders.*, customers.customer_name, suppliers.supplier_name')
            ->join('customers', 'customers.customer_id = orders.customer_id')
            ->join('suppliers', 'suppliers.supplier_id = orders.supplier_id')
            ->findAll();

        // Fetch all customers and suppliers for the dropdowns
        $customers = $customerModel->findAll();
        $suppliers = $supplierModel->findAll();

        // Pass data to the view
        return view('Pages/orders', [
            'orders' => $orders,
            'customers' => $customers,
            'suppliers' => $suppliers,
        ]);
    }

    public function create()
{
    $orderModel = new \App\Models\OrderModel();

    $data = [
        'customer_id' => $this->request->getPost('customer_id'),
        'supplier_id' => $this->request->getPost('supplier_id'),
        'items'       => $this->request->getPost('items'),
        'status'      => $this->request->getPost('status'),
    ];

    if ($orderModel->insert($data)) {
        return redirect()->to(base_url('orders'))->with('success', 'Order created successfully!');
    } else {
        return redirect()->back()->with('error', 'Failed to create the order.');
    }
}

public function update_status()
{
    $orderModel = new \App\Models\OrderModel();

    $orderId = $this->request->getPost('order_id');
    $status = $this->request->getPost('status');

    if ($orderModel->update($orderId, ['status' => $status])) {
        return redirect()->to(base_url('orders'))->with('success', 'Order status updated successfully!');
    } else {
        return redirect()->back()->with('error', 'Failed to update order status.');
    }
}

}
