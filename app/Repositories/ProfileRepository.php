<?php
// app/Repositories/ProfileRepository.php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\ResetPasswordEmail;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\UserProfileResource;
use Tymon\JWTAuth\Facades\JWTAuth;
class ProfileRepository
{
    public function login($data)
    {
        if (!Auth::attempt($data)) {
            return [
                'status' => false,
                'message' => 'Email veya şifre hatalı.',
                'data' => (object) [],
            ];
        }
        $user = Auth::user();
        $token = JWTAuth::fromUser($user);
        $data = [
            'token' => $token,
            'user_info' => new UserProfileResource($user),
        ];
        return [
            'status' => true,
            'message' => 'Giriş Başarılı',
            'data' => $data,
        ];
    }

    public function register($request)
    {
        $userData = $this->prepareUserData($request);
        $user = User::create($userData);
        $token = JWTAuth::fromUser($user);
        $data = [
            'token' => $token,
            'user_info' => new UserProfileResource($user),
        ];
        return [
            'status' => true,
            'message' => 'Kayıt Başarılı',
            'data' =>  $data,
        ];
    }
    protected function prepareUserData($request)
    {
        $userData = [
            'username' => $request['username'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => Hash::make($request['password']),
            'type' => '0',
        ];
        if (array_key_exists('image', $request)) {
            $file = $request['image'];
            $imagePath = uploadImage($file, 'users/profile-image');
            if ($imagePath) {
                $userData['image'] = $imagePath;
            }
        }
        return $userData;
    }

}
