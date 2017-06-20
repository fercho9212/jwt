<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use App\Driver;
class DriverController extends Controller
{
    public function __construct(){

    }
    public function authenticate(Request $request){
      $credentials=$request->only('email','password');
      try {
        \Config::set('auth.providers.users.model', \App\Driver::class);
        \Config::set('auth.providers.users.table', 'drivers');
        \Config::set('jwt.user', \App\Driver::class);
        if (!$token =JWTAuth::attempt($credentials)) {

           return response()->json(['error'=>'Invalid_Crendals'],401);
        }

      } catch (JWTException $e) {
        return response()->json(['error' => 'could_not_create_token'], 500);
      }
      return response()->json(['token Login Driver'=>compact('token'),'msg'=>'driver']);
    }
    public function register(){
      $email=request()->email;
      $name=request()->name;
      $last=request()->last;
      $password=request()->password;
      $driver=Driver::create([
        'name'=>$name,
        'email'=>$email,
        'last'=>$last,
        'password'=>bcrypt($password),
      ]);
      \Config::set('auth.providers.users.model', \App\Driver::class);
      \Config::set('auth.providers.users.table', 'drivers');
      \Config::set('jwt.user', \App\Driver::class);
      $token=JWTAuth::fromUser($driver);
      return response()->json(['token Driver'=>$token],200);
    }

    public function testd(){

      try {
        \Config::set('auth.providers.users.model', \App\Driver::class);
        \Config::set('auth.providers.users.table', 'drivers');
        \Config::set('jwt.user', \App\Driver::class);

        $token=JWTAuth::getToken();
        $driver=JWTAuth::toUser($token);

      } catch (JWTException $e) {
         return response()->json(['error' => 'could_not_create_token'], 500);
      }
      return response()->json($driver);

    }

}
