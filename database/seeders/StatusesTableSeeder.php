<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     *
     */
    public function run(): void
    {
        Status::factory(random_int(708, 923))->create();
    }
}
