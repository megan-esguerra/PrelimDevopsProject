<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table = 'suppliers'; // Table name
    protected $primaryKey = 'supplier_id'; // Primary key

    protected $allowedFields = [
        'supplier_name',
        'contact_name',
        'phone',
        'email',
        'address'
    ];
    
    protected $useAutoIncrement = true; // Auto-increment for primary key
    protected $returnType = 'array'; // Return results as an array

    // If you have created_at & updated_at columns, enable timestamps
    protected $useTimestamps = false;
}
