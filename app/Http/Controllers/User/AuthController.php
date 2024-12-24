<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\user\createUser;
use App\Http\Requests\user\loginUser;
use App\Http\Requests\user\ForgotRequest;
use App\Http\Requests\user\ResetPass;
use App\Models\User;
use resetPassword;
use Hash;
use Auth;
use Mail;
use DB;
class AuthController extends Controller
{
    public function register(createUser $request)
        {
        $validatedData=$request->validated();
        $user=User::create([
            'name'=>$validatedData['name'],
            'email'=>$validatedData['email'],
            'password'=>Hash::make($validatedData['password']),
        ]);
        return response()->json(['msg'=>'successfully']);
        }
        
        public function login( loginUser $request){
            $user = User::where('email', $request->input('email'))->first();
            if (! $user ) {
                return response()->json(['msg' => 'error']);
            }
            $token = $user->createToken('api of token', [$user->name])->plainTextToken;
            return response()->json(['token' => $token]);
        }
        public function logout(){
            $user= Auth::user();
            
        Auth::logout();
            return response()->json(['msg'=>'deleted successfully']);
        }

        public function forgotPassword(ForgotRequest  $request){
            $validatedData=$request->validated();
        
        $isEmail = filter_var($request->identifier, FILTER_VALIDATE_EMAIL);
        $user = $isEmail
            ? User::where('email', $request->identifier)->first()
            : User::where('phone', $request->identifier)->first();
        
        if (!$user) {
            return response()->json(['message' => 'المستخدم غير موجود'], 404);
        }
        
        $code = mt_rand(1000, 9999);
        $code = str_pad($code, 4, '0', STR_PAD_LEFT);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $isEmail ? $user->email : $user->phone],
            [
                'token' => $code,
                'created_at' => now()
            ]
        );
        
        if ($isEmail) {
            Mail::raw("رمز إعادة تعيين كلمة المرور الخاص بك هو: $code", function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('رمز إعادة تعيين كلمة المرور');
            });
            return response()->json(['message' => 'تم إرسال رمز إعادة تعيين كلمة المرور إلى بريدك الإلكتروني']);
        } else {
            $user->notify(new resetPassword($code));
            return response()->json(['message' => 'تم إرسال رمز إعادة تعيين كلمة المرور إلى هاتفك']);
        }  
        }


        public function resetPassword( ResetPass  $request){

            $isEmail = filter_var($request->identifier, FILTER_VALIDATE_EMAIL);
            $resetEntry = DB::table('password_reset_tokens')
                ->where($isEmail ? 'email' : 'email', $request->identifier)
                ->where('token', $request->code)
                ->first();
            
            if (!$resetEntry) {
                return response()->json([
                    'message' => 'رمز غير صالح',
                ], 404);
            }
            
            $user = $isEmail
                ? User::where('email', $request->identifier)->first()
                : User::where('phone', $request->identifier)->first();
            
            $user->password = Hash::make($request->password);
            $user->save();
            
            DB::table('password_reset_tokens')->where($isEmail ? 'email' : 'email', $request->identifier)->delete();
            return response()->json(['message' => 'تم إعادة تعيين كلمة المرور بنجاح']);
        }
        




        // public function verifyEmail(Request $request){
        //     $request->validate([
        //         'email' => 'required|email',
        //         'verification_code' => 'required|numeric',
        //     ]);
        //     $user = User::where('email', $request->email)
        //                 ->where('verification_code', $request->verification_code)
        //                 ->first();
        //     if (!$user) {
        //         return response()->json( 'Invalidcode or email');
        //     }
        //     $user->verified_at = now();
        //     $user->verification_code = null;
        //     $user->save();
        //     return response()->json(['message' => 'Email verified successfully']);    
        // }


}

