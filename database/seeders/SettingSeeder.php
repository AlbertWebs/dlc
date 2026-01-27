<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            [
                'key' => 'site_name',
            ],
            [
                'key' => 'site_name',
                'value' => 'DLC Kenya',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 16:33:40',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'site_url',
            ],
            [
                'key' => 'site_url',
                'value' => 'https://www.dlc.co.ke',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 16:33:09',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'site_email',
            ],
            [
                'key' => 'site_email',
                'value' => 'info@dlc.co.ke',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 08:10:18',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'timezone',
            ],
            [
                'key' => 'timezone',
                'value' => 'UTC',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 08:10:18',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'phone',
            ],
            [
                'key' => 'phone',
                'value' => '+254 722 992 111',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 08:10:18',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'email',
            ],
            [
                'key' => 'email',
                'value' => 'info@dlc.co.ke',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 08:10:18',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'location',
            ],
            [
                'key' => 'location',
                'value' => 'Savelberg Retreat Center Muringa Rd, Nairobi, Kenya',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 08:10:18',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'address',
            ],
            [
                'key' => 'address',
                'value' => '',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 08:10:18',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'city',
            ],
            [
                'key' => 'city',
                'value' => 'Nairobi',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 08:10:18',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'country',
            ],
            [
                'key' => 'country',
                'value' => 'Kenya',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 08:10:18',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'postal_code',
            ],
            [
                'key' => 'postal_code',
                'value' => '',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 08:10:18',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'social_facebook',
            ],
            [
                'key' => 'social_facebook',
                'value' => 'https://www.facebook.com/breakthroughwithjeff/',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 08:11:49',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'social_linkedin',
            ],
            [
                'key' => 'social_linkedin',
                'value' => 'https://www.linkedin.com/in/lifecoachkenya/',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 08:11:49',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'social_instagram',
            ],
            [
                'key' => 'social_instagram',
                'value' => 'https://www.instagram.com/breakthroughwithjeff/',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 08:11:49',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'social_twitter',
            ],
            [
                'key' => 'social_twitter',
                'value' => 'https://www.instagram.com/breakthroughwithjeff/',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 08:12:19',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'social_youtube',
            ],
            [
                'key' => 'social_youtube',
                'value' => 'https://www.instagram.com/breakthroughwithjeff/',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 08:12:19',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'meta_description',
            ],
            [
                'key' => 'meta_description',
                'value' => '',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 08:10:18',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'meta_keywords',
            ],
            [
                'key' => 'meta_keywords',
                'value' => '',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 08:10:18',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'google_analytics',
            ],
            [
                'key' => 'google_analytics',
                'value' => '',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 08:10:18',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'google_tag_manager',
            ],
            [
                'key' => 'google_tag_manager',
                'value' => '',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 08:10:18',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'logo_url',
            ],
            [
                'key' => 'logo_url',
                'value' => 'https://dlc.co.ke/wp-content/uploads/2023/02/interna.jpg',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 08:12:09',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'favicon_url',
            ],
            [
                'key' => 'favicon_url',
                'value' => '',
                'created_at' => '2026-01-26 08:10:18',
                'updated_at' => '2026-01-26 08:10:18',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'hero_type',
            ],
            [
                'key' => 'hero_type',
                'value' => 'fullwidth-video',
                'created_at' => '2026-01-26 09:17:56',
                'updated_at' => '2026-01-26 09:17:56',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_stat1_number',
            ],
            [
                'key' => 'about_section_stat1_number',
                'value' => '500+',
                'created_at' => '2026-01-26 10:59:34',
                'updated_at' => '2026-01-26 10:59:34',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_stat1_label',
            ],
            [
                'key' => 'about_section_stat1_label',
                'value' => 'COACHES TRAINED',
                'created_at' => '2026-01-26 10:59:34',
                'updated_at' => '2026-01-26 10:59:34',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_stat2_number',
            ],
            [
                'key' => 'about_section_stat2_number',
                'value' => '10+',
                'created_at' => '2026-01-26 10:59:34',
                'updated_at' => '2026-01-26 10:59:34',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_stat2_label',
            ],
            [
                'key' => 'about_section_stat2_label',
                'value' => 'BOOKS WRITTEN',
                'created_at' => '2026-01-26 10:59:34',
                'updated_at' => '2026-01-26 10:59:34',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_stat3_number',
            ],
            [
                'key' => 'about_section_stat3_number',
                'value' => '18+',
                'created_at' => '2026-01-26 10:59:34',
                'updated_at' => '2026-01-26 10:59:34',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_stat3_label',
            ],
            [
                'key' => 'about_section_stat3_label',
                'value' => 'YEARS Experience',
                'created_at' => '2026-01-26 10:59:34',
                'updated_at' => '2026-01-26 10:59:34',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_stat4_number',
            ],
            [
                'key' => 'about_section_stat4_number',
                'value' => '4,000+',
                'created_at' => '2026-01-26 10:59:34',
                'updated_at' => '2026-01-26 10:59:34',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_stat4_label',
            ],
            [
                'key' => 'about_section_stat4_label',
                'value' => 'CLIENTS',
                'created_at' => '2026-01-26 10:59:34',
                'updated_at' => '2026-01-26 10:59:34',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_stats_number',
            ],
            [
                'key' => 'about_section_stats_number',
                'value' => '4,000+',
                'created_at' => '2026-01-26 10:59:34',
                'updated_at' => '2026-01-26 10:59:34',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_stats_label',
            ],
            [
                'key' => 'about_section_stats_label',
                'value' => 'CLIENTS',
                'created_at' => '2026-01-26 10:59:34',
                'updated_at' => '2026-01-26 10:59:34',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_page_hero_title',
            ],
            [
                'key' => 'about_page_hero_title',
                'value' => 'ABOUT US',
                'created_at' => '2026-01-26 11:04:24',
                'updated_at' => '2026-01-26 11:04:24',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_page_hero_subtitle',
            ],
            [
                'key' => 'about_page_hero_subtitle',
                'value' => 'Empowering lives through expert coaching and professional development',
                'created_at' => '2026-01-26 11:04:24',
                'updated_at' => '2026-01-26 11:04:24',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_page_introduction_title',
            ],
            [
                'key' => 'about_page_introduction_title',
                'value' => 'Introduction',
                'created_at' => '2026-01-26 11:04:24',
                'updated_at' => '2026-01-26 11:04:24',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_page_introduction_content',
            ],
            [
                'key' => 'about_page_introduction_content',
                'value' => 'Destiny Life Coaching is here to enable agents of change to become world-class practitioners of transformative coaching excellence who will positively influence Africa and the world using the results-based transformational approach to life coaching.',
                'created_at' => '2026-01-26 11:04:24',
                'updated_at' => '2026-01-26 11:04:24',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_page_mission_title',
            ],
            [
                'key' => 'about_page_mission_title',
                'value' => 'Mission',
                'created_at' => '2026-01-26 11:04:24',
                'updated_at' => '2026-01-26 11:04:24',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_page_mission_content',
            ],
            [
                'key' => 'about_page_mission_content',
                'value' => 'Develop transformative soul-based practitioners of coaching and speaking excellence through soul-based immersion coaching experience, exposure to cutting-edge transformational tools, collaborative practice, research, and innovative contribution to humanity.',
                'created_at' => '2026-01-26 11:04:24',
                'updated_at' => '2026-01-26 11:04:24',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_page_vision_title',
            ],
            [
                'key' => 'about_page_vision_title',
                'value' => 'Vision',
                'created_at' => '2026-01-26 11:04:24',
                'updated_at' => '2026-01-26 11:04:24',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_page_vision_content',
            ],
            [
                'key' => 'about_page_vision_content',
                'value' => 'DLC is a world class center for transformational life success. This is dedicated to excellence in life coaching, transformational Leadership Academy, and transformative speaker training which is distinguished by high-quality, value-based training that is also transformative.',
                'created_at' => '2026-01-26 11:04:24',
                'updated_at' => '2026-01-26 11:04:24',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_page_leadership_title',
            ],
            [
                'key' => 'about_page_leadership_title',
                'value' => 'LEADERSHIP ACADEMY',
                'created_at' => '2026-01-26 11:04:24',
                'updated_at' => '2026-01-26 11:04:24',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_page_leadership_subtitle',
            ],
            [
                'key' => 'about_page_leadership_subtitle',
                'value' => 'Destiny Life Coaching, Nairobi Leadership Academy offers training that helps develop leaders from within your organization and facilitates a leadership pipeline that brings about peak performance for teams.',
                'created_at' => '2026-01-26 11:04:24',
                'updated_at' => '2026-01-26 11:04:24',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_page_leadership_content',
            ],
            [
                'key' => 'about_page_leadership_content',
                'value' => 'Learn how to make collaboration, teamwork, building consensus, resolving conflicts, communication, influence, and leading change for teams to look and feel effortless.

Discover our core practice of facilitating teams that will reveal to your corporate clients the difference between their current team and one that our process creates. Where everyone becomes a useful tool for progress in the organization.

Find your voice as a leader, and discover how to assist others in doing the same.

You would agree with me that leadership is what makes master coach Jeff Israel Nthiwa who he is if you ever get the chance to meet him in person. His story will motivate and inspire you on how to lead people through difficult times and how to enter any circumstance to make a good change for everyone involved.

Discover what it is that drives people and how to harness the power of influence to bring about transformations that are long-lasting and to realize loftier goals in this life.

Expand your capacity to connect and influence others to make a change in their personal and professional lives. Learn the magic of captivating any audience from the beginning to the end of your presentation and leaving an impression that will last with them for the rest of their lives.

You will learn Nairobi academy to master your leadership style and find new world-class group facilitation techniques that will bring out your leadership traits.',
                'created_at' => '2026-01-26 11:04:24',
                'updated_at' => '2026-01-27 10:46:44',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_page_accreditation_title',
            ],
            [
                'key' => 'about_page_accreditation_title',
                'value' => 'Accreditation',
                'created_at' => '2026-01-26 11:04:24',
                'updated_at' => '2026-01-26 11:04:24',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_page_accreditation_content',
            ],
            [
                'key' => 'about_page_accreditation_content',
                'value' => 'We are accredited by the International Coaches Register and we are in good standing with ICR. We are committed to providing professional and ethical services to our clients. We are dedicated to providing quality life coaching services.',
                'created_at' => '2026-01-26 11:04:24',
                'updated_at' => '2026-01-26 11:04:24',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_image_file',
            ],
            [
                'key' => 'about_section_image_file',
                'value' => 'who-we-are/images/pVZFtnRGMLOgmLZo7uVftRwfWxsf00WiB9PuDMkB.jpg',
                'created_at' => '2026-01-26 11:20:19',
                'updated_at' => '2026-01-27 08:53:22',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_image',
            ],
            [
                'key' => 'about_section_image',
                'value' => '',
                'created_at' => '2026-01-26 11:20:19',
                'updated_at' => '2026-01-27 08:53:22',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_title',
            ],
            [
                'key' => 'about_section_title',
                'value' => 'Empowering Lives Through Expert Coaching',
                'created_at' => '2026-01-26 11:20:19',
                'updated_at' => '2026-01-26 11:20:19',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_subtitle',
            ],
            [
                'key' => 'about_section_subtitle',
                'value' => 'We are a leading coaching organization dedicated to helping individuals unlock their full potential through personalized guidance, proven methodologies, and comprehensive certification programs.',
                'created_at' => '2026-01-26 11:20:19',
                'updated_at' => '2026-01-26 11:20:19',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_description',
            ],
            [
                'key' => 'about_section_description',
                'value' => 'Our mission is to transform lives by providing world-class coaching education and support. With years of experience and a commitment to excellence, we\'ve helped thousands of individuals achieve their personal and professional goals.',
                'created_at' => '2026-01-26 11:20:19',
                'updated_at' => '2026-01-26 11:20:19',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_image_file',
            ],
            [
                'key' => 'about_image_file',
                'value' => 'C:\\Users\\Juliet\\AppData\\Local\\Temp\\php49C5.tmp',
                'created_at' => '2026-01-26 11:20:19',
                'updated_at' => '2026-01-27 08:53:22',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_feature_1_title',
            ],
            [
                'key' => 'about_section_feature_1_title',
                'value' => 'Internationally Certified Programs',
                'created_at' => '2026-01-26 11:20:19',
                'updated_at' => '2026-01-26 11:20:19',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_feature_1_description',
            ],
            [
                'key' => 'about_section_feature_1_description',
                'value' => 'Globally recognized certifications that open doors to new opportunities',
                'created_at' => '2026-01-26 11:20:19',
                'updated_at' => '2026-01-26 11:20:19',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_feature_2_title',
            ],
            [
                'key' => 'about_section_feature_2_title',
                'value' => 'Expert Coaching Team',
                'created_at' => '2026-01-26 11:20:19',
                'updated_at' => '2026-01-26 11:20:19',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_feature_2_description',
            ],
            [
                'key' => 'about_section_feature_2_description',
                'value' => 'Learn from experienced professionals with proven track records',
                'created_at' => '2026-01-26 11:20:19',
                'updated_at' => '2026-01-26 11:20:19',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_feature_3_title',
            ],
            [
                'key' => 'about_section_feature_3_title',
                'value' => 'Proven Results & Success Stories',
                'created_at' => '2026-01-26 11:20:19',
                'updated_at' => '2026-01-26 11:20:19',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_feature_3_description',
            ],
            [
                'key' => 'about_section_feature_3_description',
                'value' => 'Join thousands who have transformed their lives through our programs',
                'created_at' => '2026-01-26 11:20:19',
                'updated_at' => '2026-01-26 11:20:19',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_button_text',
            ],
            [
                'key' => 'about_section_button_text',
                'value' => '',
                'created_at' => '2026-01-26 11:24:46',
                'updated_at' => '2026-01-27 09:19:37',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_section_button_link',
            ],
            [
                'key' => 'about_section_button_link',
                'value' => '',
                'created_at' => '2026-01-26 11:24:46',
                'updated_at' => '2026-01-27 09:19:37',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'google_places_api_key',
            ],
            [
                'key' => 'google_places_api_key',
                'value' => 'AIzaSyCu6tu_Tdevwh211SbTo02QezV5XyRYdj4',
                'created_at' => '2026-01-27 06:22:21',
                'updated_at' => '2026-01-27 07:01:45',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'google_place_id',
            ],
            [
                'key' => 'google_place_id',
                'value' => 'ChIJSU7mASoRLxgRhAC5I9d3vsk',
                'created_at' => '2026-01-27 06:22:21',
                'updated_at' => '2026-01-27 06:22:21',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'logo_file',
            ],
            [
                'key' => 'logo_file',
                'value' => 'settings/cg6Nlx6wXCPOoCIgyhAKtaddHVj78ioUtDtFivPp.jpg',
                'created_at' => '2026-01-27 06:52:58',
                'updated_at' => '2026-01-27 06:52:58',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'favicon_file',
            ],
            [
                'key' => 'favicon_file',
                'value' => 'settings/Xnm7pc8eFZUq7zcqWkUt66bjPBQGddqqyGqxuDKm.jpg',
                'created_at' => '2026-01-27 09:25:51',
                'updated_at' => '2026-01-27 09:25:51',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_page_leadership_image_file',
            ],
            [
                'key' => 'about_page_leadership_image_file',
                'value' => 'about-page/images/ZZZWrKEItrHBJ71QgnzkmV6X2zXwsIuzd80dbrAe.png',
                'created_at' => '2026-01-27 10:46:44',
                'updated_at' => '2026-01-27 10:46:44',
            ]
        );

        Setting::updateOrCreate(
            [
                'key' => 'about_page_leadership_image',
            ],
            [
                'key' => 'about_page_leadership_image',
                'value' => 'about-page/images/ZZZWrKEItrHBJ71QgnzkmV6X2zXwsIuzd80dbrAe.png',
                'created_at' => '2026-01-27 10:46:44',
                'updated_at' => '2026-01-27 10:46:44',
            ]
        );

    }
}
