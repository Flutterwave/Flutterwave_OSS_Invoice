<?php

namespace Tests\Unit;

use App\Models\ChatMessage;
use App\Models\CourierLocation;
use App\Models\Invoice;
use App\Models\OrderStatus;
use App\Models\SystemPref;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateNewInvoice()
    {
        $response = $this->post('/api/invoice/edit', [
            'to_email' => 'arinze@anomalyng.com',
            'due_date' => '15-09-2020',
            'currency' => 'NGN',
            'cc_emails' => '',
            'acc_name' => 'Arinze',
            'bank' => 'GTB',
            'acc_num' => '101',
            'notes' => 'Thanks',
            'shipping_fee' => 0,
            'discount' => 0,
            'tax' => 0,
            'items' => [
                [
                    'title' => 'Apple',
                    'quantity' => 1,
                    'unit_price' => 200
                ]
            ],
            '_send' => false
        ]);

//        dd($response->getContent());

        $response->assertStatus(200)->assertJsonStructure([
            'status',
            'msg',
            'data' => [
                'invoice',
            ]
        ]);
    }

    public function testDeleteCustomer()
    {
        factory(Invoice::class)->create();

        $response = $this->delete('/api/invoice/1');

//        dd($response->getContent());

        $response->assertStatus(200)->assertJson([
            'status' => true
        ]);
    }

    public function testFetchInvoice()
    {
        factory(Invoice::class)->create();

        $response = $this->get('/api/invoice/1');

        $response->assertStatus(200)->assertJson([
            'status' => true
        ]);
    }

    public function testFilterInvoices()
    {
        factory(Invoice::class)->create();

        $response = $this->get('/api/invoices/filter?id=1');

        $response->assertStatus(200)->assertJson([
            'status' => true
        ]);
    }
}
