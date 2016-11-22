<?php

use Illuminate\Database\Seeder;

class HoldingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          factory(App\Holding::class, 25)->create();
    }
}
