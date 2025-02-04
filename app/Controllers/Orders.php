<?php

namespace App\Controllers;
use App\Models\OrderModel;
use App\Models\CustomerModel;
use App\Models\SupplierModel;

class Orders extends BaseController {
    public function index() {
        $orderModel = new OrderModel();
        $orders = $orderModel
            ->select('orders.*, customers.customer_name, suppliers.supplier_name')
            ->join('customers', 'customers.id = orders.customer_id')
            ->join('suppliers', 'suppliers.id = orders.supplier_id')
            ->findAll();

        return view('orders', ['orders' => $orders]);
    }

    public function newOrder() {
        return view('new_order');
    }
}
