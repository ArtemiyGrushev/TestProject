<?php

namespace Tests\Feature;

use App\Jobs\ExportOrderToXml;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ExportOrderToXmlTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');
    }

    #[Test]
    public function it_creates_xml_file_for_valid_order()
    {

        $order = Order::factory()->create([
            'order_number' => 'ORDER123',
            'total_price' => 100.50,
        ]);

        OrderProduct::factory()->create([
            'order_id' => $order->id,
            'product_name' => 'Test Product',
            'price' => 50.25,
            'quantity' => 2,
        ]);

        $job = new ExportOrderToXml($order->id);
        $job->handle();

        Storage::disk('local')->assertExists('exports/order_' . $order->id . '.xml');

        $xmlContent = Storage::disk('local')->get('exports/order_' . $order->id . '.xml');

        $xml = simplexml_load_string($xmlContent);

        $this->assertEquals('ORDER123', (string)$xml->order_number);
        $this->assertEquals(number_format(100.50, 2), number_format((float)$xml->total_price, 2));

        $this->assertCount(1, $xml->products->product);
        $this->assertEquals('Test Product', (string)$xml->products->product->name);
        $this->assertEquals(number_format(50.25, 2), number_format((float)$xml->products->product->price, 2));
        $this->assertEquals('2', (string)$xml->products->product->quantity);
    }

    #[Test]
    public function it_does_not_create_xml_file_for_invalid_order()
    {
        $invalidOrderId = 9999;

        $job = new ExportOrderToXml($invalidOrderId);
        $job->handle();

        Storage::disk('local')->assertMissing('exports/order_' . $invalidOrderId . '.xml');
    }
}
