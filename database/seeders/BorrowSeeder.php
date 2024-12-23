<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Borrow;

class BorrowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach(range(1, 10) as $index){
            Borrow::create([
                'reader_id' => $faker->randomDigitNotNull(),
                'book_id' => $faker->randomDigitNotNull(),
                'borrow_date' => $faker->dateTimeBetween('y-m-d'),
                'return_date' => $faker->date('y-m-d'),
            ]);
        }
    }
}
