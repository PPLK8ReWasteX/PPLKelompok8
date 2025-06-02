<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use PHPUnit\Framework\Attributes\Group;
use Tests\DuskTestCase;

class StoreTest extends DuskTestCase
{
    #[Group('storetest')]
    public function test_store_redeem_flow(): void
    {
        $this->browse(function (Browser $browser) {
            // 1. Go to the login page
            $browser->visit('http://127.0.0.1:8000/login')
                ->pause(500)
                // 2. Enter email
                ->click('#email')
                ->clear('#email')
                ->type('#email', 'client@example.com')
                ->assertInputValue('#email', 'client@example.com')
                // 3. Enter password
                ->click('#password')
                ->clear('#password')
                ->type('#password', 'password')
                ->assertInputValue('#password', 'password')
                // 4. Click Login button
                ->press('Login')
                // 5. Visit main page
                ->visit('http://127.0.0.1:8000')
                ->pause(1000)
                ->screenshot('after_login')
                // 6. Visit the store page
                ->visit('http://127.0.0.1:8000/store')
                ->pause(1000)
                // 7. Confirm the product is visible
                ->assertSee('Gantungan Kunci Anyaman Rotan')
                ->screenshot('store_page')
                // 8. Scroll dan klik tombol redeem, lalu screenshot
                ->scrollTo('#section_3 > div > div > div.col-lg-4.col-md-6.col-12.mb-4 > div > div > button')
                ->pause(500)
                ->click('#section_3 > div > div > div.col-lg-4.col-md-6.col-12.mb-4 > div > div > button')
                ->pause(500)
                ->screenshot('after_click_redeem');
        });
    }
}
