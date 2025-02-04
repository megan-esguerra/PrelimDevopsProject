<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductSalesModel extends Model
{
    protected $table      = 'product_sales';
    protected $primaryKey = 'id';
    protected $allowedFields = ['order_id', 'product_id', 'quantity', 'price'];

    public function getProductsByOrder($order_id)
    {
        return $this->select('product_sales.*, products.name AS product_name')
            ->join('products', 'products.id = product_sales.product_id', 'left')
            ->where('product_sales.order_id', $order_id)
            ->findAll();
    }
}
