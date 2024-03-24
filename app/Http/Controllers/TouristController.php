<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tourist;

class TouristController extends Controller
{
    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'location' => 'required',
            'days' => 'required|string',
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'required',
            'gender' => 'required|string',
            'birthdate' => 'required|date',
            'address' => 'required',
            'nationality' => 'required',
        ]);

        $tourist = Tourist::updateOrCreate($validatedData);

        $tourist->success = 1;
        $tourist->message = 'Successfuly added!';
        return $tourist;
    }

    public function get(Request $request)
    {
        $tourists = Tourist::orderBy('id', 'desc')->get();

        return ['success' => 1, 'data' => $tourists];
    }

    public function person(Request $request, string $id)
    {
        $tourists = Tourist::where('id', $id)->first();

        return ['success' => 1, 'data' => $tourists];
    }
}
