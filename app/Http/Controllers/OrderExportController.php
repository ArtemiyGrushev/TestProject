<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Jobs\ExportOrderToXml;
use Symfony\Component\Process\Process;


class OrderExportController extends Controller
{

    public function start(): void
    {
        $process = new Process(command: ['./vendor/bin/sail', 'artisan', 'queue:work']);
        $process->setTimeout(null);
        $process->start();
        $process->wait();
    }

    public function exportOrdersToXml()
    {
        $this->start();

        $orders = Order::all();

        foreach ($orders as $order) {
            dispatch(new ExportOrderToXml($order->id));
        }
        return 'Задачи отправлены в очередь!';
    }
}
