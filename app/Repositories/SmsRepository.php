<?php
// app/Repositories/SmsRepository.php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\ResetPasswordEmail;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\UserProfileResource;
use App\Services\gsmService;
use App\Models\SmsReport;
use App\Http\Requests\SmsRequest;
use App\Http\Controllers\Response;
use App\Http\Resources\SmsResource;
use App\Http\Resources\SmsResourceDetail;
use App\Jobs\SendSmsJob;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class SmsRepository
{
    public function sendSms(SmsRequest $request)
    {
        // job ile
        // SendSmsJob::dispatch($number, $message);

        // job üzerinden çalıştırılmaya başlandığında alt taraftaki kodlara gerek kalmaz.
        // örnek send sms işlemi sonrasında işlem true ise devam,
        // $smsResult = $gsmService->sendSms($request->input('number'), $request->input('message'));
        $smsResult = true;
        if ($smsResult) {
            $smsReport = SmsReport::create([
                'user_id' => auth()->user()->id,
                'number' => $request->input('number'),
                'message' => $request->input('message'),
                'send_time' => now(),
            ]);
           return Response::withoutData(true,'sms gönderildi.');
        } else {
           return Response::withoutData(false, 'sms gönderilemedi.');
        }
    }
    public function getSms(Request $request)
    {
        $sendTime = $request->input('send_time');
        $info = SmsReport::where('user_id', auth()->user()->id)
                ->when($sendTime, function ($query) use ($sendTime) {
                    return $query->where('send_time', 'LIKE', $sendTime . '%');
                })
                ->get();
        return Response::withData(true,'Sms raporları listelendi.',SmsResource::collection($info));
    }
    public function getSmsDetail($id)
    {
        try {
            $info = SmsReport::findOrFail($id);
            return Response::withData(true, 'Sms detayı listelendi.', new SmsResourceDetail($info));
        } catch (ModelNotFoundException $e) {
            return Response::withoutData(false, 'Sms detayı bulunamadı.');
        }
    }
}
