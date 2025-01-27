<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Jobs\ExportOrderToXml;


class OrderExportController extends Controller
{
    public function exportOrdersToXml()
    {
        $orders = Order::all();

        foreach ($orders as $order) {
            dispatch(new ExportOrderToXml($order->id));
        }
        return 'Задачи отправлены в очередь!';
    }
}
