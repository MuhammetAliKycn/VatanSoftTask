<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Response;
use App\Repositories\ProfileRepository;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Validator;
class LoginController extends Controller
{
    protected $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function login(AuthRequest $request)
    {

        $result = $this->profileRepository->login($request->validated());
        return $result['status']
            ? Response::withData($result['status'], $result['message'], $result['data'])
            : Response::withoutData($result['status'], $result['message']);
    }
    public function register(AuthRequest $request)
    {
        $result = $this->profileRepository->register($request->validated());
        if ($result['status']) {
            return Response::withData(true, $result['message'], $result['data']);
        } else {
            return Response::withoutData(false, $result['message'], $result['data']);
        }
    }
}
