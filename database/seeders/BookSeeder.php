<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('books')->insert([
            [
                'book_code' => 'BK001',
                'title' => 'The Pragmatic Programmer',
                'author' => 'Andrew Hunt & David Thomas',
                'year' => 1999,
                'image' => 'https://images-na.ssl-images-amazon.com/images/I/41as+WafrFL._SX258_BO1,204,203,200_.jpg',
                'description' => 'A classic book on software engineering and programming best practices.',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_code' => 'BK002',
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'year' => 2008,
                'image' => 'https://images-na.ssl-images-amazon.com/images/I/41xShlnTZTL._SX374_BO1,204,203,200_.jpg',
                'description' => 'A handbook of agile software craftsmanship and writing clean code.',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_code' => 'BK003',
                'title' => 'Introduction to Algorithms',
                'author' => 'Thomas H. Cormen',
                'year' => 2009,
                'image' => 'https://images-na.ssl-images-amazon.com/images/I/51oXKWrcYYL._SX376_BO1,204,203,200_.jpg',
                'description' => 'Comprehensive textbook covering a broad range of algorithms in depth.',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_code' => 'BK004',
                'title' => 'Design Patterns: Elements of Reusable Object-Oriented Software',
                'author' => 'Erich Gamma, Richard Helm, Ralph Johnson, John Vlissides',
                'year' => 1994,
                'image' => 'https://images-na.ssl-images-amazon.com/images/I/51kue3jYcbL._SX379_BO1,204,203,200_.jpg',
                'description' => 'The foundational book on software design patterns for OOP.',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_code' => 'BK005',
                'title' => 'Refactoring: Improving the Design of Existing Code',
                'author' => 'Martin Fowler',
                'year' => 2018,
                'image' => 'https://images-na.ssl-images-amazon.com/images/I/51k4j6wz+jL._SX379_BO1,204,203,200_.jpg',
                'description' => 'Guidance on how to improve software structure without changing functionality.',
                'status' => 'available',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
