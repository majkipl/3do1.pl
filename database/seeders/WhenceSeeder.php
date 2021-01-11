<?php

namespace Database\Seeders;

use App\Models\Whence;
use Illuminate\Database\Seeder;

class WhenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        $data[] = ['name' => 'reklama internetowa'];
        $data[] = ['name' => 'materiały promocyjne w punkcie sprzedaży'];
        $data[] = ['name' => 'reklama w prasie'];
        $data[] = ['name' => 'od znajomej/znajomego'];
        $data[] = ['name' => 'reklama radiowa'];
        $data[] = ['name' => 'materiały Footgol TV'];

        Whence::insert($data);
    }
}
