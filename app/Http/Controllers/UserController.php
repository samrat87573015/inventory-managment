<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\helper\JWTTokan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;

class UserController extends Controller
{



    function register()
    {
        return view('pages.Auth.register');
    }


    function login()
    {
        return view('pages.Auth.login');
    }

    function sendOtpPage()
    {
        return view('pages.Auth.sendOtp');
    }


    function varifyOtpPage()
    {
        return view('pages.Auth.varifyOtp');
    }

    function resetPasswordPage()
    {
        return view('pages.Auth.resetPassword');
    }

    function userProfile(Request $request)
    {

        $email = $request->header('userEmail');

        $data = User::where('email', $email)->first();

        return view('pages.Dashboard.userProfile', compact('data'));
    }





    function userRegistration(Request $request)
    {

        try{

            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => $request->input('password'),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Registration successfully'
            ], 200);

        }

        catch(\Exception $e){

            return response()->json([
                'status' => 'failed',
                'message' => 'Registration failed'
            ], 200);
        }



    }

    function userLogin(Request $request){

        $count = User::where('email', $request->input('email'))
            ->where('password', $request->input('password'))
            ->select('id')->first();

        if($count !== null){

            $tokan =JWTTokan::createToken($request->input('email'),$count->id);

            return response()->json([
                'status' => 'success',
                'message' => 'Login successfully',
            ], 200)->cookie('tokan', $tokan, 3600*24);

        }else{

            return response()->json([
                'status' => 'failed',
                'message' => 'Login failed'
            ], 200);
        }


    }


    function sendOtp(Request $request){

        $email = $request->input('email');
        $otp = rand(1000,9999);

        $count = User::where('email', $email)
            ->count();

            if($count === 1 ){

                //send otp in email
                Mail::to($email)->send(new OTPMail($otp));
                //update otp in database
                User::where('email', $email)->update(['otp' => $otp]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'OTP send successfully',
                ], 200);
            }else{

                return response()->json([
                    'status' => 'failed',
                    'message' => 'OTP send failed',
                ], 200);
            }



    }


    function varifyOtp(Request $request){

        $email = $request->input('email');
        $otp = $request->input('otp');

        $count = User::where('email','=', $email)
            ->where('otp','=', $otp)
            ->select('id')->first();


        if($count !== null){

            User::where('email', $email)->update(['otp' => '0']);

            $tokan =JWTTokan::createTokenResetPassword($email,$count->id);

            return response()->json([
                'status' => 'success',
                'message' => 'OTP verified successfully',
            ], 200)->cookie('tokan', $tokan, 3600);
        }else{

            return response()->json([
                'status' => 'failed',
                'message' => 'OTP verified failed',
            ], 200);
        }
    }


    function resetPassword(Request $request){

        try{

            $email = $request->header('userEmail');
            $password = $request->input('password');

            User::where('email','=', $email)->update(['password' => $password]);

            return response()->json([
                'status' => 'success',
                'message' => 'Reset password successfully',
            ], 200);

        }catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Reset password failed',
            ], 200);
        }

    }


    function logout()
    {
        return redirect('/login')->cookie('tokan', '', -1);

    }


    function getUserProfile(Request $request){

        $email = $request->header('userEmail');
        $user = User::where('email', $email)->first();

        return response()->json([
            'status' => 'success',
            'data' => $user
        ], 200);
    }


    function updateUserProfile(Request $request){
        try{

            $email = $request->header('userEmail');
            $name = $request->input('name');
            $mobile = $request->input('mobile');
            $password = $request->input('password');
            User::where('email', $email)->update(['name' => $name, 'mobile' => $mobile, 'password' => $password]);
            return response()->json([
                'status' => 'success',
                'message' => 'Update user profile successfully',
            ], 200);
        }
        catch(\Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Update user profile failed',
            ], 200);
        }
    }


}
