<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('reservations')->insert([
            'starttime' => '10:00',
            'endtime' => '11:00',
            'courts_id' => 2,
        ]);
        DB::table('reservations')->insert([
            'starttime' => '13:00',
            'endtime' => '14:00',
            'courts_id' => 4,
        ]);
        DB::table('reservations')->insert([
            'starttime' => '14:00',
            'endtime' => '15:00',
            'courts_id' => 4,
        ]);
    }
}
