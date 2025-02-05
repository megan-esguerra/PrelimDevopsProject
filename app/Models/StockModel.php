<?php

namespace App\Models;

use CodeIgniter\Model;

class StockModel extends Model
{
    protected $table = 'stocks';
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
        return $this->select('order_id, product, category, sales_channel, instruction, items, status')
                    ->where('status', 'In Stock')
                    ->findAll();
    }
}
