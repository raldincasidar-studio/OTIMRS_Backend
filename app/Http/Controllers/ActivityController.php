<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Activity;

class ActivityController extends Controller
{
    //
    public function get(Request $request) {

        $activities = Activity::orderBy('due_date', 'asc')->get();

        return [
            'success' => 1,
            'message' => 'activities retrieved successfully',
            'data' => $activities
        ];
    }

    public function getOne($id) {

        $activity = Activity::findOrFail($id);

        return [
            'success' => 1,
            'message' => 'activity retrieved successfully',
            'data' => $activity
        ];
    }

    public function delete($id) {

        $activity = Activity::findOrFail($id);
        $activity->delete();

        return [
            'success' => 1,
            'message' => 'Activity deleted successfully',
        ];
    }
    public function add(Request $request) {

        // validate request and add it to Activity table
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'due_date' => 'required|date',
            'cost' => 'nullable|numeric',
            'capacity' => 'nullable|integer',
            'rating' => 'nullable|integer|min:0|max:5',
            'image_url' => 'required|url',
            'contact_number' => 'nullable|string',
        ]);

        Activity::create($validatedData);

        return [
            'success' => 1,
            'message' => 'Successfuly added!'
        ];
    }

    public function edit(Request $request, $id) {

        // validate request and edit Activity with id
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'location' => 'required',
            'due_date' => 'required|date',
            'cost' => 'nullable|numeric',
            'capacity' => 'nullable|integer',
            'rating' => 'nullable|integer|min:0|max:5',
            'image_url' => 'required|url',
            'contact_number' => 'nullable|string',
        ]);

        Activity::findOrFail($id)->update($validatedData);

        return [
            'success' => 1,
            'message' => 'Successfully edited!'
        ];
    }
}
