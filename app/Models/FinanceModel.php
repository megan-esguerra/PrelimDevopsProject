<?php

namespace App\Models;
use CodeIgniter\Model;

class FinanceModel extends Model
{
    protected $table = 'finance'; // Change this to your actual table name

    public function getMonthlyRevenueSales()
    {
        return $this->db->table($this->table)
            ->select("MONTHNAME(created_at) as month, SUM(revenue) as revenue, SUM(sales) as sales")
            ->groupBy('month')
            ->orderBy('MONTH(created_at)')
            ->get()
            ->getResultArray();
    }
}
