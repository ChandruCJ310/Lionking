<?php

namespace App\Http\Controllers;

use App\Models\AdImage1;
use App\Models\AdImage2;
use App\Models\Image2;
use App\Models\Image3;
use App\Models\RegionMember;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Event;
use App\Models\AdImages1;
use App\Models\Banner1000;
use App\Models\Banner10000;
use App\Models\Banner5000;
use App\Models\Image1;
use Illuminate\Support\Facades\View;
use App\Models\BottomBanner;
use App\Models\MemberDetail;
use App\Models\PastEvent;
use Carbon\Carbon;
class WebsiteController extends Controller
{

    
    public function index()
    {
        $images1 = AdImage1::all(); // Fetch images from AdImage1 table
        $images2 = AdImage2::all(); // Fetch images from AdImage2 table
        $image1s = Image1::all(); // Fetch images from image1s table
        $image2s = Image2::all(); // Fetch images from image2s table
        $image3s = Image3::all(); // Fetch images from image3s table
        $events = Event::whereMonth('event_date', now()->month)
              ->whereYear('event_date', now()->year)
              ->orderBy('event_date', 'asc')
              ->get();
        $bottomBanners = BottomBanner::select('image', 'website_link')->get(); // Fetch image and link

        $members = MemberDetail::all(); // Fetch all members from the database
    
        return view('website.index', compact('images1', 'images2', 'image1s', 'image2s', 'image3s','events','bottomBanners','members'));
    }
    
  

    public function getAdBanners()
    {
        // Fetch the latest image from banner_10000
        $topBanner = DB::table('banner_10000')->latest()->value('image_path'); 
    
        // Convert the image path for public access (if necessary)
        $topBannerUrl = $topBanner ? asset('storage/app/public/' . basename($topBanner)) : null;
    
        return view('includes.banner', compact('topBannerUrl'));
    }
    

   public function dgteam()
    {
        $dgTeamMembers = DB::table('dg_team')
            ->join('add_members', 'dg_team.member_id', '=', 'add_members.id')
            ->select(
                'dg_team.position',
                'add_members.first_name',
                'add_members.last_name',
                'add_members.profile_photo',
                'add_members.phone_number',
                'add_members.email_address',
                 'add_members.member_id',
            )
            ->get();
    
        return view('member.teamdg', compact('dgTeamMembers'));
    }


    

    public function intofficer()
    {
        $internationalOfficers = DB::table('internationalofficers')
            ->join('add_members', 'internationalofficers.member_id', '=', 'add_members.id')
            ->select(
                'internationalofficers.position',
                'internationalofficers.year',
                'add_members.first_name',
                'add_members.last_name',
                'add_members.profile_photo',
                'add_members.member_id',
                'add_members.phone_number',
                'add_members.email_address',
            )
            ->get();
    
        return view('member.internationalofficer', compact('internationalOfficers'));
    }
    
    public function districtgovernor()
    {
        // Fetch all districts
        $districts = DB::table('district')->get();
    
        // Fetch all district governors with their member details
        $districtGovernors = DB::table('district_governors')
            ->join('add_members', 'district_governors.member_id', '=', 'add_members.id') // Join members
            ->select(
                'district_governors.*', 
                'add_members.first_name', 
                'add_members.last_name',
                'add_members.email_address', 
                'add_members.phone_number', 
                'add_members.profile_photo',
                'add_members.member_id',
                'add_members.parent_district' // District ID reference
            )
            ->get();
    
        // Group governors by their respective districts
        $groupedGovernors = $districtGovernors->groupBy('parent_district');
    
        return view('member.districtgovernor', compact('districts', 'groupedGovernors'));
    }
    
    


    public function pastdistrictgovernor()
    {
        $pastGovernors = DB::table('past_governors')
            ->join('add_members', 'past_governors.member_id', '=', 'add_members.id')
            ->select(
                'past_governors.position',
                'past_governors.year',
                'add_members.first_name',
                'add_members.last_name',
                'add_members.profile_photo',
                'add_members.member_id',
                'add_members.phone_number',
                 'add_members.email_address'
            )
            ->get();
    
        return view('member.pastdistrictgovernors', compact('pastGovernors'));
    }
    
    
    

    public function districtchairperson()
    {
        $districtChairpersons = DB::table('district_chairpersons')
            ->join('add_members', 'district_chairpersons.member_id', '=', 'add_members.id')
            ->select(
                'district_chairpersons.position',
                'district_chairpersons.year',
                'add_members.first_name',
                'add_members.last_name',
                'add_members.phone_number',
                'add_members.email_address',
                'add_members.profile_photo',
                'add_members.member_id'
            )
            ->get();
    
        return view('member.districtchairperson', compact('districtChairpersons'));
    }
    

    


    public function regionmember()
    {
        $regions = [
            'Region 1' => DB::table('region_members')
                ->join('add_members', 'region_members.member_id', '=', 'add_members.id')
                ->where('region_members.region', 'Region 1')
                ->select(
                    'region_members.position',
                    'region_members.year',
                    'add_members.first_name',
                    'add_members.last_name',
                    'add_members.phone_number',
                    'add_members.email_address',
                    'add_members.profile_photo',
                    'add_members.member_id'
                )
                ->get(),
    
            'Region 2' => DB::table('region_members')
                ->join('add_members', 'region_members.member_id', '=', 'add_members.id')
                ->where('region_members.region', 'Region 2')
                ->select(
                    'region_members.position',
                    'region_members.year',
                    'add_members.first_name',
                    'add_members.last_name',
                    'add_members.phone_number',
                    'add_members.email_address',
                    'add_members.profile_photo',
                    'add_members.member_id'
                )
                ->get(),
    
            'Region 3' => DB::table('region_members')
                ->join('add_members', 'region_members.member_id', '=', 'add_members.id')
                ->where('region_members.region', 'Region 3')
                ->select(
                    'region_members.position',
                    'region_members.year',
                    'add_members.first_name',
                    'add_members.last_name',
                    'add_members.phone_number',
                    'add_members.email_address',
                    'add_members.profile_photo',
                    'add_members.member_id'
                )
                ->get(),
    
            'Region 4' => DB::table('region_members')
                ->join('add_members', 'region_members.member_id', '=', 'add_members.id')
                ->where('region_members.region', 'Region 4')
                ->select(
                    'region_members.position',
                    'region_members.year',
                    'add_members.first_name',
                    'add_members.last_name',
                    'add_members.phone_number',
                    'add_members.email_address',
                    'add_members.profile_photo',
                    'add_members.member_id'
                )
                ->get(),
        ];
    
        return view('member.regionmember', compact('regions'));
    }
    



    public function chapter()
    {
        // Fetch all chapters
        $chapters = DB::table('chapters')->select('id', 'chapter_name')->get();
    
        // Fetch members with their positions and chapter details
        $members = DB::table('club_positions')
            ->join('add_members', 'club_positions.member_id', '=', 'add_members.id')
            ->select(
                'club_positions.position',
                'add_members.id as member_id',
                'add_members.first_name',
                'add_members.last_name',
                'add_members.phone_number',
                'add_members.email_address',
                'add_members.profile_photo',
                'add_members.member_id',
                'add_members.account_name' // This stores the chapter_id
            )
            ->get();
    
        return view('member.chapter', compact('chapters', 'members'));
    }
    
    public function webevents(Request $request)
    {
        $currentDate = Carbon::today();
    
        $completedEvents = Event::where('event_date', '<', $currentDate)
            ->orderBy('event_date', 'asc')
            ->with('pastEvents') // Load past event details correctly
            ->get()
            ->map(function ($event) {
                $pastEvent = $event->pastEvents->first(); // Get the first past event record if available
                $event->venue = $pastEvent->venue ?? 'N/A';
                $event->details = $pastEvent->details ?? 'N/A';
                $event->images = $pastEvent->images ?? [];
                return $event;
            });
    
        $upcomingEvents = Event::where('event_date', '>=', $currentDate)
            ->orderBy('event_date', 'asc')
            ->get();
    
        // Get the 'tab' parameter from the request, default to 'tab2' (Upcoming Events)
        $activeTab = $request->query('tab', 'tab2');
    
        return view('member.webevents', compact('completedEvents', 'upcomingEvents', 'activeTab'));
    }


    public function gallery()
    {
        $completedEvents = PastEvent::all();
    
        // Ensure images are properly formatted
        foreach ($completedEvents as $event) {
            if (!is_array($event->images)) { // Decode only if it's not already an array
                $event->images = json_decode($event->images, true);
            }
        }
    
        return view('member.gallery', compact('completedEvents'));
    }
    
    

}
