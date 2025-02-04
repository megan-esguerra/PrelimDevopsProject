<?php

namespace App\Models;

use CodeIgniter\Model;

class InStockModel extends Model
{
    protected $table = 'in_stock';
    protected $primaryKey = 'id';
    protected $allowedFields = ['order_id', 'product', 'category', 'sales_channel', 'instruction', 'items', 'status'];

    public function getAllStock()
    {
        return $this->findAll();
    }
}
