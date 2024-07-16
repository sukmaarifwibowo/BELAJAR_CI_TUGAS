<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\TransactionModel;

class Home extends BaseController
{
    protected $product;
    protected $table = 'transactions';
    protected $allowedFields = ['product', 'status'];

    function __construct()
    {
        helper('form');
        helper('number');
        $this->product = new ProductModel();
    }

    public function index(): string
    {
        $product = $this->product->findAll();
        $data['product'] = $product;

        return view('v_home', $data);
    }

    public function transaksi()
    {
        $model = new TransactionModel();
        $data['v_transaksi'] = $model->findAll();
            return view('v_transaksi');
        }

    public function faq()
    {
        return view('v_faq');
    }

    public function updateStatus($id)
    {
        $model = new TransactionModel();
        $transaction = $model->find($id);

        if ($transaction) {
            $transaction['status'] = $transaction['status'] ? 0 : 1;
            $model->update($id, $transaction);
        }

        return redirect()->to('v_transaksi');
    }

    public function contact()
    {
        return view('v_contact');
    }
}
