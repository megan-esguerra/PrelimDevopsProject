<?php

namespace App\Controllers;

use App\Models\RevenueModel;
use App\Models\SalesModel;
use App\Models\SalesItemsModel;
use App\Models\PurchaseOrdersModel;
use App\Models\ProductModel; // Added ProductModel

class DashboardController extends BaseController
{
    public function index()
    {
        $revenueModel = new RevenueModel();
        $salesModel = new SalesModel();
        $salesItemsModel = new SalesItemsModel();
        $purchaseModel = new PurchaseOrdersModel();
        $productModel = new ProductModel(); // Load ProductModel

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

        // Fetch top 4 products with the **lowest stock quantity**
        $lowStockProducts = $productModel->select('product_name, stock_quantity')
            ->orderBy('stock_quantity', 'ASC') // ASC for lowest first
            ->limit(4)
            ->get()
            ->getResultArray();

        // Format data for Chart.js
        $productLabels = [];
        $productStocks = [];
        foreach ($lowStockProducts as $product) {
            $productLabels[] = $product['product_name'];
            $productStocks[] = $product['stock_quantity'];
        }

        return view('Pages/Dashboard', [
            'revenue' => $totalRevenue,
            'sales' => $totalSales,
            'soldProductsCount' => $soldProductsCount,
            'purchases' => $totalPurchases,
            'income' => $totalIncome,
            'monthlyRevenue' => $monthlyRevenue,
            'monthlySales' => $monthlySales,
            'productLabels' => json_encode($productLabels), // Convert to JSON for Chart.js
            'productStocks' => json_encode($productStocks) // Convert to JSON for Chart.js
        ]);
    }
}
