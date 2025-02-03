<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders'; // Your database table name
    protected $primaryKey = 'id'; // Primary key of the table

    // Fields allowed for mass assignment
    protected $allowedFields = ['date', 'customer', 'sales_channel', 'destination', 'items', 'status'];

    // Enable timestamps if your table has `created_at` and `updated_at` fields
    protected $useTimestamps = false; // Set to true if you have timestamp fields

    // Validation rules for inserting/updating data
    protected $validationRules = [
        'date' => 'required|valid_date',
        'customer' => 'required|max_length[255]',
        'sales_channel' => 'required|max_length[255]',
        'destination' => 'required|max_length[255]',
        'items' => 'required|integer',
        'status' => 'required|in_list[Pending,Completed,Cancelled]',
    ];

    // Validation messages (optional)
    protected $validationMessages = [
        'date' => [
            'required' => 'The date field is required.',
            'valid_date' => 'The date must be a valid date.',
        ],
        'customer' => [
            'required' => 'The customer field is required.',
            'max_length' => 'The customer field cannot exceed 255 characters.',
        ],
        'status' => [
            'in_list' => 'The status must be one of: Pending, Completed, Cancelled.',
        ],
    ];

    // Fetch all orders or apply filters
    public function getOrders($filters = [])
    {
        $builder = $this->builder();

        // Apply filters if provided
        if (!empty($filters['order_id'])) {
            $builder->where('id', $filters['order_id']);
        }
        if (!empty($filters['date'])) {
            $builder->where('date', $filters['date']);
        }
        if (!empty($filters['sales_channel'])) {
            $builder->where('sales_channel', $filters['sales_channel']);
        }
        if (!empty($filters['status'])) {
            $builder->where('status', $filters['status']);
        }

        return $builder->get()->getResultArray(); // Fetch and return results as an array
    }

    // Bulk import orders (if needed for advanced processing)
    public function importOrders(array $data)
    {
        // Use the insertBatch method for better performance
        return $this->insertBatch($data);
    }
}