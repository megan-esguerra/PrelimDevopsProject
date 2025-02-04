<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\OrderModel;

class Orders extends BaseController
{
    protected $orderModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel(); // Instantiate the model
    }

    // Main page to list orders
    public function index()
    {
        $orders = $this->orderModel->getOrders(); // Replace with your actual query logic
        return view('Pages/orders', ['orders' => $orders]);
    }

    // Filter orders based on criteria
    public function filterOrders()
    {
        $filters = [
            'id' => $this->request->getGet('order_id'),
            'date' => $this->request->getGet('date'),
            'sales_channel' => $this->request->getGet('sales_channel'),
            'status' => $this->request->getGet('status'),
        ];

        $query = $this->orderModel;

        foreach ($filters as $key => $value) {
            if (!empty($value)) {
                $query = $query->like($key, $value);
            }
        }

        $data['orders'] = $query->findAll();
        return view('Pages/orders', $data);
    }

    // Import orders from an Excel file
    // public function importOrders()
    // {
    //     $file = $this->request->getFile('orders_file');
        
    //     if ($file->isValid() && !$file->hasMoved()) {
    //         $filePath = WRITEPATH . 'uploads/' . $file->getRandomName();
    //         $file->move(WRITEPATH . 'uploads', $filePath);

    //         $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($filePath);
    //         $sheet = $spreadsheet->getActiveSheet();
    //         $data = $sheet->toArray();

    //         // Skip the header row
    //         for ($i = 1; $i < count($data); $i++) {
    //             $this->orderModel->save([
    //                 'id' => $data[$i][0],
    //                 'date' => $data[$i][1],
    //                 'customer' => $data[$i][2],
    //                 'sales_channel' => $data[$i][3],
    //                 'destination' => $data[$i][4],
    //                 'items' => $data[$i][5],
    //                 'status' => $data[$i][6],
    //             ]);
    //         }

    //         return redirect()->to(base_url('orders'))->with('success', 'Orders imported successfully.');
    //     } else {
    //         return redirect()->to(base_url('orders'))->with('error', 'Failed to import orders.');
    //     }
    // }

    // // Export orders to an Excel file
    // public function exportOrders()
    // {
    //     $orders = $this->orderModel->findAll(); // Fetch all orders from the database

    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();
    //     $sheet->setTitle('Orders');

    //     // Set headers
    //     $sheet->setCellValue('A1', 'Order ID');
    //     $sheet->setCellValue('B1', 'Date');
    //     $sheet->setCellValue('C1', 'Customer');
    //     $sheet->setCellValue('D1', 'Sales Channel');
    //     $sheet->setCellValue('E1', 'Destination');
    //     $sheet->setCellValue('F1', 'Items');
    //     $sheet->setCellValue('G1', 'Status');

    //     // Fill data
    //     $row = 2;
    //     foreach ($orders as $order) {
    //         $sheet->setCellValue('A' . $row, $order['id']);
    //         $sheet->setCellValue('B' . $row, $order['date']);
    //         $sheet->setCellValue('C' . $row, $order['customer']);
    //         $sheet->setCellValue('D' . $row, $order['sales_channel']);
    //         $sheet->setCellValue('E' . $row, $order['destination']);
    //         $sheet->setCellValue('F' . $row, $order['items']);
    //         $sheet->setCellValue('G' . $row, $order['status']);
    //         $row++;
    //     }

    //     // Download Excel file
    //     $writer = new Xlsx($spreadsheet);
    //     $filename = 'Orders_' . date('Y-m-d_H-i-s') . '.xlsx';

    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment;filename="' . $filename . '"');
    //     header('Cache-Control: max-age=0');

    //     $writer->save('php://output');
    //     exit;
    // }

    // // Load the form for creating a new order
    // public function newOrder()
    // {
    //     return view('orders/new_order_form');
    // }
}
