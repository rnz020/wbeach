<?php

use Illuminate\Database\Seeder;
use App\Entities\Holding;

class HoldingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          factory(Holding::class, 25)->create();
    }
}
