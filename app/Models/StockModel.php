<?php

namespace App\Models;

use CodeIgniter\Model;

class StockModel extends Model
{
    protected $table = 'stock';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'quantity', 'price', 'status'];

    // Fetch only in-stock items
    public function getInStockItems()
    {
        return $this->where('status', 'in_stock')->findAll();
    }
}
