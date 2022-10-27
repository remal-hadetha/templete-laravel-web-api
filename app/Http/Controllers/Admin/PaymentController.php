<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $model;
    private $page;
    private $url;
    private $data;
    private $route;
    private $user;
    private $product;
    public function __construct(Payment $payment )
    {
        $this->model = $payment;
        $this->page  = 'dashboard.cruds.payments.';
        $this->url   = '/payments';
        $this->route = 'payments.index';
        $this->data  = [];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = $this->model->get();
        return view($this->page.'index',compact('data'));

    }

    public function show($id)
    {
        $data = $this->model->find($id);
        return view($this->page.'ajax.show',compact('data'));
    }

    public function destroy($id)
    {
        $payment = $this->model->find($id);
        $payment->delete($id);
        return redirect()->route($this->route)->withMessage(['type'=>'success','content'=>'تم الحذف بنجاح']);
    }
}
