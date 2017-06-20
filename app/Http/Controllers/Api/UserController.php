<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use App\User;
class UserController extends Controller
{
   public function authenticate(Request $request){
     $credentials=$request->only('email','password');
     try {
       \Config::set('auth.providers.users.model', \App\User::class);
       \Config::set('auth.providers.users.table', 'users');
       \Config::set('jwt.user', \App\User::class);
       if (!$token =JWTAuth::attempt($credentials)) {
          return response()->json(['error'=>'Invalid_Crendals'],401);
       }

     } catch (JWTException $e) {
       return response()->json(['error' => 'could_not_create_token'], 500);
     }
     return response()->json(['toke Login User'=>compact('token'),'msg'=>'User :D Vamos Bien']);
   }
   public function register(){
     $email=request()->email;
     $name=request()->name;
     $password=request()->password;
     $user=User::create([
       'name'=>$name,
       'email'=>$email,
       'password'=>bcrypt($password),
     ]);
     \Config::set('auth.providers.users.model', \App\User::class);
     \Config::set('auth.providers.users.table', 'users');
     \Config::set('jwt.user', \App\User::class);
     $token=JWTAuth::fromUser($user);
     return response()->json(['token'=>$token],200);
   }

   public function testd(){

     try {
       \Config::set('auth.providers.users.model', \App\User::class);
       \Config::set('auth.providers.users.table', 'users');
       \Config::set('jwt.user', \App\User::class);

       $token=JWTAuth::getToken();
       $driver=JWTAuth::toUser($token);

     } catch (JWTException $e) {
        return response()->json(['error' => 'could_not__User_create_token'], 500);
     }
     return response()->json($driver);

   }

}
