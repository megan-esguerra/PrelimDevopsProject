<?php

namespace App\Controllers;
use App\Models\OrderModel;
use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\PurchaseOrdersModel;
use CodeIgniter\Controller;

class Orders extends Controller {
    // Update routes
    public function index() {
        $orderModel = new OrderModel();
        $data['orders'] = $orderModel->getOrders();
        return view('Pages/orders', $data);
    }

    public function newOrder() {
        $customerModel = new CustomerModel();
        $productModel = new ProductModel();
        $purchaseOrderModel = new PurchaseOrdersModel();

        $data['customers'] = $customerModel->findAll();
        $data['products'] = $productModel->findAll();
        $data['purchase_orders'] = $purchaseOrderModel->findAll();

        return view('orders/create', $data);
    }

    public function store() {
        $orderModel = new OrderModel();
        $orderData = [
            'customer_id' => $this->request->getPost('customer_id'),
            'purchase_order_id' => $this->request->getPost('purchase_order_id'),
            'product_id' => $this->request->getPost('product_id'),
            'date' => $this->request->getPost('date'),
            'sales_channel' => $this->request->getPost('sales_channel'),
            'destination' => $this->request->getPost('destination'),
            'items' => $this->request->getPost('items'),
            'status' => $this->request->getPost('status')
        ];
        $orderModel->insert($orderData);
        return redirect()->to('/orders');
    }
}
