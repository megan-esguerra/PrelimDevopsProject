<?php

namespace App\Controllers;
use App\Models\RevenueModel;
use App\Models\SalesModel;
use App\Models\PurchaseOrdersModel;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('Pages/Dashboard');
        $revenueModel = new RevenueModel();
        $salesModel = new SalesModel();
        $purchaseModel = new PurchaseOrdersModel();

        // Fetch Revenue
        $totalRevenue = $revenueModel->selectSum('amount')->get()->getRow()->amount;

        // Fetch Sales
        $totalSales = $salesModel->selectSum('total_amount')->get()->getRow()->total_amount;

        // Fetch Purchases
        $totalPurchases = $purchaseModel->selectSum('total_amount')->get()->getRow()->total_amount;

        // Calculate Income (Revenue - Purchases)
        $totalIncome = $totalRevenue - $totalPurchases;

        // Pass Data to View
        return view('Pages/Dashboard', [
            'revenue' => $totalRevenue,
            'sales' => $totalSales,
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
