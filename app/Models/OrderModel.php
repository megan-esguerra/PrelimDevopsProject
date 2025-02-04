<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders'; // Your database table name
    protected $primaryKey = 'id'; // Primary key of the table

    // Fields allowed for mass assignment
    protected $allowedFields = ['id', 'date', 'customer', 'sales_channel',  'items', 'status'];

    // Fetch all orders or apply filters
    public function getOrders($filters = [])
    {
        $query = $this;

        if (!empty($filters['order_id'])) {
            $query = $query->like('id', $filters['order_id']);
        }
        if (!empty($filters['date'])) {
            $query = $query->where('date', $filters['date']);
        }
        if (!empty($filters['sales_channel'])) {
            $query = $query->where('sales_channel', $filters['sales_channel']);
        }
        if (!empty($filters['status'])) {
            $query = $query->where('status', $filters['status']);
        }

        return $query->findAll(); // Fetch and return results
    }

    // Bulk import orders (if needed for advanced processing)
    public function importOrders(array $data)
    {
        foreach ($data as $row) {
            $this->save($row); // Save each row to the database
        }
        return true;
    }
}
