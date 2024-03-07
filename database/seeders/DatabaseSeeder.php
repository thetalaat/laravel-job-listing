<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Ahmed Talaat',
            'email' => 'test@test.com'

        ]);

        Listing::factory(6)->create([
            'user_id' => $user->id
        ]);


        // \App\Models\Listing::create([
        //     'title' => 'Test Title',
        //     'tags' => 'tag1, tag2',
        //     'company' => 'Test Company',
        //     'location' => 'Egypt',
        //     'email' => 'test@test.com',
        //     'website' => 'test.com',
        //     'description' => 'Test Description',
        // ]);
    }
}
