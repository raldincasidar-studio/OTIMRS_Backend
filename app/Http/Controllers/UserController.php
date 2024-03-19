<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
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
        
        if (!Hash::check($password, $fetched->password)) return ['error' => 'Invalid Password'];

        return $fetched;
    }
}
