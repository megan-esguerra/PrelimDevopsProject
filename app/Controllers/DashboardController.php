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

        // Fetch product data for Polar Area Chart
        $products = $productModel->select('product_name, price')->findAll();

        // Format data for Chart.js
        $productLabels = [];
        $productPrices = [];
        foreach ($products as $product) {
            $productLabels[] = $product['product_name'];
            $productPrices[] = $product['price'];
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
            'productPrices' => json_encode($productPrices) // Convert to JSON for Chart.js
        ]);
    }
}
