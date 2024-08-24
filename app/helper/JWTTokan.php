<?php



namespace App\helper;


use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class JWTTokan{

   public static function createToken($userEmail, $userID){
        $key = env('JWT_KEY');

        $payload = [
            "iss" => "laravel-tokan",
            "iat" => time(),
            "exp" => time() + 60*60*24*30,
            "userEmail" => $userEmail,
            "userID" => $userID
        ];

        return JWT::encode($payload, $key, 'HS256');
   }
   public static function createTokenResetPassword($userEmail, $userID){
        $key = env('JWT_KEY');

        $payload = [
            "iss" => "laravel-tokan",
            "iat" => time(),
            "exp" => time() + 60*60,
            "userEmail" => $userEmail,
            "userID" => $userID
        ];

        return JWT::encode($payload, $key, 'HS256');
   }

   public static function verifyToken($token){
       try{

           if ($token == null){
               return "unauthorized";
           }else{
               $key = env('JWT_KEY');
               $decoded = JWT::decode($token, new Key($key, 'HS256'));
               return $decoded;
           }

       }catch(\Exception $e){

           return "unauthorized";

       }
   }

}
