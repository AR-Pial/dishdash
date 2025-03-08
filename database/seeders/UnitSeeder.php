<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $units = [
            'plate',
            'bowl',
            'cup',
            'slice',
            'piece',
            'liter',
            'kg',
        ];

        foreach ($units as $unit) {
            DB::table('units')->updateOrInsert(
                ['name' => $unit],
                [
                    'description' => '',
                    'created_at' => Carbon::now(), 
                ]
            );
        }
    }
}
