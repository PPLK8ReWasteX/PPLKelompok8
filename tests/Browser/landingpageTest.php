<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class landingpageTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @group landingpagetest
     */
    public function testExample(): void
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
                // Assert dan screenshot setiap section utama landing page
                ->assertSee('🌱 ReWasteX')
                ->assertSee('Solusi Digital untuk Kota yang Lebih Bersih')
                ->screenshot('landing_rewastex')
                ->assertSee('Tentang ReWasteX')
                ->screenshot('landing_tentang')
                ->assertSee('Misi Kami')
                ->screenshot('landing_misi')
                ->assertSee('Kenali Tim Kami')
                ->screenshot('landing_tim')
                ->assertSee('Pertanyaan yang Sering Diajukan')
                ->screenshot('landing_faq')
                // Perbaiki teks menjadi "Contact Information" atau "Contact Infomation" sesuai yang ada di halaman
                ->assertSee('Contact Infomation')
                ->screenshot('landing_contact');
        });
    }
}
