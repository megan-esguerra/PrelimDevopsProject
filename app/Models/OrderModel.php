<?php

namespace App\Models;
use CodeIgniter\Model;

class OrderModel extends Model {
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['date', 'customer_id', 'supplier_id', 'items', 'status'];
}
