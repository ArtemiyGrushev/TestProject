<?php

namespace Tests\Feature;

use App\Jobs\ExportOrderToXml;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ExportOrderToXmlTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Используем фейковое хранилище для тестов
        Storage::fake('local');
    }

    /** @test */
    public function it_creates_xml_file_for_valid_order()
    {
        // Создаем тестовый заказ с товарами
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

        // Выполняем задачу
        $job = new ExportOrderToXml($order->id);
        $job->handle();

        // Проверяем, что файл был создан
        Storage::disk('local')->assertExists('exports/order_' . $order->id . '.xml');

        // Проверяем содержимое файла
        $xmlContent = Storage::disk('local')->get('exports/order_' . $order->id . '.xml');
        $this->assertStringContainsString('<order_number>ORDER123</order_number>', $xmlContent);
        $this->assertStringContainsString('<total_price>100.50</total_price>', $xmlContent);
        $this->assertStringContainsString('<name>Test Product</name>', $xmlContent);
        $this->assertStringContainsString('<price>50.25</price>', $xmlContent);
        $this->assertStringContainsString('<quantity>2</quantity>', $xmlContent);
    }

    /** @test */
    public function it_does_not_create_xml_file_for_invalid_order()
    {
        // Несуществующий ID заказа
        $invalidOrderId = 9999;

        // Выполняем задачу
        $job = new ExportOrderToXml($invalidOrderId);
        $job->handle();

        // Проверяем, что файл не был создан
        Storage::disk('local')->assertMissing('exports/order_' . $invalidOrderId . '.xml');
    }
}
