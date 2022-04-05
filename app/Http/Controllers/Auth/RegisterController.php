<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'dob' => ['required', 'date'],
            'designation' => ['required', 'string'],
            'country' => ['required', 'string'],
            'favorite_color' => ['required', 'string'],
            'favorite_actor' => ['required', 'string'],
            'gender' => ['required', 'string'],
        ]);
    }

    protected function create(array $data)
    {
        if(request()->hasfile('profile_pic')){
            $profile = request()->file('profile_pic');
            $profilepic = request()->file('profile_pic')->getClientOriginalExtension();
            $imgName = time().'.'.$profilepic;
            $profile->move('img/avatar', $imgName);
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'dob' => $data['dob'],
            'designation' => $data['designation'],
            'country' => $data['country'],
            'favorite_color' => $data['favorite_color'],
            'favorite_actor' => $data['favorite_actor'],
            'gender' => $data['gender'],
            'profile_pic' => $imgName,
        ]);
    }
}
