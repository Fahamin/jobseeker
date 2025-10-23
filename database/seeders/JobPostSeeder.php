<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobPost;
use App\Models\Category;
use Illuminate\Support\Str;

class JobPostSeeder extends Seeder
{
    public function run(): void
    {
        // Make sure some categories exist
        if (Category::count() === 0) {
            Category::factory()->count(5)->create();
        }

        $categories = Category::all();

        $jobTypes = ['Full-time', 'Part-time', 'Internship', 'Remote', 'Contract'];
        $companies = ['TechSoft Ltd', 'NextGen IT', 'CodeCrafters', 'PixelHub', 'DataNest'];
        $locations = ['Dhaka', 'Chattogram', 'Rajshahi', 'Sylhet', 'Khulna'];

        foreach (range(1, 10) as $i) {
            JobPost::create([
                'title' => 'Job Position ' . $i,
                'company' => $companies[array_rand($companies)],
                'location' => $locations[array_rand($locations)],
                'type' => $jobTypes[array_rand($jobTypes)],
                'category' => $categories->random()->name,
                'category_id' => $categories->random()->id,
                'salary' => rand(20000, 80000) . ' BDT',
                'description' => 'This is a sample job description for position ' . $i . '.',
                'requirements' => [
                    'Bachelor’s degree in related field',
                    '2+ years of experience',
                    'Strong communication skills',
                ],
                'image' => 'jobs/job_' . $i . '.jpg',
                'pdf' => 'jobs/job_' . $i . '.pdf',
                'publishdate' => now()->subDays(rand(0, 5)),
                'dateline' => now()->addDays(rand(5, 20)),
                'is_active' => rand(0, 1),
            ]);
        }
    }
}
