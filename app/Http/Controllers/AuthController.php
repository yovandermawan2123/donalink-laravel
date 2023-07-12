<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite; //tambahkan library socialite

class AuthController extends Controller
{
    public function index(){
        return view('backend.auth.login', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }
    public function register(){
        return view('backend.auth.register', [
            'title' => 'Register',
            'active' => 'register'
        ]);
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            // 'email' => 'required|email:dns',
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        return back()->with('loginError', 'Login Failed!');
    }   

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        $validated['role_id'] = 2;
        $validated['password'] = Hash::make($validated['password']);


        User::create($validated);

        
        return redirect('/login');
    }   

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
  
  
    //tambahkan script di bawah ini 
    public function handleProviderCallback(Request $request)
    {
        try {
            $user_google    = Socialite::driver('google')->user();
            $user           = User::where('email', $user_google->getEmail())->first();

            //jika user ada maka langsung di redirect ke halaman home
            //jika user tidak ada maka simpan ke database
            //$user_google menyimpan data google account seperti email, foto, dsb

            if($user != null){
                \auth()->login($user, true);
                return redirect('/');
            }else{
                $create = User::Create([
                    'email'             => $user_google->getEmail(),
                    'name'              => $user_google->getName(),
                    'password'          => 'rahasia',
                    'email_verified_at' => now()
                ]);
        
                
                \auth()->login($create, true);
                return redirect('/');
            }

        } catch (\Exception $e) {
            return redirect('/');
        }


    }
}
