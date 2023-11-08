<?php

namespace Database\Seeders;

use App\Models\Plugin;
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

        if ($fs->exists('plugins.json') && $fs->exists('brand-slugs.json')) {
            echo 'Plugins data found' . PHP_EOL;

            $slugs = json_decode($fs->get('brand-slugs.json'), true);

            $data = json_decode($fs->get('plugins.json'), true);

            foreach ($data as $plugin) {
                $brandId = isset($plugin['developerSlug'])
                    ? $slugs[$plugin['developerSlug']]
                    : null;
                // dd($brandId);
                $p = new Plugin([
                    'name' => $plugin['name'],
                    'url' => $plugin['url'] ?? null,
                ]);

                if ($brandId) {
                    $p->brand()->associate($brandId);
                }

                $p->save();
            }
        } else {
            echo 'No plugins data found' . PHP_EOL;
        }
    }
}
