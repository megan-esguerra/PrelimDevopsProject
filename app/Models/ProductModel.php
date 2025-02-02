<?php
namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $allowedFields = [
        'product_name', 'category_id', 'supplier_id', 'price', 'stock_quantity',
        'reorder_level', 'description', 'created_at', 'updated_at'
    ];
}
