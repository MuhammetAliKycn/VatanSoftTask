<?php

namespace App\Http\Controllers\Api\Sms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Response;
use App\Repositories\SmsRepository;
use App\Http\Requests\SmsRequest;
use Illuminate\Support\Facades\Validator;

class SmsController extends Controller
{
    protected $smsRepository;

    public function __construct(SmsRepository $smsRepository)
    {
        $this->smsRepository = $smsRepository;
    }

    public function sendSms(SmsRequest $request)
    {
        return $this->smsRepository->sendSms($request);
    }

    public function getSms(Request $request)
    {
        return $this->smsRepository->getSms($request);
    }

    public function getSmsDetail($id)
    {
        return $this->smsRepository->getSmsDetail($id);
    }
}
