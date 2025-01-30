<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Orders extends BaseController
{
    public function exportOrders()
{
    $orders = $this->orderModel->findAll(); // Fetch all orders from the database

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Orders');

    // Set headers
    $sheet->setCellValue('A1', 'Order ID');
    $sheet->setCellValue('B1', 'Date');
    $sheet->setCellValue('C1', 'Customer');
    $sheet->setCellValue('D1', 'Sales Channel');
    $sheet->setCellValue('E1', 'Destination');
    $sheet->setCellValue('F1', 'Items');
    $sheet->setCellValue('G1', 'Status');

    // Fill data
    $row = 2;
    foreach ($orders as $order) {
        $sheet->setCellValue('A' . $row, $order['id']);
        $sheet->setCellValue('B' . $row, $order['date']);
        $sheet->setCellValue('C' . $row, $order['customer']);
        $sheet->setCellValue('D' . $row, $order['sales_channel']);
        $sheet->setCellValue('E' . $row, $order['destination']);
        $sheet->setCellValue('F' . $row, $order['items']);
        $sheet->setCellValue('G' . $row, $order['status']);
        $row++;
    }

    // Download Excel file
    $writer = new Xlsx($spreadsheet);
    $filename = 'Orders_' . date('Y-m-d_H-i-s') . '.xlsx';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    exit;
}


    public function newOrder()
{
    return view('orders/new_order_form'); // Load the form for creating a new order
}

    public function index()
    {
        $data = [
            'orders' => [
                [
                    'id' => '#7676',
                    'date' => '06/30/2022',
                    'customer' => 'Ramesh Chaudhary',
                    'sales_channel' => 'Store name',
                    'destination' => 'Lalitpur',
                    'items' => 3,
                    'status' => 'Completed',
                ],
                [
                    'id' => '#7676',
                    'date' => '06/30/2022',
                    'customer' => 'Ramesh Chaudhary',
                    'sales_channel' => 'Store name',
                    'destination' => 'Lalitpur',
                    'items' => 3,
                    'status' => 'Pending',
                ],
                // Add more mock data here
            ],
        ];

        return view('orders', $data);
    }
}
