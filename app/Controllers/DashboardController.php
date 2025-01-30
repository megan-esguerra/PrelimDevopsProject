<?php

namespace App\Controllers;
use App\Models\RevenueModel;
use App\Models\SalesModel;
use App\Models\PurchaseOrdersModel;

class DashboardController extends BaseController
{
    public function index()
    {
       
        $revenueModel = new RevenueModel();
        $salesModel = new SalesModel();
        $salesItemsModel = new SalesItemsModel(); // Load SalesItemsModel to query sales items
        $purchaseModel = new PurchaseOrdersModel();

        // Fetch Revenue
        $totalRevenue = $revenueModel->selectSum('amount')->get()->getRow()->amount ?? 0;

        // Fetch Sales
        $totalSales = $salesModel->selectSum('total_amount')->get()->getRow()->total_amount ?? 0;

        // Count total number of sold products
        $soldProductsCount = $salesItemsModel->selectSum('quantity')->get()->getRow()->quantity ?? 0;

        // Fetch Purchases
        $totalPurchases = $purchaseModel->selectSum('total_amount')->get()->getRow()->total_amount ?? 0;

        // Calculate Income (Revenue - Purchases)
        $totalIncome = $totalRevenue - $totalPurchases;

        // Pass data to the view
        return view('Pages/Dashboard', [
            'revenue' => $totalRevenue,
            'sales' => $totalSales,
            'soldProductsCount' => $soldProductsCount, // Pass the sold products count
            'purchases' => $totalPurchases,
            'income' => $totalIncome
        ]);
        // $session = session();

        // // Check if the user is logged in and has the 'admin' role
        // if (!$session->has('role') || $session->get('role') !== 'admin') {
        //     return redirect()->to('/LogIn')->with('error', 'Access denied. Admins only.');
        // }
        
        // return view('Pages/Dashboard');
        
    }
}
