<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table      = 'customers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'phone', 'address'];

    /**
     * Get all customers
     */
    public function getAllCustomers()
    {
        return $this->orderBy('name', 'ASC')->findAll();
    }

    /**
     * Get a single customer by ID
     */
    public function getCustomerById($id)
    {
        return $this->where('id', $id)->first();
    }

    /**
     * Search for customers by name, email, or phone
     */
    public function searchCustomers($keyword)
    {
        return $this->like('name', $keyword)
            ->orLike('email', $keyword)
            ->orLike('phone', $keyword)
            ->findAll();
    }
}
