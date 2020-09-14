<?php

namespace Tests;

use App\Models\ChatMessage;
use App\Models\Country;
use App\Models\Currency;
use App\Models\SystemPref;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp(); //
        $this->withoutExceptionHandling();
        Mail::fake();
        factory(Country::class)->create();
        factory(Currency::class)->create();

        Sanctum::actingAs(
            factory(User::class)->create()
        );
    }
}
