<?php


namespace App\Jobs;

use App\Services\GsmService;
use App\Models\SmsReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSmsJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $number;
    protected $message;

    public function __construct($number, $message)
    {
        $this->number = $number;
        $this->message = $message;
    }

    public function handle(GsmService $gsmService)
    {
        $smsResult = $gsmService->sendSms($this->number, $this->message);
        if ($smsResult) {
            SmsReport::create([
                'user_id' => auth()->user()->id,
                'number' => $this->number,
                'message' => $this->message,
                'send_time' => now(),
            ]);
        }
    }
}
