<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use App\Services\Upload\UploadService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use File;

class AuthApiController extends Controller
{
    public function login(Request $request){
        $validate = Validator::make($request->all(), [
            'mobile' => 'required',
            'password' => 'required',
        ]);

        if ($validate->fails()) {
            $response = [
                'status' => 'Failed',
                'message' => 'Input Fill Required'
            ];
            
            return response()->json($response, 200);
            
        } else {
         

            // $member = Member::where('mobile', $request->mobile)->where('is_otp_verify', 1)->first();
            $user = User::where('mobile', $request->mobile)->first();
            if ($user != null) {
                if (!Hash::check($request->password, $user->password, [])) {
                    // throw new Exception('Error in Login, Wrong Password Detected');
                    $response = [
                        'statusCode' => 400,
                        'message' => 'Gagal, Nomor telephone atau Password yang anda masukan salah!',
                     ];
                    return response()->json($response, 400);
                }
    
                $tokenResult = $user->createToken('token-auth')->plainTextToken;
                // $response = [
                //     'status' => 'Success',
                //     'message' => 'Login Success',
                //     'content' => [
                //         'status_code' => 200,
                //         'access_token' => $tokenResult,
                //         'token_type' => 'Bearer'
                //     ]
    
                // ];
    
                
                $response = [
                    'statusCode' => 200,
                    'message' => 'Login Success',
                    'body' => [
                        'data' => $user,
                        'access_token' => $tokenResult,
                        'token_type' => 'Bearer'
                    ]
                ];
                return response()->json($response, 200);

            } else {
                $response = [
                    'statusCode' => 400,
                     'message' => 'Akun anda belum terdaftar di sistem kami, silahkan melakukan registrasi terlebih dahulu',
                 ];
                 return response()->json($response, 400);
            }
          

            
            

        }
    }


    public function store(Request $request)
    {
        
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'password' => 'required', 'min:5', 'max:255'
        ]);
        

        if ($validate->fails()) {

            $response = [
                'status' => 'Failed',
                'message' => 'Fill Required Input',
               
            ];
            return response()->json($response,200); 
      
        }
        $hashedPassword = Hash::make($request->password);
      
        try {
            $register = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => $hashedPassword,
                'image' => "avatar.png",
                'role_id' => 2,
            ]);
        
         $response = [
            'statusCode' => 200,
             'message' => 'Register Success',
             'body' => $register
         ];


         return response()->json($response, 200);
       
         } catch (Exception $e) {
             return response()->json([
                 'message' => "Failed" . $e
             ]);
        }
    }

    public function profile($id)
    {
        $user = User::where('id', $id)->get();
        $response = [
            'statusCode' => 200,
            'body' => $user
        ];

        return response()->json($response, 200);
    }

    public function logout(Request $request){
        $validate = Validator::make($request->all(), [
            'mobile' => 'required',
        ]);
        if ($validate->fails()) {
            $response = [
                'status' => 'Failed',
                'message' => 'Input Fill Required'
            ];
            
            return response()->json($response, 200);
            
        } else {
        $user = User::where('mobile', $request->mobile)->first();
        $user->tokens()->delete();
        $response = [
            'statusCode' => 200,
             'message' => 'You already logged out',
         ];

        }
        
         return response()->json($response, 200);
    }

    public function profileUpdate(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'name' => 'required',
            // 'image' => 'image',
        ]);

        if ($request->file('image')) {

            $img_name = $request->file('image')->getClientOriginalName();
            $filename = User::select('image')->where('id', $request->id)->first();
            if ($filename->image != "avatar.png" && File::exists(public_path('profile_pictures/' . $filename->image))) {
                File::delete(public_path('profile_pictures/' . $filename->image));
            } else {
                print('File does not exists.');
            }

            $file = (new UploadService())->saveFile($request->file('image'), 'profile_pictures', $request->file('image')->getClientOriginalName());
        }

        if ($validate->fails()) {
            $response = [
                'status' => 'Failed',
                'message' => 'Input Fill Required'
            ];

            return response()->json($response, 200);
        } else {
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->image = isset($request->image) ? $img_name : $user->image;
            $user->email = isset($request->email) ? $request->email : $user->email;
            $user->address = isset($request->address) ? $request->address : '';
            $user->mobile = isset($request->mobile) ? $request->mobile : $user->mobile;
            $user->update();

            $response = [
                'statusCode' => 200,
                'message' => 'Update Profile Success !',
                'body' => $user,
            ];
        }

        return response()->json($response, 200);
    }
}
