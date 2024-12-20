<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Book;
class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach(range(1, 10) as $index){
            Book::create([
                'name' => $faker->title(),
                'author' => $faker->name(),
                'category' => $faker->word(),
                'year' => $faker->year(),
                'quantity' => $faker->randomDigit()
            ]);
        }
    }
}
