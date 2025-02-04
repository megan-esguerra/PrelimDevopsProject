<?php

namespace App\Models;

use CodeIgniter\Model;

class PurchaseOrdersModel extends Model
{
    protected $table      = 'purchase_orders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['supplier_id', 'date', 'status'];

    public function getPurchaseOrdersWithDetails()
    {
        return $this->select('purchase_orders.*, suppliers.name AS supplier_name')
            ->join('suppliers', 'suppliers.id = purchase_orders.supplier_id', 'left')
            ->findAll();
    }

    public function getProductsByPurchaseOrder($purchase_order_id)
    {
        return $this->select('purchase_order_items.*, products.name AS product_name, purchase_order_items.quantity')
            ->join('purchase_order_items', 'purchase_order_items.purchase_order_id = purchase_orders.id', 'left')
            ->join('products', 'products.id = purchase_order_items.product_id', 'left')
            ->where('purchase_order_items.purchase_order_id', $purchase_order_id)
            ->findAll();
    }
}

