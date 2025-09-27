<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

// Import Model yang dibutuhkan
use App\Models\User;
use App\Models\CompanyProfile;
use App\Models\Service;
use App\Models\Project;
use App\Models\Article;
use App\Models\Career;
use App\Models\Partner;
use App\Models\ContactMessage;
use App\Models\Feedback;
use App\Models\JobApplication;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // --- 1. Buat User Admin & User Biasa ---
        $adminUser = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@fokusinovasi.com',
            'phone' => '081122334455',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $regularUser = User::create([
            'name' => 'Budi Pelamar',
            'email' => 'budi@user.com',
            'phone' => '081234567890',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Buat 5 user biasa lainnya untuk dummy data
        $users = [$regularUser];
        for ($i = 0; $i < 5; $i++) {
            $users[] = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'password' => Hash::make('password'),
                'role' => 'user',
            ]);
        }


        // --- 2. Company Profile (Sesuai Hero & About Section) ---
        $companyProfile = CompanyProfile::create([
            'company_name' => 'PT Fokus Inovasi Digital',
            'hero_subheading' => 'We create modern digital solutions that transform businesses.', // Sesuai Hero Text
            'about_subheading' => 'PT Fokus Inovasi Digital is a leading technology company specializing in cutting-edge digital solutions that drive business transformation and growth.', // Sesuai About Text
            'description' => $faker->paragraphs(3, true),
            'address' => 'Jl. Jenderal Sudirman No. 123, Jakarta Selatan',
            'phone' => '(021) 555-1234',
            'email' => 'info@fokusinovasi.com',
            'vision' => 'To be the leading digital transformation partner, recognized for excellence and innovation in technology solutions.', // Sesuai About Section
            'mission' => 'To deliver innovative digital solutions that empower businesses to achieve their full potential in the digital age.', // Sesuai About Section
            'quote' => 'Innovation, integrity, excellence, and customer-centricity drive everything we do.', // Sesuai About Section (Values)
            'logo' => 'logo.png',
            'social_media' => json_encode([
                'facebook' => 'https://facebook.com/fokusinovasi',
                'linkedin' => 'https://linkedin.com/company/fokusinovasi',
                'instagram' => 'https://instagram.com/fokusinovasi',
            ]),
            'website_url' => 'https://fokusinovasidigital.com',
        ]);


        // --- 3. Services (Sesuai Service Section) ---
        $serviceList = [
            ['title' => 'Cloud Solutions', 'icon' => '☁️', 'description' => 'Scalable cloud infrastructure and migration services for modern businesses.'],
            ['title' => 'Cybersecurity', 'icon' => '🔒', 'description' => 'Comprehensive security solutions to protect your digital assets.'],
            ['title' => 'Analytics', 'icon' => '📊', 'description' => 'Business intelligence and analytics platforms for informed decision making.'],
            ['title' => 'Web Development', 'icon' => '💻', 'description' => 'Custom website and web application development with modern frameworks.'],
            ['title' => 'Mobile App Development', 'icon' => '📱', 'description' => 'Building native and cross-platform mobile applications.'],
            ['title' => 'AI & Machine Learning', 'icon' => '🧠', 'description' => 'Implementing intelligent systems and data models.'],
        ];

        foreach ($serviceList as $data) {
            Service::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'short_description' => $data['description'],
                'content' => $faker->paragraphs(5, true),
                'is_featured' => $faker->boolean(40),
                'created_by' => $adminUser->id,
                'updated_by' => $adminUser->id,
            ]);
        }

        // --- 4. Projects (Sesuai Portfolio Section) ---
        $projectTitles = [
            ['title' => 'E-Commerce Platform', 'desc' => 'Modern e-commerce solution with advanced features'],
            ['title' => 'Banking App', 'desc' => 'Secure mobile banking application'],
            ['title' => 'IoT Dashboard', 'desc' => 'Real-time IoT monitoring dashboard'],
        ];

        foreach ($projectTitles as $data) {
            Project::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'short_description' => $data['desc'],
                'content' => $faker->paragraphs(4, true),
                'gallery' => json_encode(['img1.jpg', 'img2.jpg']),
                'is_featured' => $faker->boolean(60),
                'created_by' => $adminUser->id,
                'updated_by' => $adminUser->id,
            ]);
        }

        // --- 5. Articles (Sesuai Blog Section) ---
        $articleTitles = [
            ['title' => 'The Future of AI in Business', 'date' => now()->subDays(12)],
            ['title' => 'Cloud Migration Best Practices', 'date' => now()->subDays(17)],
            ['title' => 'Cybersecurity in 2024', 'date' => now()->subDays(22)],
        ];

        foreach ($articleTitles as $data) {
            Article::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'image' => 'article_' . Str::slug($data['title']) . '.jpg',
                'content' => $faker->paragraphs(6, true),
                'status' => 'published',
                'published_at' => $data['date'],
                'author_id' => $adminUser->id,
                'updated_by' => $adminUser->id,
            ]);
        }


        // --- 6. Partners (Sesuai Partners Section) ---
        $partnerNames = [
            ['name' => 'Tech Solutions Corp', 'logo' => 'TECH'],
            ['name' => 'Bank Sentosa', 'logo' => 'BANK'],
            ['name' => 'Cloud Infrastructure Inc', 'logo' => 'CLOUD'],
            ['name' => 'AI Innovator Hub', 'logo' => 'AI'],
            ['name' => 'Marketing Growth Agency', 'logo' => 'MARK'],
        ];

        foreach ($partnerNames as $data) {
            Partner::create([
                'name' => $data['name'],
                'description' => $faker->sentence(10),
                'logo' => $data['logo'] . '.png',
                'website_url' => $faker->url,
                'created_by' => $adminUser->id,
                'updated_by' => $adminUser->id,
            ]);
        }


        // --- 7. Careers (Job Careers) ---
        $career = Career::create([
            'title' => 'Senior Laravel Developer',
            'slug' => 'senior-laravel-developer',
            'description' => $faker->paragraphs(5, true),
            'location' => 'Jakarta, Indonesia',
            'status' => 'published',
            'work_type' => 'hybrid',
            'created_by' => $adminUser->id,
            'updated_by' => $adminUser->id,
        ]);

        Career::create([
            'title' => 'UI/UX Designer',
            'slug' => 'ui-ux-designer',
            'description' => $faker->paragraphs(4, true),
            'location' => 'Remote',
            'status' => 'published',
            'work_type' => 'remote',
            'created_by' => $adminUser->id,
            'updated_by' => $adminUser->id,
        ]);


        // --- 8. Job Application (Pelamar) ---
        JobApplication::create([
            'career_id' => $career->id,
            'user_id' => $regularUser->id,
            'full_name' => $regularUser->name,
            'email' => $regularUser->email,
            'phone' => $regularUser->phone,
            'address' => $faker->address,
            'cv_file' => 'cv/budi_cv.pdf',
            'cover_letter_file' => 'cl/budi_cl.pdf',
            'portfolio_file' => 'port/budi_port.zip',
            'additional_notes' => 'Sangat tertarik dengan posisi ini karena pengalaman saya di Laravel sudah 5 tahun.',
            'status' => 'pending',
        ]);


        // --- 9. Contact Messages (Pesan dari Contact Form) ---
        ContactMessage::create([
            'name' => 'Siti Aisyah',
            'email' => 'siti.aisyah@client.com',
            'phone' => '087812345678',
            'company' => 'PT Solusi Abadi',
            'subject' => 'Pertanyaan Kerjasama Proyek Baru',
            'message' => $faker->paragraph(4),
            'status' => 'new',
            'ip_address' => '127.0.0.1',
        ]);


        // --- 10. Feedbacks (Dari User Login) ---
        Feedback::create([
            'user_id' => $regularUser->id,
            'subject' => 'Request Fitur Dashboard',
            'message' => 'Tolong tambahkan fitur untuk melihat status lamaran kerja yang sudah saya apply.',
            'type' => 'feature_request',
            'status' => 'new',
        ]);
        
        // Kembalikan Foreign Key Checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}