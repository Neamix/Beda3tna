<?php

namespace Database\Seeders;

use App\Models\System;
use Illuminate\Database\Seeder;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        System::updateOrCreate([
            'id' => 1,
            'key' => 'image.large',
            'value' => '1080X720'
        ]);

        System::updateOrCreate([
            'id' => 2,
            'key' => 'image.medium',
            'value' => '720X820'
        ]);

        System::updateOrCreate([
            'id' => 3,
            'key' => 'image.small',
            'value' => '380X150'
        ]);
    }
}
