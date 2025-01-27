<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use SimpleXMLElement;

class ExportOrderToXml implements ShouldQueue
{
    protected $orderId;

    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    public function handle()
    {
        $order = Order::with('products')->find($this->orderId);

        if ($order) {
            $xml = new SimpleXMLElement('<order></order>');
            $xml->addChild('order_number', $order->order_number);
            $xml->addChild('total_price', $order->total_price);

            $products = $xml->addChild('products');
            foreach ($order->products as $product) {
                $productNode = $products->addChild('product');
                $productNode->addChild('name', $product->product_name);
                $productNode->addChild('price', $product->price);
                $productNode->addChild('quantity', $product->quantity);
            }

            Storage::put('exports/order_' . $order->id . '.xml', $xml->asXML());
        }
    }
}
