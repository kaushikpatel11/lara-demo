<?php

namespace App\Http\Controllers\Auth;
use App\Genre;
use App\User;
use App\booker_type;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\StoreUser;

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
    protected $redirectTo = '/home';

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
     * Create a new controller instance.
     *
     * @return Response
     */
    public function register(StoreUser $request)
{
   $validated = $request->validated();
    $user = User::create($validated);
    $user->save();
    $genre = new genre();
    $user->genres()->attach([1]);
   // $booker_type->Where('type','booker_type')->get();
    //$user->bookerType()->attach();
    
    //$user->genres()->attach([1]);
      /*$user = new User();
    //$genre = new genre();
    $user->fname = $request->input('fname');
    $user->lname = $request->input('lname');
    $user->status =$request->input('status');
    $user->role = $request->input('role');
    //$user->booker_type = $request->input('booker_type');
    $user->email = $request->input('email');
    $user->password = $request->input('password');
    $user->save();
    $user->genres();*/
    

    return response()->json(['status'=>'SUCCESS','server_message'=>'ACCOUNT_CREATED',
    'user_message'=>'Your account has been created successfully'], 201);
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
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'booker_type' => $data['booker_type'],
            'role' => $data['role'],
            'status' => $data['status'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
            
            
        ]);
    }
    /*public function index()
    {
        $genres = user::find(1)->genres;
        return $genres;
    }*/
}
