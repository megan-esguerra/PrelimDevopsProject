<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\CustomerModel;
use App\Models\SupplierModel;
use CodeIgniter\Controller;

class Orders extends BaseController
{
    protected $orderModel;
    protected $customerModel;
    protected $supplierModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->customerModel = new CustomerModel();
        $this->supplierModel = new SupplierModel();
    }

    public function index()
    {
        // Number of rows per page
        $rowsPerPage = 10;
    
        // Get the current page from the request, default to 1
        $currentPage = $this->request->getVar('page') ?? 1;
    
        // Calculate the offset for the query
        $offset = ($currentPage - 1) * $rowsPerPage;
    
        // Fetch total count of active (non-archived) orders
        $totalOrders = $this->orderModel
            ->where('orders.deleted_at', null)
            ->countAllResults();
    
        // Calculate total pages
        $totalPages = ceil($totalOrders / $rowsPerPage);
    
        // Fetch paginated orders with customer and supplier names
        $orders = $this->orderModel
            ->select('orders.*, customers.customer_name, suppliers.supplier_name')
            ->join('customers', 'customers.customer_id = orders.customer_id')
            ->join('suppliers', 'suppliers.supplier_id = orders.supplier_id')
            ->where('orders.deleted_at', null)
            ->limit($rowsPerPage, $offset)
            ->findAll();
    
        // Fetch customers and suppliers for dropdowns
        $customers = $this->customerModel->findAll();
        $suppliers = $this->supplierModel->findAll();
    
        // Pass data to the view
        return view('Pages/orders', [
            'orders' => $orders,
            'customers' => $customers,
            'suppliers' => $suppliers,
            'page' => $currentPage,
            'totalPages' => $totalPages,
        ]);
    }
    

    public function create()
    {
        $data = [
            'customer_id' => $this->request->getPost('customer_id'),
            'supplier_id' => $this->request->getPost('supplier_id'),
            'items'       => $this->request->getPost('items'),
            'status'      => $this->request->getPost('status'),
        ];

        if ($this->orderModel->insert($data)) {
            return redirect()->to(base_url('orders'))->with('success', 'Order created successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to create the order.');
        }
    }

    public function update()
    {
        $orderId = $this->request->getPost('order_id');

        $data = [
            'customer_id' => $this->request->getPost('customer_id'),
            'supplier_id' => $this->request->getPost('supplier_id'),
            'items'       => $this->request->getPost('items'),
            'status'      => $this->request->getPost('status'),
        ];

        if ($this->orderModel->update($orderId, $data)) {
            return redirect()->to(base_url('orders'))->with('success', 'Order updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to update order.');
        }
    }

    public function update_status()
{
    $orderId = $this->request->getPost('order_id');
    $status = $this->request->getPost('status');

    if ($this->orderModel->update($orderId, ['status' => $status])) {
        return redirect()->to('/orders')->with('success', 'Order status updated successfully.');
    } else {
        return redirect()->back()->with('error', 'Failed to update order status.');
    }
}


    public function get_archived()
{
    $orders = $this->orderModel->onlyDeleted()
        ->select('orders.*, customers.customer_name, suppliers.supplier_name')
        ->join('customers', 'customers.customer_id = orders.customer_id')
        ->join('suppliers', 'suppliers.supplier_id = orders.supplier_id')
        ->findAll();

    return $this->response->setJSON($orders);
}
public function getArchivedOrders()
{
    $ordersModel = new OrderModel();

    // Fetch only soft-deleted orders
    $archivedOrders = $ordersModel->onlyDeleted()->findAll();

    return $this->response->setJSON($archivedOrders);
}


public function deleteOrder()
{
    $orderId = $this->request->getPost('order_id');

    if ($this->orderModel->update($orderId, ['deleted_at' => date('Y-m-d H:i:s')])) {
        return redirect()->to('/orders')->with('success', 'Order archived successfully.');
    } else {
        return redirect()->to('/orders')->with('error', 'Failed to archive order.');
    }
}


public function restoreOrder()
{
    $orderId = $this->request->getPost('order_id');

    if ($this->orderModel->update($orderId, ['deleted_at' => null])) {
        return redirect()->to('/orders')->with('success', 'Order restored successfully.');
    } else {
        return redirect()->to('/orders')->with('error', 'Failed to restore order.');
    }
}

}
