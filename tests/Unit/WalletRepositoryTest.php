<?php

namespace Tests\Unit;

use App\Helpers\TokenHelper;
use App\Mail\SendOtp;
use App\Models\OtpCode;
use App\Models\User;
use App\Models\Wallet;
use App\Repositories\WalletRepository;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Faker\Factory as Faker;

class WalletRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected WalletRepository $repository;
    protected $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        $this->faker = Faker::create();
        $this->repository = new WalletRepository();
    }

    public function testStoreMethod()
    {
        $request = new Request([
            'user_id' => User::factory()->create()->id,
            'url-1' => 'http://example.com',
            'username-1' => 'testuser',
            'password-1' => 'testpassword',
        ]);

        $response = $this->repository->store($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseHas('wallets', [
            'user_id' => $request->user_id,
        ]);
    }

    public function testUpdateMethod()
    {
        $wallet = Wallet::factory()->create();

        $request = new Request([
            'wallet_id' => $wallet->id,
            'url-1' => 'http://example.com',
            'username-1' => 'updateduser',
            'password-1' => 'updatedpassword',
        ]);

        $response = $this->repository->update($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseHas('wallets', [
            'id' => $wallet->id,
        ]);
    }

    public function testGetSecureWalletsForAdmin()
    {
        $admin = User::factory()->create()->assignRole('admin');
        Auth::shouldReceive('user')->andReturn($admin);

        Wallet::factory()->count(5)->create();

        $response = $this->repository->getSecureWallets();

        $this->assertInstanceOf(View::class, $response);
        $this->assertArrayHasKey('wallets', $response->getData());
    }

    public function testGetSecureWalletsForRegularUser()
    {
        $user = User::factory()->create();
        Auth::shouldReceive('user')->andReturn($user);

        Wallet::factory()->count(5)->create(['user_id' => $user->id]);

        $response = $this->repository->getSecureWallets();

        $this->assertInstanceOf(View::class, $response);
        $this->assertArrayHasKey('wallets', $response->getData());
    }

    public function testGetSingleWalletMethod()
    {
        $wallet = Wallet::factory()->create();
        $encryptedCredentials = Crypt::encryptString(json_encode([
            ['url' => 'http://example.com', 'username' => 'testuser', 'password' => 'testpassword']
        ]));
        $wallet->update(['credentials' => $encryptedCredentials]);

        $response = $this->repository->getSingleWallet($wallet->id);

        $this->assertInstanceOf(View::class, $response);
        $this->assertArrayHasKey('credentials', $response->getData());
        $this->assertArrayHasKey('copy_link', $response->getData());
    }

    public function testUpdateWalletStatus()
    {
        $wallet = Wallet::factory()->create();

        $request = new Request([
            'card_id' => $wallet->id,
            'status' => 'true'
        ]);

        $response = $this->repository->updateWalletStatus($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(1, $wallet->fresh()->status);
    }

    public function testViewSecureWalletOnGuestWithValidToken()
    {
        $user = User::factory()->create();
        $wallet = Wallet::factory()->create(['status' => true, 'user_id' => $user->id]);

        $tokenData = ['id' => $wallet->id];
        $token = TokenHelper::createToken($tokenData);

        $response = $this->repository->viewSecureWalletOnGuest($token);

        $this->assertEquals(302, $response->getStatusCode());  // Assuming it redirects after OTP verification
    }

    public function testViewSecureWalletOnGuestWithInvalidToken()
    {
        $invalidToken = 'invalidtokenstring';

        $response = $this->repository->viewSecureWalletOnGuest($invalidToken);

        $this->assertEquals(500, $response->getStatusCode());
    }

    public function testVerifyOtpSuccess()
    {
        $user = User::factory()->create();
        $otpCode = OtpCode::factory()->create([
            'user_id' => $user->id,
            'otp' => 123456,
            'otp_expires_at' => Carbon::now()->addMinutes(2),
        ]);

        Session::put('otp_verify_user_id', $user->id);
        $request = new Request(['otp' => 123456]);

        $response = $this->repository->verifyOtp($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJson($response->getContent(), ['message' => 'OTP Validated']);
    }

    public function testVerifyOtpExpired()
    {
        $user = User::factory()->create();
        $otpCode = OtpCode::factory()->create([
            'user_id' => $user->id,
            'otp' => 123456,
            'otp_expires_at' => Carbon::now()->subMinutes(1), // Expired OTP
        ]);

        Session::put('otp_verify_user_id', $user->id);
        $request = new Request(['otp' => 123456]);

        $response = $this->repository->verifyOtp($request);

        $this->assertEquals(422, $response->getStatusCode());
    }

    public function testResendOtp()
    {
        $user = User::factory()->create();
        Session::put('otp_verify_user_id', $user->id);

        $response = $this->repository->resendOtp();

        $this->assertEquals(200, $response->getStatusCode());
    }
}
