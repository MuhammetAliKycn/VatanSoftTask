<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'number',
        'message',
        'send_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
