<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PluginSeeder extends Seeder
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

        if ($fs->exists('plugins.json')) {
            echo 'Plugins data found' . PHP_EOL;
        } else {
            echo 'No plugins data found' . PHP_EOL;
        }
    }
}
