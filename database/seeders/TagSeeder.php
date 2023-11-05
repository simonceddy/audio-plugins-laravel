<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fs = Storage::build([
            'driver' => 'local',
            'root' => storage_path('dev')
        ]);

        $data = json_decode($fs->get('tags.json'), true);
        foreach ($data as $name) {
            $tag = new Tag(['name' => $name]);
            $tag->save();
        }
        // dd($data);
    }
}
