<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Travel;
use App\Models\TravelImage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seed tags first
        $this->call(TagSeeder::class);

        // Create sample users
        $user1 = User::firstOrCreate(
            ['email' => 'traveler1@example.com'],
            [
                'name' => 'Sarah Johnson',
                'password' => Hash::make('password'),
            ]
        );

        $user2 = User::firstOrCreate(
            ['email' => 'traveler2@example.com'],
            [
                'name' => 'Mike Chen',
                'password' => Hash::make('password'),
            ]
        );

        $user3 = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Demo User',
                'password' => Hash::make('password'),
            ]
        );

        // Sample travel data
        $travels = [
            [
                'user_id' => $user1->id,
                'title' => 'The Magic of Paris: City of Lights',
                'description' => 'Spent an amazing week exploring the capital of France. From the iconic Eiffel Tower to charming cafes in Montmartre, every corner has a story. The museums, the food, the architecture - Paris truly lives up to its reputation as the city of love and beauty.',
                'location' => 'Paris, France',
                'travel_date' => now()->subMonths(2),
                'tags' => [1, 4, 6, 8],
            ],
            [
                'user_id' => $user2->id,
                'title' => 'Trekking in the Swiss Alps',
                'description' => 'An unforgettable hiking adventure through the Swiss Alps. Crystal clear mountain air, breathtaking views, and challenging trails. Met incredible people from around the world on this journey. Definitely recommending this to all adventure seekers!',
                'location' => 'Swiss Alps, Switzerland',
                'travel_date' => now()->subMonths(1),
                'tags' => [2, 3, 15, 13],
            ],
            [
                'user_id' => $user1->id,
                'title' => 'Tropical Paradise in Bali',
                'description' => 'Discovered hidden beaches, ancient temples, and warm-hearted locals in Bali. The rice terraces are absolutely stunning, especially during sunrise. Tried the local cuisine and learned about Balinese culture. A perfect blend of relaxation and adventure.',
                'location' => 'Bali, Indonesia',
                'travel_date' => now()->subMonths(3),
                'tags' => [2, 5, 6, 7],
            ],
            [
                'user_id' => $user3->id,
                'title' => 'New York City: The City That Never Sleeps',
                'description' => 'Explored the vibrant streets of NYC, from Broadway shows to street food in Times Square. The energy is contagious! Visited world-famous museums, iconic landmarks, and hidden gem neighborhoods. NYC is a must-visit destination.',
                'location' => 'New York, USA',
                'travel_date' => now()->subWeeks(2),
                'tags' => [4, 8, 6],
            ],
            [
                'user_id' => $user2->id,
                'title' => 'Adventure in Patagonia',
                'description' => 'Experienced the raw beauty of Patagonia with its dramatic mountain peaks, turquoise lakes, and impressive glaciers. Trek to Fitz Roy and Perito Moreno Glacier were life-changing experiences. For true adventurers!',
                'location' => 'Patagonia, Argentina',
                'travel_date' => now()->subMonths(4),
                'tags' => [1, 3, 15, 13],
            ],
        ];

        foreach ($travels as $travelData) {
            $travel = Travel::create([
                'user_id' => $travelData['user_id'],
                'title' => $travelData['title'],
                'description' => $travelData['description'],
                'location' => $travelData['location'],
                'travel_date' => $travelData['travel_date'],
            ]);

            // Attach tags
            $travel->tags()->attach($travelData['tags']);

            // Create placeholder images
            // In production, you would use actual images
            $imagePaths = $this->generatePlaceholderImages($travel->id);
            foreach ($imagePaths as $index => $path) {
                TravelImage::create([
                    'travel_id' => $travel->id,
                    'image_path' => $path,
                    'order' => $index,
                ]);
            }
        }
    }

    /**
     * Generate placeholder images for travels
     */
    private function generatePlaceholderImages($travelId)
    {
        $placeholders = [];
        
        // Using placeholder.com service for demo purposes
        $colors = ['FF6B6B', '4ECDC4', '45B7D1', 'FFA07A', '98D8C8'];
        
        for ($i = 0; $i < 3; $i++) {
            $color = $colors[$i % count($colors)];
            // Store placeholder URLs as paths for demonstration
            $placeholders[] = 'travels/placeholder_' . $travelId . '_' . $i . '.jpg';
        }

        return $placeholders;
    }
}
