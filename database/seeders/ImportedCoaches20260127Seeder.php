<?php

namespace Database\Seeders;

use App\Models\Coach;
use Illuminate\Database\Seeder;

class ImportedCoaches20260127Seeder extends Seeder
{
    public function run(): void
    {
        // Bridget Mutemi
        Coach::updateOrCreate(
            ['slug' => 'bridget-mutemi'],
            [
                'name' => 'Bridget Mutemi',
                'title' => 'Founder, Lead Coach Alchemy and Bliss Coaching',
                'bio' => 'Seasoned mindset life coach in Nairobi specializing in mindset, wellness, youth empowerment, financial guidance, emotional mastery, leadership development, retirement planning, and holistic wellness.',
                'description' => 'Bridget Mutemi, a seasoned mindset life coach in Nairobi, Kenya, specializes in various coaching areas such as mindset, wellness, youth empowerment, financial guidance, and leadership development. She founded Alchemy and Bliss Coaching, employing transformative techniques to help clients overcome obstacles and cultivate resilience for sustainable success. Her expertise spans mindset coaching, wellness support, youth empowerment, financial guidance, emotional mastery, leadership development, retirement planning, and holistic wellness. Through her practice, she fosters personal growth and transformation, guiding individuals towards a purposeful, successful, and fulfilling life. Contact her at Alchemy and Bliss Coaching for inquiries or coaching services. info@alchemyandblisscoaching.com Phone: +254 723538465',
                'photo' => 'coaches/bridget-mutemi.jpeg',
                'location' => 'Kenya',
                'specializations' => [
                    'Mindset coaching',
                    'Wellness support',
                    'Youth empowerment',
                    'Financial guidance',
                    'Emotional mastery',
                    'Leadership development',
                    'Retirement planning',
                    'Holistic wellness',
                ],
                'is_active' => true,
            ]
        );

        // Seletian Kitonga
        Coach::updateOrCreate(
            ['slug' => 'seletian-kitonga'],
            [
                'name' => 'Seletian Kitonga',
                'title' => 'Practitioner of coaching excellence',
                'bio' => 'Life coach, transformation coach, youth coach, trainer and mentor at SAM Elimu Foundation, and personal finance coach.',
                'description' => 'Life coach | Transformation coach | Youth coach, trainer and mentor @ SAM Elimu Foundation | Personal Finance Coach.',
                'photo' => 'coaches/seletian-kitonga.png',
                'location' => 'Kenya',
                'specializations' => [
                    'Transformation coaching',
                    'Youth coaching',
                    'Personal finance coaching',
                    'Training & mentoring',
                ],
                'is_active' => true,
            ]
        );
    }
}

