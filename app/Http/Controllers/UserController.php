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

        $first_name = request()->get('first_name');
        $middle_name = request()->get('middle_name');
        $last_name = request()->get('last_name');
        $profile_picture = request()->get('profile_picture');
        $username = request()->get('username');
        $password = request()->get('password');
        
        Admin::firstOrCreate([
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'profile_picture' => $profile_picture,
            'username' => $username,
            'password' => Hash::make($password),
        ]);

        return ['message' => 'User created'];
    }

    public function get() {

        $users = Admin::orderBy('id', 'desc')->get();

        return ['success' => 1, 'data' => $users];
    }

    public function getById($id) {

        $user = Admin::find($id);

        if ($user == null) return ['error' => 'User not found'];

        return ['success' => 1, 'data' => $user];
    }

    public function editById($id)
    {
        if (empty(request()->get('first_name')) || empty(request()->get('last_name')) || empty(request()->get('username'))) {
            return ['error' => 'Empty field'];
        }

        $admin = Admin::find($id);

        if ($admin == null) return ['error' => 'User not found'];

        $admin->first_name = request()->get('first_name');
        $admin->middle_name = request()->get('middle_name');
        $admin->last_name = request()->get('last_name');
        $admin->profile_picture = request()->get('profile_picture');
        $admin->username = request()->get('username');
        if (request()->get('password') != null) $admin->password = Hash::make(request()->get('password'));
        $admin->save();

        return ['message' => 'User edited'];
    }


    public function deleteById($id)
    {
        $user = Admin::find($id);

        if ($user == null) return ['error' => 'User not found'];

        // Delete sessions with the admin_id
        Session::where('admin_id', $id)->delete();

        $user->delete();

        return ['message' => 'User deleted'];
    }


    public function logoutSessions($id)
    {
        $user = Admin::find($id);

        if ($user == null) return ['error' => 'User not found'];

        // Delete sessions with the admin_id
        Session::where('admin_id', $id)->delete();

        return ['message' => 'Sessions logged out'];
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
