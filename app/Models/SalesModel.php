<?php
namespace App\Models;
use CodeIgniter\Model;

class SalesModel extends Model
{
    protected $table = 'sales';
    protected $primaryKey = 'sale_id';
    protected $allowedFields = ['sale_date', 'total_amount'];
}
