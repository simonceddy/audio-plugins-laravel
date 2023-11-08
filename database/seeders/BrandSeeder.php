<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BrandSeeder extends Seeder
{
    private array $brandSlugs = [];

    private function seedBrands(array $data)
    {
        foreach ($data as $brand) {
            $b = new Brand([
                'name' => $brand['name'],
                'url' => $brand['url'] ?? null
            ]);

            $b->save();
            $this->brandSlugs[$brand['slug']] = $b->getAttribute('id');
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

        if ($fs->exists('devs.json')) {
            echo 'Brands data found' . PHP_EOL;
            $data = json_decode($fs->get('devs.json'), true);
            $this->seedBrands($data);
            $fs->put('brand-slugs.json', json_encode($this->brandSlugs));

        } else {
            echo 'No brands data found' . PHP_EOL;
        }
    }
}
