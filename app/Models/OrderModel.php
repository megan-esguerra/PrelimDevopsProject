<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'orders'; // Your database table name
    protected $primaryKey = 'id'; // Primary key of the table

    // Fields allowed for mass assignment
    protected $allowedFields = ['id', 'date', 'customer', 'sales_channel', 'destination', 'items', 'status'];

    // Fetch all orders or apply filters
    public function getOrders()
{
    return $this->select('orders.*, customers.name as customer, sales.channel as sales_channel')
                ->join('customers', 'customers.id = orders.customer_id')
                ->join('sales', 'sales.order_id = orders.id', 'left') // Adjust based on DB structure
                ->orderBy('orders.id', 'DESC')
                ->findAll();
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

