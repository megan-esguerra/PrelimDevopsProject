<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesItemsModel extends Model
{
    protected $table = 'sales_items';
    protected $primaryKey = 'sale_item_id';
    protected $allowedFields = ['sale_id', 'product_id', 'quantity', 'unit_price', 'total_price'];
    protected $useTimestamps = true;
}
