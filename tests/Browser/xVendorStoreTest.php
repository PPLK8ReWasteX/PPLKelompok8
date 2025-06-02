<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class xVendorStoreTest extends DuskTestCase
{
    /**
     * @group xxvendorstoretest
     */
    public function test_store_redeem_flow(): void
    {
        $this->browse(function (Browser $browser) {
            // 1. Go to the login page
            $browser->visit('http://127.0.0.1:8000/login')
                ->pause(500)
                // 2. Enter email
                ->click('#email')
                ->clear('#email')
                ->type('#email', 'vendor@example.com')
                ->assertInputValue('#email', 'vendor@example.com')
                // 3. Enter password
                ->click('#password')
                ->clear('#password')
                ->type('#password', 'password')
                ->assertInputValue('#password', 'password')
                // 4. Click Login button
                ->press('Login')
                // 5. Kunjungi halaman manajemen produk vendor
                ->visit('http://127.0.0.1:8000/vendor/store')
                ->pause(1500)
                ->screenshot('Product_Created');
        });
    }
}


