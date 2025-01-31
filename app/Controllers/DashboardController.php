<?php

namespace App\Controllers;
use App\Models\RevenueModel;
use App\Models\SalesModel;
use App\Models\SalesItemsModel;
use App\Models\PurchaseOrdersModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $revenueModel = new RevenueModel();
        $salesModel = new SalesModel();
        $salesItemsModel = new SalesItemsModel();
        $purchaseModel = new PurchaseOrdersModel();

        // Fetch total revenue
        $totalRevenue = $revenueModel->selectSum('amount')->get()->getRow()->amount ?? 0;

        // Fetch total sales
        $totalSales = $salesModel->selectSum('total_amount')->get()->getRow()->total_amount ?? 0;

        // Count total sold products
        $soldProductsCount = $salesItemsModel->selectSum('quantity')->get()->getRow()->quantity ?? 0;

        // Fetch total purchases
        $totalPurchases = $purchaseModel->selectSum('total_amount')->get()->getRow()->total_amount ?? 0;

        // Calculate total income
        $totalIncome = $totalRevenue - $totalPurchases;

        // Fetch monthly revenue
     // Fetch monthly revenue using revenue_date
            $monthlyRevenue = $revenueModel->select("MONTHNAME(revenue_date) as month, SUM(amount) as revenue")
            ->groupBy('month')
            ->orderBy('MONTH(revenue_date)')
            ->get()
            ->getResultArray();

            // Fetch monthly sales using sale_date
            $monthlySales = $salesModel->select("MONTHNAME(sale_date) as month, SUM(total_amount) as sales")
            ->groupBy('month')
            ->orderBy('MONTH(sale_date)')
            ->get()
            ->getResultArray();


        return view('Pages/Dashboard', [
            'revenue' => $totalRevenue,
            'sales' => $totalSales,
            'soldProductsCount' => $soldProductsCount,
            'purchases' => $totalPurchases,
            'income' => $totalIncome,
            'monthlyRevenue' => $monthlyRevenue, // Pass monthly revenue data
            'monthlySales' => $monthlySales // Pass monthly sales data
        ]);
    }
}
