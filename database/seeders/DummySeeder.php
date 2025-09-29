<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\CompanyProfile;
use App\Models\Solution;
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
            'email' => 'admin@fokusinovasidigital.com',
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
            // Category 'service'
            ['title' => 'Cloud Solutions', 'description' => 'Scalable cloud infrastructure and migration services for modern businesses.', 'category' => 'service', 'status' => 'published'],
            ['title' => 'Cybersecurity', 'description' => 'Comprehensive security solutions to protect your digital assets.', 'category' => 'service', 'status' => 'published'],
            ['title' => 'Analytics', 'description' => 'Business intelligence and analytics platforms for informed decision making.', 'category' => 'service', 'status' => 'draft'],
            ['title' => 'Web Development', 'description' => 'Custom website and web application development with modern frameworks.', 'category' => 'service', 'status' => 'published'],
            ['title' => 'Mobile App Development', 'description' => 'Building native and cross-platform mobile applications.', 'category' => 'service', 'status' => 'draft'],
            ['title' => 'AI & Machine Learning', 'description' => 'Implementing intelligent systems and data models.', 'category' => 'service', 'status' => 'published'],

            // Category 'infrastructure'
            ['title' => 'Cloud Hosting', 'description' => 'High-performance cloud hosting solutions for businesses of all sizes.', 'category' => 'infrastructure', 'status' => 'published'],
            ['title' => 'Data Center Services', 'description' => 'Reliable data center services with high uptime and security.', 'category' => 'infrastructure', 'status' => 'published'],
            ['title' => 'Networking Solutions', 'description' => 'End-to-end networking solutions for optimal connectivity.', 'category' => 'infrastructure', 'status' => 'draft'],
            ['title' => 'Disaster Recovery', 'description' => 'Data recovery services to ensure business continuity during emergencies.', 'category' => 'infrastructure', 'status' => 'published'],

            // Category 'product'
            ['title' => 'SaaS Platform', 'description' => 'A comprehensive Software-as-a-Service platform to streamline business operations.', 'category' => 'product', 'status' => 'published'],
            ['title' => 'Mobile App', 'description' => 'Innovative mobile app designed to enhance customer experience.', 'category' => 'product', 'status' => 'draft'],
            ['title' => 'Analytics Tool', 'description' => 'Advanced data analytics tool to gain insights and drive decision-making.', 'category' => 'product', 'status' => 'published'],
            ['title' => 'Project Management Software', 'description' => 'A powerful tool to manage and track your projects and teams.', 'category' => 'product', 'status' => 'draft'],
        ];

        foreach ($serviceList as $data) {
            Solution::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'short_description' => $data['description'],
                'content' => $faker->paragraphs(5, true),
                'is_featured' => $faker->boolean(40),
                'category' => $data['category'],
                'status' => $data['status'],
                'published_at' => $data['status'] === 'published' ? now() : null,
                'created_by' => $adminUser->id,
                'updated_by' => null,
            ]);
        }

        // --- 4. Articles (Sesuai Blog Section) ---
        $articleTitles = [
            // Kategori 'article'
            ['title' => 'The Future of AI in Business', 'category' => 'article', 'date' => now()->subDays(12)],
            ['title' => 'Cloud Migration Best Practices', 'category' => 'article', 'date' => now()->subDays(17)],
            ['title' => 'Cybersecurity in 2024', 'category' => 'article', 'date' => now()->subDays(22)],

            // Kategori 'activity'
            ['title' => 'Tech Conference 2024: What to Expect', 'category' => 'activity', 'date' => now()->subDays(5)],
            ['title' => 'AI Workshop for Developers', 'category' => 'activity', 'date' => now()->subDays(10)],
            ['title' => 'Cybersecurity Seminar: The Need for Awareness', 'category' => 'activity', 'date' => now()->subDays(15)],

            // Kategori 'csr' (Corporate Social Responsibility)
            ['title' => 'Our Commitment to Green Technology', 'category' => 'csr', 'date' => now()->subDays(8)],
            ['title' => 'Community Outreach: Bringing Tech to Rural Areas', 'category' => 'csr', 'date' => now()->subDays(13)],
            ['title' => 'Supporting Education: Tech Scholarships for Students', 'category' => 'csr', 'date' => now()->subDays(18)],
        ];

        foreach ($articleTitles as $data) {
            Article::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'image' => 'article_' . Str::slug($data['title']) . '.jpg',
                'content' => $faker->paragraphs(6, true),
                'gallery' => json_encode([]),
                'category' => $data['category'],
                'status' => 'published',
                'published_at' => $data['date'],
                'author_id' => $adminUser->id,
                'updated_by' => null,
            ]);
        }


        // --- 5. Partners (Sesuai Partners Section) ---
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


        // --- 6. Careers (Job Careers) ---
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


        // --- 7. Job Application (Pelamar) ---
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


        // --- 8. Contact Messages (Pesan dari Contact Form) ---
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


        // --- 9. Feedbacks (Dari User Login) ---
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