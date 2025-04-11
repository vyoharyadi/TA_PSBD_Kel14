<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            'fiction',
            'non-fiction',
            'comic',
            'novel',
            'romance',
            'self-help books',
            'children books',
            'biography',
            'autobiography',
            'text-books',
            'political books',
            'academic books',
            'mystery',
            'thrillers',
            'poetry books',
            'spiritual books',
            'cook books',
            'art books',
            'young adult books',
            'board books',
            'history books'
        ];

        foreach ($data as $value) {
            Category::insert(['name' => $value]);
        }
    }
}
