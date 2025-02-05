<?php

namespace App\Controllers;

use App\Models\StockModel;
use CodeIgniter\Controller;

class StockController extends BaseController
{
    public function index()
    {
        $stockModel = new StockModel();
        $data['products'] = $stockModel->findAll(); // Fetch all stock items

        return view('Pages/instock', $data);
    }

    public function create()
    {
        return view('Pages/add_stock'); // Load the add stock form
    }

    public function store()
    {
        $stockModel = new StockModel();

        // Validate form input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'order_id'      => 'required',
            'product'       => 'required',
            'category'      => 'required',
            'sales_channel' => 'required',
            'instruction'   => 'permit_empty',
            'items'         => 'required|integer',
            'status'        => 'required|in_list[In Stock,Out of Stock]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Insert new stock
        $stockModel->insert([
            'order_id'      => $this->request->getPost('order_id'),
            'product'       => $this->request->getPost('product'),
            'category'      => $this->request->getPost('category'),
            'sales_channel' => $this->request->getPost('sales_channel'),
            'instruction'   => $this->request->getPost('instruction'),
            'items'         => $this->request->getPost('items'),
            'status'        => $this->request->getPost('status'),
        ]);

        return redirect()->to('/instock')->with('success', 'New stock added successfully.');
    }
}
