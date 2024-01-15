<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;
class gsmService
{
    protected $usercode;
    protected $password;
    protected $originator;

    public function __construct()
    {
        $this->usercode = "";
        $this->password = "";
        $this->originator = "";
    }

    public function sendSms($gsm_no)
    {
        // Duruma göre hangi gms service kullanılacaksa ona göre evrilebilir.
        $usercode = "" ;
        $originator = "";
        $password = "";
        $api_url = "";
        $message = "";
        $response = Http::get($api_url, [
            'usercode' => $usercode,
            'password' => $password,
            'gsmno' => $gsm_no,
            'message' => $message,
            'msgheader' => $originator,
            'dil' => 'TR',
        ]);
        return $response->body();
    }
}

