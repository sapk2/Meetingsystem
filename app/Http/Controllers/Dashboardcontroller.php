<?php
namespace App\Http\Controllers;
use Faker\Factory as Faker;
use App\Models\Agendas;
use App\Models\Meeting;
use App\Models\MeetingNotice;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalMeetings = Meeting::count();
        $totalMeetingNotices = MeetingNotice::count();
        $totalAgendas = Agendas::count();

        return view('admin.dashboard', compact('totalUsers', 'totalMeetings', 'totalMeetingNotices', 'totalAgendas'));
    }

    public function userindex()
    {
        $notices = MeetingNotice::all();
        $totalMeetings = Meeting::count(); // or Meeting::all()->count() if you want all meetings
        $faker = Faker::create();
     // Generate fake statistics
     $statistics = [
        ['title' => 'Developers', 'count' => $faker->numberBetween(1000000, 5000000)],
        ['title' => 'Public repositories', 'count' => $faker->numberBetween(50000, 200000)],
        ['title' => 'Open source projects', 'count' => $faker->numberBetween(1000, 5000)],
        ['title' => 'Contributors', 'count' => $faker->numberBetween(500000, 1000000)],
        ['title' => 'Top Forbes companies', 'count' => $faker->numberBetween(50, 200)],
        ['title' => 'Organizations', 'count' => $faker->numberBetween(500000, 2000000)],
    ];

    // Generate fake services
    $services = [
        ['title' => 'Dynamic reports and dashboards', 'description' => $faker->sentence()],
        ['title' => 'Templates for everyone', 'description' => $faker->sentence()],
        ['title' => 'Development workflow', 'description' => $faker->sentence()],
        ['title' => 'Limitless business automation', 'description' => $faker->sentence()],
    ];

    // Generate fake FAQs
    $faqs = [
        [
            'question' => 'What is Flowbite?',
            'answer' => 'Flowbite is an open-source library of interactive components built on top of Tailwind CSS.',
        ],
        [
            'question' => 'Is there a Figma file available?',
            'answer' => 'Yes, Flowbite has a Figma design system based on Tailwind CSS and Flowbite components.',
        ],
        [
            'question' => 'What are the differences between Flowbite and Tailwind UI?',
            'answer' => 'Flowbite is open-source under the MIT license, whereas Tailwind UI is a paid product.',
        ],
    ];

    
        return view('user.dashboard', compact('notices', 'totalMeetings','statistics', 'services', 'faqs'));
    }
    
}
