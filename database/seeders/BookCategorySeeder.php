<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = Book::all();
        $categoryIds = Category::pluck('id');

        foreach ($books as $book) {
            // Ambil 1-3 kategori secara acak untuk setiap buku
            $randomCategoryIds = $categoryIds->random(rand(1, 3));
            $book->categories()->attach($randomCategoryIds);
        }
    }
}
