<?php

namespace App\Models;

use CodeIgniter\Model;

class StockModel extends Model
{
    protected $table = 'stocks'; // Your database table name
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'order_id', 
        'product', 
        'category', 
        'sales_channel', 
        'instruction', 
        'items', 
        'status'
    ];

    public function getInStockItems()
    {
        return $this->where('status', 'In Stock')->findAll(); // Fetch only in-stock items
    }
}
