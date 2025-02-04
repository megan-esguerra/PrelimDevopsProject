<?php

namespace App\Models;
use CodeIgniter\Model;

class CustomerModel extends Model {
    protected $table = 'customers'; 
    protected $primaryKey = 'customer_id';
    protected $allowedFields = ['customer_name', 'phone', 'email', 'address'];

    public function getCustomers($id = null) {
        if ($id === null) {
            return $this->findAll();
        }
        return $this->where(['customer_id' => $id])->first();
    }
}
