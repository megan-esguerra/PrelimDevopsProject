<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['date', 'supplier_id', 'items', 'status'];

    public function getOrders()
    {
        return $this->select('orders.id, orders.date, suppliers.supplier_name, orders.items, orders.status')
            ->join('suppliers', 'suppliers.id = orders.supplier_id')
            ->findAll();
    }
}
