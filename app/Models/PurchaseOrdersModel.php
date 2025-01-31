<?php
namespace App\Models;
use CodeIgniter\Model;

class PurchaseOrdersModel extends Model
{
    protected $table = 'purchase_orders';
    protected $primaryKey = 'order_id';
    protected $allowedFields = ['supplier_id', 'order_date', 'total_amount', 'status'];
}
