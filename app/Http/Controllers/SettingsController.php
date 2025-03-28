<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParentsMultipleDistrict;
use App\Models\District;
use App\Models\Chapter;
use App\Models\MembershipType;
use Illuminate\Support\Facades\DB;


class SettingsController extends Controller
{
    // Display the settings page with districts
    public function index()
    {
        // Fetch all districts for the parent district dropdown
        $ParentsMultipleDistrict = ParentsMultipleDistrict::all(); // This gets all districts from the database
        
        // Pass the districts to the view
        return view('admin.settings', compact('ParentsMultipleDistrict')); // Passing 'districts' variable
    }

    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        // Check if the district name already exists (case-insensitive)
        if (ParentsMultipleDistrict::whereRaw('LOWER(name) = ?', [strtolower($request->name)])->exists()) {
            return redirect()->back()->withErrors(['name' => 'The district name already exists.']);
        }
    
        // Create a new record in the database
        ParentsMultipleDistrict::create([
            'name' => $request->name,
        ]);
    
        // Redirect back to the settings page with a success message
        return redirect()->route('admin.settings')->with('success', 'District added successfully!');
    }
    
    // Store a new district with a parent district

    public function storedistrict(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|array',  
            'name.*' => 'required|string|max:255|distinct', // Ensure distinct values in request
            'parent_district_id' => 'required|exists:parents_multiple_district,id',
        ]);
    
        // Get existing districts under the selected parent
        $existingDistricts = DB::table('district')
            ->where('parent_district_id', $request->parent_district_id)
            ->pluck('name')
            ->map(function ($name) {
                return strtolower(trim($name));
            })
            ->toArray(); // Get existing district names in lowercase
    
        $newDistricts = [];
        foreach ($request->name as $districtName) {
            $normalizedDistrict = strtolower(trim($districtName));
    
            if (!in_array($normalizedDistrict, $existingDistricts) && !in_array($normalizedDistrict, $newDistricts)) {
                $newDistricts[] = $districtName;
            }
        }
    
        if (empty($newDistricts)) {
            return redirect()->route('admin.settings')->with('error', 'Duplicate values are not allowed!');
        }
    
        foreach ($newDistricts as $districtName) {
            DB::table('district')->insert([
                'name' => $districtName,
                'parent_district_id' => $request->parent_district_id,
            ]);
        }
    
        return redirect()->route('admin.settings')->with('success', 'District with parent added successfully!');
    }
    
    

    public function storeAccountNames(Request $request)
    {
        $request->validate([
            'account_names' => 'required|array',
            'account_names.*' => 'required|string|max:255',
        ]);
    
        $existingNames = Chapter::pluck('chapter_name')->map(function ($name) {
            return strtolower($name);
        })->toArray();
    
        $duplicates = [];
        foreach ($request->account_names as $name) {
            if (in_array(strtolower($name), $existingNames)) {
                $duplicates[] = $name;
            } else {
                Chapter::create(['chapter_name' => $name]);
            }
        }
    
        if (!empty($duplicates)) {
            return redirect()->back()->withErrors([
                'account_names' => 'The following account names already exist: ' . implode(', ', $duplicates),
            ]);
        }
    
        return redirect()->route('admin.settings')->with('success', 'Account names added successfully!');
    }
    

    public function storeMembershipTypes(Request $request)
    {
        $request->validate([
            'membership_types' => 'required|array',
            'membership_types.*' => 'required|string|max:255|distinct', // Ensure unique values in request
        ]);
    
        $existingTypes = MembershipType::pluck('name')->map(function ($name) {
            return strtolower(trim($name));
        })->toArray(); // Get existing membership types in lowercase for comparison
    
        $newTypes = [];
        foreach ($request->membership_types as $type) {
            $normalizedType = strtolower(trim($type));
    
            if (!in_array($normalizedType, $existingTypes) && !in_array($normalizedType, $newTypes)) {
                $newTypes[] = $type;
            }
        }
    
        if (empty($newTypes)) {
            return redirect()->route('admin.settings')->with('error', 'Duplicate values are not allowed!');
        }
    
        foreach ($newTypes as $type) {
            MembershipType::create(['name' => $type]);
        }
    
        return redirect()->route('admin.settings')->with('success', 'Membership types added successfully!');
    }
    
    
    
}
