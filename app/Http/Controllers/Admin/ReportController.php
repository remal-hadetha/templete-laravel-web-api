<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Order;
class ReportController extends Controller
{
    public function index()
    {

        for ($i = 0; $i < 7; $i++) {
            //$day[] = Carbon::now()->subDays($i)->format('D');
            $this->data['label'.($i+1)] = Carbon::now()->subDays($i)->format('D');
            $this->data['incoming_day'.($i+1)] = Order::whereDate("created_at",Carbon::now()->subDays($i)->format('Y-m-d'))->count();
            $this->data['outcoming_day'.($i+1)] = Order::whereDate("created_at",Carbon::now()->subDays($i+7)->format('Y-m-d'))->count();
        }


        return view('dashboard.cruds.reports.index',$this->data);
    }
}
