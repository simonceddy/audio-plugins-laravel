<?php

namespace Database\Seeders;

use App\Models\Plugin;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PluginSeeder extends Seeder
{
    private function getTags(array $tags)
    {
        $results = [];
        foreach ($tags as $tag) {
            $t = Tag::select('id')->where('name', 'like', $tag)->first();
            if ($t) array_push($results, $t);
        }
        return $results;
    }

    private function attachTags(array $tags, Plugin $plugin)
    {
        foreach ($tags as $tag) {
            $plugin->tags()->attach($tag);
        }
    }

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

                if (isset($plugin['tags'])) {
                    $tags = $this->getTags($plugin['tags']);
                    if (!empty($tags)) $this->attachTags($tags, $p);
                }
            }
        } else {
            echo 'No plugins data found' . PHP_EOL;
        }
    }
}
