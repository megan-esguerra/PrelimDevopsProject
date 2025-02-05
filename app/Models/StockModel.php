<?php

namespace App\Models;

use CodeIgniter\Model;

class StockModel extends Model
{
    protected $table = 'stock';
    protected $primaryKey = 'id';
    protected $allowedFields = ['order_id', 'product', 'category', 'sales_channel', 'instruction', 'items', 'status'];
}
