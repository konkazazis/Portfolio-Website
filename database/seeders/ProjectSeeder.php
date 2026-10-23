<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Sample portfolio projects with case studies, for local development.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'kazazis.dev',
                'slug' => 'kazazis-dev',
                'description' => 'My own portfolio, blog and custom CMS — built from scratch to show what a hand-crafted Laravel site can do.',
                'client' => 'Personal project',
                'year' => '2026',
                'role' => 'Design & full-stack development',
                'technologies' => 'Laravel, Livewire, Tailwind CSS, PostgreSQL, Cloudflare R2',
                'live_url' => 'https://kazazis.dev',
                'github_url' => 'https://github.com/konkazazis',
                'challenge' => "As a freelancer, my website is my business card. It had to show my work, host a blog and let me publish new content in minutes — without relying on WordPress plugins or a page builder.\n\nIt also had to be fast. If I promise clients top Lighthouse scores, my own site has to prove it.",
                'solution' => "I built a custom CMS on Laravel and Livewire: posts with categories and tags, a rich-text editor with image uploads, a project manager, and an inbox for contact messages. Images are stored on Cloudflare R2 so the server stays lean.\n\nThe front end uses Tailwind CSS with a playful, hand-drawn visual style, scroll-reveal animations that respect reduced-motion settings, and structured data on every page for search engines.",
                'outcome' => "A site I can update from any device in a few clicks, with 100 scores across Lighthouse performance, accessibility, best practices and SEO.\n\nThe same CMS is now the foundation I offer to clients who want to manage their own content.",
            ],
            [
                'title' => 'Neighbourhood Bakery',
                'slug' => 'neighbourhood-bakery',
                'description' => 'A warm, mobile-first website for a family bakery, with a weekly menu the owners update themselves.',
                'client' => 'Bäckerei Beispiel',
                'year' => '2026',
                'role' => 'Design & development',
                'technologies' => 'Laravel, Livewire, Tailwind CSS',
                'challenge' => "The bakery had only a Facebook page, and customers kept calling to ask about opening hours and what was baked that day.\n\nThe owners wanted a simple website that looked like their shop — and that they could update without calling a developer.",
                'solution' => "I designed a one-page site around big photos of the shop and its bread, with opening hours, directions and a phone button one tap away on mobile.\n\nA small admin area lets the owners publish the weekly menu and seasonal specials from their phone in under a minute.",
                'outcome' => "Phone calls about opening hours dropped noticeably in the first month, and the site now shows up first when people search for the bakery's name.\n\nThe owners update the menu every week themselves.",
            ],
            [
                'title' => 'Physiotherapy Practice',
                'slug' => 'physiotherapy-practice',
                'description' => 'A calm, trustworthy website for a physiotherapy practice, with treatment pages and an appointment request form.',
                'client' => 'Physio Praxis Beispiel',
                'year' => '2025',
                'role' => 'Design, development & hosting setup',
                'technologies' => 'Laravel, Tailwind CSS, PostgreSQL, Resend',
                'challenge' => "The practice's old website was slow, not mobile-friendly and hard to read. New patients couldn't easily find which treatments were offered or how to book.\n\nAs a health business, it also needed a GDPR-compliant contact form and a proper Impressum.",
                'solution' => "I restructured the content around the questions patients actually ask: what do you treat, who will I see, and how do I book. Each treatment got its own clear page.\n\nThe appointment request form sends a confirmation to the patient and a notification to the practice, and I set up the domain, business email and hosting so everything runs in one place.",
                'outcome' => "The new site loads in under a second on mobile, and appointment requests through the website replaced most booking phone calls.\n\nThe practice now has one point of contact for its website, email and domain.",
            ],
            [
                'title' => 'Photographer Portfolio',
                'slug' => 'photographer-portfolio',
                'description' => 'A minimal portfolio with a self-managed gallery, letting the photos do the talking.',
                'client' => 'Freelance photographer',
                'year' => '2025',
                'role' => 'Development',
                'technologies' => 'Laravel, Livewire, Tailwind CSS, Cloudflare R2',
                'challenge' => "The photographer was paying monthly for a portfolio platform that compressed her images and looked like everyone else's.\n\nShe wanted full control over how her work is presented, without a recurring subscription.",
                'solution' => "I built a minimal, image-first layout with full-screen galleries and a simple upload area. Photos are stored on Cloudflare R2 and served in modern formats at the right size for each screen.\n\nGalleries can be reordered by drag and drop, and each one gets its own shareable link for clients.",
                'outcome' => "Sharp, fast-loading galleries at a fraction of the old subscription cost, and a portfolio that finally looks like her own.",
            ],
        ];

        foreach ($projects as $order => $data) {
            Project::updateOrCreate(
                ['slug' => $data['slug']],
                [...$data, 'order' => $order + 1, 'is_published' => true],
            );
        }
    }
}
