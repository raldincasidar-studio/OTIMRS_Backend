<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Tourist;
use Illuminate\Support\Facades\Mail;

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

        

        $htmlContent = "<h1>Hello $request->name!</h1><p>Thank you for registering to OTIMRS System and welcome to <b>General Luna</b>! We have made a personalized tour guide for you to check out. Check it out here: <a href='https://localhost:5173/recommender?email=$request->email&name=$request->name'>https://localhost:5173/recommender?email=$request->email&name=$request->name</a></p>";

        Mail::send([], [], function ($message) use ($htmlContent) {
            $message->to('raldin.disomimba13@gmail.com')
                    ->subject('Subject: Welcome to General Luna! From OTIMRS System')
                    ->html($htmlContent);
        });

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

    public function getArrivals(Request $request) {

        $from = Carbon::parse($request->get('from'))->startOfDay();
        $to = Carbon::parse($request->get('to'))->endOfDay();

        $tourists = Tourist::whereBetween('created_at', [$from, $to])->orderBy('id', 'asc')->get();


        return ['success' => 1, 'data' => $tourists];
    }
}
