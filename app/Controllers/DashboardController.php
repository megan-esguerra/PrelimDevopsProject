<?php

namespace App\Controllers;

use App\Models\RevenueModel;
use App\Models\SalesModel;
use App\Models\SalesItemsModel;
use App\Models\PurchaseOrdersModel;
use App\Models\ProductModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $revenueModel = new RevenueModel();
        $salesModel = new SalesModel();
        $salesItemsModel = new SalesItemsModel();
        $purchaseModel = new PurchaseOrdersModel();
        $productModel = new ProductModel();

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

        // 🔹 Get the **lowest 4 products** based on stock quantity
        $products = $productModel->select('product_name, stock_quantity')
            ->orderBy('stock_quantity', 'ASC') // Sort by lowest stock
            ->limit(4) // Get only 4 items
            ->find();

        // Format data for Chart.js
        $productLabels = [];
        $productStocks = [];
        foreach ($products as $product) {
            $productLabels[] = $product['product_name'];
            $productStocks[] = $product['stock_quantity'];
        }

        return view('Pages/Dashboard', [
            'revenue' => $totalRevenue,
            'sales' => $totalSales,
            'soldProductsCount' => $soldProductsCount,
            'purchases' => $totalPurchases,
            'income' => $totalIncome,
            'monthlyRevenue' => json_encode($monthlyRevenue),
            'monthlySales' => json_encode($monthlySales),
            'productLabels' => json_encode($productLabels), // Convert to JSON
            'productStocks' => json_encode($productStocks) // Convert to JSON
        ]);
    }
}
