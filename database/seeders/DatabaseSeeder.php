<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Telescope\Telescope;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Telescope::stopRecording();
        $this->call([
            CategorySeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
