<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\SmsReport;
use App\Repositories\SmsRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SmsRepositoryTest extends TestCase
{
    use RefreshDatabase;
    public function test_send_sms()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $smsRequest = [
            'number' => '5551234567',
            'message' => 'Test message',
        ];

        $response = app(SmsRepository::class)->sendSms(new \App\Http\Requests\SmsRequest($smsRequest));
        $responseArray = json_decode($response->getContent(), true);

        $this->assertTrue($responseArray['status']);
        $this->assertEquals('sms gönderildi.', $responseArray['message']);
    }

    public function test_get_sms()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        SmsReport::factory(3)->create(['user_id' => $user->id]);

        $response = app(SmsRepository::class)->getSms(request());
        $responseArray = json_decode($response->getContent(), true);

        $this->assertTrue($responseArray['status']);
        $this->assertEquals('Sms raporları listelendi.', $responseArray['message']);
        $this->assertCount(3, $responseArray['data']);
    }

    public function test_get_sms_detail()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $smsReport = SmsReport::factory()->create(['user_id' => $user->id]);
        $response = app(SmsRepository::class)->getSmsDetail($smsReport->id);
        $responseArray = json_decode($response->getContent(), true);

        $this->assertTrue($responseArray['status']);
        $this->assertEquals('Sms detayı listelendi.', $responseArray['message']);
    }


}

