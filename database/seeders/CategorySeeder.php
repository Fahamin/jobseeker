<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Information Technology', 'description' => 'Jobs related to software development, networking, and IT support.'],
            ['name' => 'Marketing', 'description' => 'Jobs in marketing, advertising, and brand management.'],
            ['name' => 'Finance & Accounting', 'description' => 'Jobs related to accounting, auditing, and financial management.'],
            ['name' => 'Human Resources', 'description' => 'Jobs for HR managers, recruiters, and HR assistants.'],
            ['name' => 'Engineering', 'description' => 'Jobs in civil, mechanical, electrical, and industrial engineering.'],
            ['name' => 'Education & Training', 'description' => 'Jobs for teachers, trainers, and education consultants.'],
            ['name' => 'Healthcare', 'description' => 'Jobs in hospitals, clinics, and medical research.'],
            ['name' => 'Customer Service', 'description' => 'Jobs related to customer support and call centers.'],
            ['name' => 'Sales', 'description' => 'Jobs for sales executives, representatives, and managers.'],
            ['name' => 'Construction', 'description' => 'Jobs in building, architecture, and project management.'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
