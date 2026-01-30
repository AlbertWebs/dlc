<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coach;

class CoachSeeder extends Seeder
{
    public function run(): void
    {
        Coach::updateOrCreate(
            [
                'email' => 'info@dlc.co.ke',
            ],
            [
                'name' => 'Jeff Israel Nthiwa',
                'slug' => 'jeff-israel-nthiwa',
                'title' => 'Founder & Master Certified Life Coach',
                'bio' => 'Founder of Destiny Life Coaching Kenya, empowering agents of change to become world-class practitioners of transformative Life Coaching excellence.',
                'description' => '<p>Jeff Israel Nthiwa is the visionary founder of <strong>Destiny Life Coaching Kenya</strong>, a leading provider of certified life coaching services in Kenya and beyond. With over 18 years of experience in transformational coaching, Jeff has dedicated his career to empowering individuals and organizations to achieve breakthrough results.</p><p>&nbsp;</p><h3><strong>Transformational Leadership</strong></h3><p>As a Master Certified Life Coach, Jeff has trained over 500 coaches across Kenya and Africa, creating a network of world-class practitioners who are positively influencing communities through the results-based transformational approach to coaching.</p><h3>The SHIFT Breakthrough Process™</h3><p>Jeff is the creator of the revolutionary <strong>SHIFT Breakthrough Process™</strong>, a unique 5-step system designed to help individuals:</p><ul><li>Gain deep awareness of their current state</li><li>Release limiting beliefs and patterns</li><li>Reprogram their mindset for success</li><li>Reinvent their identity</li><li>Integrate lasting change into their lives</li></ul><h3>Impact &amp; Recognition</h3><p>&nbsp;</p><p>Through his work at Destiny Life Coaching, Jeff has helped thousands of clients transform their personal and professional lives. His proven methods have created lasting change for individuals, teams, and organizations across Kenya and beyond.</p><p>Jeff believes that every individual has the power to shape their own destiny, and he is committed to helping people unlock their full potential through world-class coaching excellence.</p>',
                'photo' => 'coaches/UCxtO5V26OH7g0QAfNbCEEEJdCA9Bii7qaNieEUT.jpg',
                'phone' => +254722992111,
                'location' => 'Nairobi, Kenya',
                'credentials' => '["Master Certified Life Coach (ICR)","Certified Breakthrough Intervention Coach","Certified Life Coach Trainer","ICR-Certified Life Coach"]',
                'specializations' => '["Breakthrough Intervention Coaching","Life Coaching Certification Training","Personal Transformation","Mindset Mastery","Leadership Development","Career Coaching","Relationship Coaching","Business Coaching"]',
                'social_links' => '{"facebook":"https:\/\/www.facebook.com\/breakthroughwithjeff\/","linkedin":"https:\/\/www.linkedin.com\/in\/lifecoachkenya\/","instagram":"https:\/\/www.instagram.com\/thelifemasterybootcamp","youtube":"https:\/\/www.youtube.com\/channel\/UCcYXau-TIgy-1h9mK9m5V4A"}',
                'experience' => 'With over 18 years of experience in transformational coaching, Jeff has:

• Founded and led Destiny Life Coaching Kenya, establishing it as Kenya\'s top life coaching school
• Trained over 500 certified life coaches across Kenya and Africa
• Developed the SHIFT Breakthrough Process™, a proven 5-step transformational system
• Helped thousands of clients achieve breakthrough results in their personal and professional lives
• Created comprehensive coaching programs that have transformed lives across Kenya and beyond
• Established a network of world-class coaching practitioners positively influencing Africa and the world

Jeff\'s expertise spans personal transformation, mindset mastery, leadership development, and organizational coaching. He has worked with individuals, teams, and organizations to create lasting change and breakthrough results.',
                'education' => 'Jeff Israel Nthiwa has pursued extensive education and training in:

• Life Coaching and Transformational Coaching methodologies
• Breakthrough Intervention Coaching techniques
• Leadership and Organizational Development
• Psychology and Human Behavior
• Business and Entrepreneurship

His commitment to continuous learning and professional development has made him a recognized authority in the field of life coaching in Kenya and beyond.',
                'certifications' => '• Master Certified Life Coach (International Coach Registry - ICR)
• Certified Breakthrough Intervention Coach
• Certified Life Coach Trainer
• ICR-Certified Life Coach
• Professional Coaching Certifications
• Advanced Coaching Methodologies Certification',
                'coaching_style' => 'Jeff\'s coaching style is characterized by a results-based transformational approach that combines deep awareness, mindset rewiring, emotional mastery, and identity alignment. He creates a supportive yet challenging environment that empowers clients to move from confusion to clarity, from fear to bold action, and from survival mode to a life of intentional success and fulfillment.',
                'testimonials' => '"Working with Jeff transformed my entire perspective on life and career. His SHIFT Breakthrough Process helped me identify and release limiting beliefs I didn\'t even know I had. I\'m now living a life I never thought possible." - Client Testimonial

"Jeff is not just a coach; he\'s a transformational leader. His ability to help you see your potential and then guide you to achieve it is remarkable. The coaching I received changed my life." - Client Testimonial

"Through Jeff\'s guidance, I went from feeling stuck and uncertain to having a clear vision and the confidence to pursue it. His methods are powerful and effective." - Client Testimonial',
                'is_featured' => 1,
                'is_active' => 1,
                'order' => 1,
                'created_at' => '2026-01-26 15:51:02',
                'updated_at' => '2026-01-27 08:56:20',
            ]
        );

        Coach::updateOrCreate(
            [
            ],
            [
                'name' => 'Bridget Mutemi',
                'slug' => 'bridget-mutemi',
                'title' => 'Founder, Lead Coach Alchemy and Bliss Coaching',
                'bio' => 'Seasoned mindset life coach in Nairobi specializing in mindset, wellness, youth empowerment, financial guidance, emotional mastery, leadership development, retirement planning, and holistic wellness.',
                'description' => 'Bridget Mutemi, a seasoned mindset life coach in Nairobi, Kenya, specializes in various coaching areas such as mindset, wellness, youth empowerment, financial guidance, and leadership development. She founded Alchemy and Bliss Coaching, employing transformative techniques to help clients overcome obstacles and cultivate resilience for sustainable success. Her expertise spans mindset coaching, wellness support, youth empowerment, financial guidance, emotional mastery, leadership development, retirement planning, and holistic wellness. Through her practice, she fosters personal growth and transformation, guiding individuals towards a purposeful, successful, and fulfilling life. Contact her at Alchemy and Bliss Coaching for inquiries or coaching services. info@alchemyandblisscoaching.com Phone: +254 723538465',
                'photo' => 'coaches/bridget-mutemi.jpeg',
                'email' => null,
                'phone' => null,
                'location' => 'Kenya',
                'credentials' => null,
                'specializations' => '["Mindset coaching","Wellness support","Youth empowerment","Financial guidance","Emotional mastery","Leadership development","Retirement planning","Holistic wellness"]',
                'social_links' => null,
                'experience' => null,
                'education' => null,
                'certifications' => null,
                'coaching_style' => null,
                'testimonials' => null,
                'is_featured' => 0,
                'is_active' => 1,
                'order' => 0,
                'created_at' => '2026-01-27 08:17:32',
                'updated_at' => '2026-01-27 08:17:32',
            ]
        );

        Coach::updateOrCreate(
            [
            ],
            [
                'name' => 'Seletian Kitonga',
                'slug' => 'seletian-kitonga',
                'title' => 'Practitioner of coaching excellence',
                'bio' => 'Life coach, transformation coach, youth coach, trainer and mentor at SAM Elimu Foundation, and personal finance coach.',
                'description' => 'Life coach | Transformation coach | Youth coach, trainer and mentor @ SAM Elimu Foundation | Personal Finance Coach.',
                'photo' => 'coaches/seletian-kitonga.png',
                'email' => null,
                'phone' => null,
                'location' => 'Kenya',
                'credentials' => null,
                'specializations' => '["Transformation coaching","Youth coaching","Personal finance coaching","Training & mentoring"]',
                'social_links' => null,
                'experience' => null,
                'education' => null,
                'certifications' => null,
                'coaching_style' => null,
                'testimonials' => null,
                'is_featured' => 0,
                'is_active' => 1,
                'order' => 0,
                'created_at' => '2026-01-27 08:17:32',
                'updated_at' => '2026-01-27 08:17:32',
            ]
        );

    }
}
