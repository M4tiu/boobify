<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
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
    protected $redirectTo = '/';

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
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm(Request $request)
    {
        if ($request->has('ref')) {
            session(['referrer' => $request->query('ref')]);
        }

        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if(isset($data['role']) and $data['role']=='model'){
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:30', 'unique:users', 'alpha_dash', 'min:3'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'age' => ['required'],
                'images' => 'required'
            ]);
        }else{
            return Validator::make($data, [
                'name' => ['required', 'string', 'max:30', 'unique:users', 'alpha_dash', 'min:3'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'age' => ['required']
            ]);
        }
        
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        if(isset($data['role'])){
            if($data['role'] == 'model'){
                $img_ids = [];
                foreach ($data['images'] as $img){
                    $file = $img->storeOnCloudinary();
                    array_push($img_ids, $file->getPublicId());
                }
                $img_ids = implode(';', $img_ids);
                return User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'age' => $data['age'],
                    'role' => $data['role'] ?? 'user',
                    'images' => $img_ids,
                    'password' => Hash::make($data['password']),
                ]);
            }
        }
        if(!isset($data['role'])){
            $referrer = User::whereName(session()->pull('referrer'))->first();

                return User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'age' => $data['age'],
                    'role' => $data['role'] ?? 'user',
                    'referrer_id' => $referrer ? $referrer->id : null,
                    'password' => Hash::make($data['password']),
                ]);
            
        }
        
    }
}
