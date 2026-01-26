<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    public function index()
    {
        return view('admin.about-page.edit', [
            'settings' => $this->getSettings()
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'about_page_hero_title' => 'nullable|string|max:255',
            'about_page_hero_subtitle' => 'nullable|string|max:500',
            'about_page_introduction_title' => 'nullable|string|max:255',
            'about_page_introduction_content' => 'nullable|string',
            'about_page_mission_title' => 'nullable|string|max:255',
            'about_page_mission_content' => 'nullable|string',
            'about_page_vision_title' => 'nullable|string|max:255',
            'about_page_vision_content' => 'nullable|string',
            'about_page_leadership_title' => 'nullable|string|max:255',
            'about_page_leadership_subtitle' => 'nullable|string|max:500',
            'about_page_leadership_content' => 'nullable|string',
            'about_page_leadership_image' => 'nullable|url|max:500',
            'about_page_accreditation_title' => 'nullable|string|max:255',
            'about_page_accreditation_content' => 'nullable|string',
        ]);

        // Save all settings to database
        foreach ($validated as $key => $value) {
            Setting::set($key, $value ?? '');
        }

        return redirect()->route('admin.about-page.index')
            ->with('success', 'About page updated successfully!');
    }

    private function getSettings()
    {
        return [
            'about_page_hero_title' => Setting::get('about_page_hero_title', 'ABOUT US'),
            'about_page_hero_subtitle' => Setting::get('about_page_hero_subtitle', 'Empowering lives through expert coaching and professional development'),
            'about_page_introduction_title' => Setting::get('about_page_introduction_title', 'Introduction'),
            'about_page_introduction_content' => Setting::get('about_page_introduction_content', 'Destiny Life Coaching is here to enable agents of change to become world-class practitioners of transformative coaching excellence who will positively influence Africa and the world using the results-based transformational approach to life coaching.'),
            'about_page_mission_title' => Setting::get('about_page_mission_title', 'Mission'),
            'about_page_mission_content' => Setting::get('about_page_mission_content', 'Develop transformative soul-based practitioners of coaching and speaking excellence through soul-based immersion coaching experience, exposure to cutting-edge transformational tools, collaborative practice, research, and innovative contribution to humanity.'),
            'about_page_vision_title' => Setting::get('about_page_vision_title', 'Vision'),
            'about_page_vision_content' => Setting::get('about_page_vision_content', 'DLC is a world class center for transformational life success. This is dedicated to excellence in life coaching, transformational Leadership Academy, and transformative speaker training which is distinguished by high-quality, value-based training that is also transformative.'),
            'about_page_leadership_title' => Setting::get('about_page_leadership_title', 'LEADERSHIP ACADEMY'),
            'about_page_leadership_subtitle' => Setting::get('about_page_leadership_subtitle', 'Destiny Life Coaching, Nairobi Leadership Academy offers training that helps develop leaders from within your organization and facilitates a leadership pipeline that brings about peak performance for teams.'),
            'about_page_leadership_content' => Setting::get('about_page_leadership_content', 'Learn how to make collaboration, teamwork, building consensus, resolving conflicts, communication, influence, and leading change for teams to look and feel effortless.

Discover our core practice of facilitating teams that will reveal to your corporate clients the difference between their current team and one that our process creates. Where everyone becomes a useful tool for progress in the organization.

Find your voice as a leader, and discover how to assist others in doing the same.

You would agree with me that leadership is what makes master coach Jeff Israel Nthiwa who he is if you ever get the chance to meet him in person. His story will motivate and inspire you on how to lead people through difficult times and how to enter any circumstance to make a good change for everyone involved.

Discover what it is that drives people and how to harness the power of influence to bring about transformations that are long-lasting and to realize loftier goals in this life.

Expand your capacity to connect and influence others to make a change in their personal and professional lives. Learn the magic of captivating any audience from the beginning to the end of your presentation and leaving an impression that will last with them for the rest of their lives.

You will learn Nairobi academy to master your leadership style and find new world-class group facilitation techniques that will bring out your leadership traits.'),
            'about_page_leadership_image' => Setting::get('about_page_leadership_image', ''),
            'about_page_accreditation_title' => Setting::get('about_page_accreditation_title', 'Accreditation'),
            'about_page_accreditation_content' => Setting::get('about_page_accreditation_content', 'We are accredited by the International Coaches Register and we are in good standing with ICR. We are committed to providing professional and ethical services to our clients. We are dedicated to providing quality life coaching services.'),
        ];
    }
}
