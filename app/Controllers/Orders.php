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
}
