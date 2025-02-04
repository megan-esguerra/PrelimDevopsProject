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
        $offset = ($currentPage - 1) * $rowsPerPage;
    
        // Get search and filter inputs
        $search = $this->request->getVar('search');
        $statusFilter = $this->request->getVar('status');
    
        // Start building the query
        $orderQuery = $this->orderModel
            ->select('orders.*, customers.customer_name, suppliers.supplier_name')
            ->join('customers', 'customers.customer_id = orders.customer_id')
            ->join('suppliers', 'suppliers.supplier_id = orders.supplier_id')
            ->where('orders.deleted_at', null);
    
        // Apply search filter
        if (!empty($search)) {
            $orderQuery->groupStart()
                ->like('orders.id', $search)
                ->orLike('customers.customer_name', $search)
                ->orLike('suppliers.supplier_name', $search)
            ->groupEnd();
        }
    
        // Apply status filter
        if (!empty($statusFilter)) {
            $orderQuery->where('orders.status', $statusFilter);
        }
    
        // Get total orders count after applying filters
        $totalOrders = $orderQuery->countAllResults(false);
    
        // Fetch paginated orders
        $orders = $orderQuery
            ->limit($rowsPerPage, $offset)
            ->findAll();
    
        // Calculate total pages
        $totalPages = ceil($totalOrders / $rowsPerPage);
    
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
            'search' => $search,
            'statusFilter' => $statusFilter
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

    try {
        // Fetch only soft-deleted (archived) orders
        $archivedOrders = $ordersModel->onlyDeleted()->findAll();

        if (empty($archivedOrders)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'No archived orders found.',
                'data' => []
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'data' => $archivedOrders
        ]);
    } catch (\Exception $e) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to fetch archived orders: ' . $e->getMessage()
        ]);
    }
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
