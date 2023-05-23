<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Carbon\Carbon;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=0; $i<=60; $i++){
            DB::table('note')->insert([
                'title' => Str::random(10),
                'description' => $this->randomText(),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }

    public function randomText(){
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {
            $paragraph = $faker->paragraph;
        }
        return $paragraph;
    }
}
