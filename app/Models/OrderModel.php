<?php

namespace App\Models;
use CodeIgniter\Model;

class OrderModel extends Model {
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'date', 'customer_id', 'purchase_order_id', 'product_id', 'sales_channel', 'destination', 'items', 'status'
    ];

    public function getOrders() {
        return $this->select('orders.*, customers.customer_name AS customer, products.product_name AS product')
                    ->join('customers', 'customers.customer_id = orders.customer_id')
                    ->join('products', 'products.product_id = orders.product_id')
                    ->findAll();
    }
}
