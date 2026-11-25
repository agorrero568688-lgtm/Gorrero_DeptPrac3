<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('username', 'admin')->firstOrFail();

        $books = [
            ['title' => 'The Library at the End of the Road', 'author' => 'Clara Mendoza', 'category' => 'Fiction', 'unit_price' => 450.00, 'description' => 'A novel about a coastal town reunited by a local bookshop.', 'availability_status' => 'Available'],
            ['title' => 'A Map of Quiet Places', 'author' => 'Rafael Villanueva', 'category' => 'Fiction', 'unit_price' => 520.50, 'description' => 'Short stories following travelers across quiet island towns.', 'availability_status' => 'Unavailable'],
            ['title' => 'Everyday Budgeting for Beginners', 'author' => 'Marisol Reyes', 'category' => 'Nonfiction', 'unit_price' => 380.00, 'description' => 'Practical guide to monthly budgets and emergency savings.', 'availability_status' => 'Available'],
            ['title' => 'A Practical Guide to Urban Gardening', 'author' => 'Tomas Bautista', 'category' => 'Nonfiction', 'unit_price' => 415.00, 'description' => 'Growing herbs and vegetables in small apartments and balconies.', 'availability_status' => 'Unavailable'],
            ['title' => 'Introduction to Web Development', 'author' => 'Prof. Elena Soriano', 'category' => 'Academic', 'unit_price' => 795.00, 'description' => 'Undergraduate textbook covering HTML, CSS, PHP, and MVC.', 'availability_status' => 'Available'],
            ['title' => 'Fundamentals of Database Design', 'author' => 'Dr. Ernesto Navarro', 'category' => 'Academic', 'unit_price' => 850.00, 'description' => 'Relational modeling, normalization, SQL, and foreign keys.', 'availability_status' => 'Unavailable'],
            ['title' => 'Mia and the Missing Kite', 'author' => 'Liza Santiago', 'category' => "Children's Books", 'unit_price' => 240.00, 'description' => 'A storybook about Mia searching the park for her lost kite.', 'availability_status' => 'Available'],
            ['title' => 'Counting Stars with Lolo', 'author' => 'Gabriel Aquino', 'category' => "Children's Books", 'unit_price' => 265.00, 'description' => 'A bedtime picture book about learning constellations with Lolo.', 'availability_status' => 'Unavailable'],
        ];

        foreach ($books as $data) {
            Book::updateOrCreate(['title' => $data['title']], array_merge($data, ['user_id' => $admin->id]));
        }
    }
}