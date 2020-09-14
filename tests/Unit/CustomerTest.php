<?php

namespace Tests\Unit;

use App\Models\ChatMessage;
use App\Models\Country;
use App\Models\CourierLocation;
use App\Models\Customer;
use App\Models\OrderStatus;
use App\Models\SystemPref;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateNewCustomer()
    {
        $response = $this->post('/api/customer/edit', [
            'id' => 1,
            'name' => 'Salvation Arinze',
            'email' => 'modernbabbage@gmai.com',
            'phone' => '07032741119',
            'address' => '53 Sadiku Street',
            'city' => 'Surulere',
            'state' => 'Lagos',
            'country_id' => 1,
        ]);

//        dd($response->getContent());

        $response->assertStatus(200)->assertJsonStructure([
            'status',
            'msg',
            'data' => [
                'customer',
            ]
        ]);
    }

    public function testDeleteCustomer()
    {
        factory(Customer::class)->create();
        $response = $this->delete('/api/customer/1');

//        dd($response->getContent());

        $response->assertStatus(200)->assertJson([
            'status'=>true
        ]);
    }

    public function testFetchCustomer()
    {
        factory(Customer::class)->create();

        $response = $this->get('/api/customer/1');

        $response->assertStatus(200)->assertJson([
            'status'=>true
        ]);
    }

    public function testFilterCustomer()
    {
        factory(Customer::class)->create();

        $response = $this->get('/api/customers/filter?id=1');

        $response->assertStatus(200)->assertJson([
            'status'=>true
        ]);
    }
}
