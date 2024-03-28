<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::create([
            'contact_id' => 1, // ID dari contact yang telah dibuat sebelumnya
            'street' => 'Jalan Contoh No. 123',
            'city' => 'Jakarta',
            'province' => 'DKI Jakarta',
            'country' => 'Indonesia',
            'postal_code' => '12345',
        ]);
    }
}
