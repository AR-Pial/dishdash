<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OriginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $origins = [
            'Bengali',
            'Indian',
            'Italian',
            'Mexican',
        ];

        foreach ($origins as $origin) {
            DB::table('origins')->updateOrInsert(
                ['name' => $origin],
                [
                    'description' => '',
                    'created_at' => Carbon::now(), 
                ]
            );
        }
    }
}
