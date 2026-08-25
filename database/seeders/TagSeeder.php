<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['name' => 'Adventure', 'slug' => 'adventure'],
            ['name' => 'Beach', 'slug' => 'beach'],
            ['name' => 'Mountain', 'slug' => 'mountain'],
            ['name' => 'City', 'slug' => 'city'],
            ['name' => 'Culture', 'slug' => 'culture'],
            ['name' => 'Food', 'slug' => 'food'],
            ['name' => 'Nature', 'slug' => 'nature'],
            ['name' => 'Photography', 'slug' => 'photography'],
            ['name' => 'Budget', 'slug' => 'budget'],
            ['name' => 'Luxury', 'slug' => 'luxury'],
            ['name' => 'Family', 'slug' => 'family'],
            ['name' => 'Solo Travel', 'slug' => 'solo-travel'],
            ['name' => 'Backpacking', 'slug' => 'backpacking'],
            ['name' => 'Cruise', 'slug' => 'cruise'],
            ['name' => 'Hiking', 'slug' => 'hiking'],
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate(['slug' => $tag['slug']], $tag);
        }
    }
}
