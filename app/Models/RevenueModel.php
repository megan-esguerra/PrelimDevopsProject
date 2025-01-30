<?php
namespace App\Models;
use CodeIgniter\Model;

class RevenueModel extends Model
{
    protected $table = 'revenue';
    protected $primaryKey = 'revenue_id';
    protected $allowedFields = ['sale_id', 'amount', 'revenue_date'];
}
