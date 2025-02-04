<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $allowedFields = ['customer_id', 'supplier_id', 'items', 'status', 'deleted_at'];
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;  // Enable soft deletes
    protected $deletedField = 'deleted_at';
}


