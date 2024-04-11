<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TouristAttraction;
use Illuminate\Support\Facades\Validator;


class TouristAttractionController extends Controller
{
    //
    public function add(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'opening_hours' => 'nullable|string|max:255',
            'admission_fee' => 'nullable|string|max:255',
            'image_url' => 'required|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'contact_phone' => 'nullable|string',
            'contact_email' => 'nullable|email|max:255',
            // Add more validation rules for other fields if needed
        ]);

        // Create a new tourist attraction instance
        $touristAttraction = TouristAttraction::create($validatedData);

        // Return success response
        return ['success' => 1, 'data' => $touristAttraction];
    }

    public function update(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'opening_hours' => 'nullable|string|max:255',
            'admission_fee' => 'nullable|string|max:255',
            'image_url' => 'required|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'contact_phone' => 'nullable|string',
            // Add more validation rules for other fields if needed
        ]);

        // Find the tourist attraction to update
        $touristAttraction = TouristAttraction::find($request->id);

        // Update the attributes
        $touristAttraction->update($validatedData);

        // Return success response
        return ['success' => 1, 'data' => $touristAttraction];
    }

    public function delete(Request $request)
    {

        // Find the tourist attraction to delete
        $touristAttraction = TouristAttraction::find($request->id);

        // Delete the attraction
        $touristAttraction->delete();

        // Return success response
        return ['success' => 1, 'message' => 'Deleted successfuly!'];
    }

    // Get all tourist attractions
    public function get(Request $request)
    {
        $touristAttractions = TouristAttraction::orderBy('id', 'desc')->get();

        return ['success' => 1, 'data' => $touristAttractions];
    }

    
    // Get tourist attractions only
    public function getAttraction(Request $request)
    {

        $attractions = [
        // 'Hotel',
        // 'Restaurant',
        'Museum',
        'Beach',
        'Landmark',
        'Statue',
        'Theme Park',
        'Cinema',
        'Shopping Mall',
        'Gallery',
        'Natural Attraction',
        ];

        $touristAttractions = TouristAttraction::orderBy('id', 'desc')->whereIn('category', $attractions)->get();

        return ['success' => 1, 'data' => $touristAttractions];
    }
    
    // Get tourist acommodation only
    public function getAcommodation(Request $request)
    {

        $acommodation = [
        'Hotel',
        'Restaurant',
        // 'Museum',
        // 'Beach',
        // 'Landmark',
        // 'Statue',
        // 'Theme Park',
        // 'Cinema',
        // 'Shopping Mall',
        // 'Gallery',
        // 'Natural Attraction',
        ];

        $touristAttractions = TouristAttraction::orderBy('id', 'desc')->whereIn('category', $acommodation)->get();

        return ['success' => 1, 'data' => $touristAttractions];
    }

    public function getOne(Request $request)
    {
        $id = $request->id;

        $touristAttractions = TouristAttraction::find($id);

        return ['success' => 1, 'data' => $touristAttractions];
    }
}
