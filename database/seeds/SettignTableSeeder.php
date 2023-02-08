<?php

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettignTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'url' => 'http://127.0.0.1:8000/dashboard',
            'company_name' => 'Team Work',
            'system_title' => 'Team Work',
            'login_page_title' => 'Team Work',
            'copyrights' => 'Copyright © 2023  Developed by Team 10',
            'favicon' => 'uploads/logos/favicon.ico',
            'logo' => 'uploads/logos/logo.png',
            'login_logo' => 'uploads/logos/logo.png'
        ]);
    }
}
