<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function login()
    {
        if (empty(request()->get('username'))) return ['error' => 'Empty username'];

        $username = request()->get('username');
        $password = request()->get('password');

        $fetched = Admin::where('username', $username)
            //  ->where('password', $password)
             ->first();
        
        // Admin::firstOrCreate([
        //     'first_name' => 'Raldin',
        //     'middle_name' => 'Casidar',
        //     'last_name' => 'Disomimba',
        //     'profile_picture' => 'N/A',
        //     'username' => $username,
        //     'password' => Hash::make($password),
        // ]);

        if (empty($fetched)) return ['error' => 'User not found'];
        if (!Hash::check($password, $fetched->password)) return ['error' => 'Invalid Password'];
        
        // $fetched->success = 1; // Indicate success
        // Remove password from return value

        $session_id = Session::create([
            'admin_id' => $fetched->id
        ]);

        unset($fetched->password); // Remove password from return 
        $fetched->session_id = $session_id->id; 
        return $fetched;
    }

    public function register()
    {
        if (empty(request()->get('username'))) return ['error' => 'Empty username'];

        $username = request()->get('username');
        $password = request()->get('password');
        
        Admin::firstOrCreate([
            'first_name' => 'Raldin',
            'middle_name' => 'Casidar',
            'last_name' => 'Disomimba',
            'profile_picture' => 'N/A',
            'username' => $username,
            'password' => Hash::make($password),
        ]);

        return ['message' => 'User created'];
    }

    public function logout()
    {
        // Check the request header for authorization token
        if (!request()->hasHeader('Authorization')) return ['error' => 'Authorization ID empty'];
        $id = request()->header('Authorization');

        // Check if session exists
        $session = Session::where('id', $id)->delete();

        return ['message' => 'Logged Out'];
    }
}
