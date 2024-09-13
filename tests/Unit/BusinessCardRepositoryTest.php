<?php

namespace Tests\Unit;

use App\Helpers\TokenHelper;
use App\Models\BusinessCard;
use App\Models\User;
use App\Models\UserDetail;
use App\Repositories\BusinessCardRepository;
use Faker\Generator;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Mockery;
use Tests\TestCase;
use Faker\Factory as Faker;


class BusinessCardRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected BusinessCardRepository $repository;
    protected $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        $this->artisan('db:seed');
        $this->faker = Faker::create();
        $this->repository = new BusinessCardRepository();
    }

    public function testStoreMethodWithValidAvatar()
    {
        // Mock dependencies
        Storage::fake('public');

        $file = UploadedFile::fake()->image('avatar.jpg');
        $request = new Request([
            'user_id' => User::factory()->create()->id,
            'cus_email' => $this->faker->email,
            'name' => $this->faker->name,
            'tel_no' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'address' => $this->faker->address,
            'company_name' => $this->faker->name,
            'designation' => $this->faker->text,
            'webLink' => 'http://example.com',
            'portfolio' => 'http://portfolio.com',
            'twitter' => 'http://twitter.com',
            'facebook' => null,
            'linkedin' => 'http://linkedin.com',
            'instagram' => 'http://instagram.com',
        ]);

        $request->files->set('businessCardAvatar', $file);

        $response = $this->repository->store($request);

        $this->assertEquals(200, $response->getStatusCode());
        Storage::disk('public')->assertExists('avatars/' . $file->hashName());
    }

    public function testUpdateMethod()
    {
        $card = BusinessCard::factory()->create();
        Storage::fake('public');

        $file = UploadedFile::fake()->image('new_avatar.jpg');
        $request = new Request([
            'card_id' => $card->id,
            'name' => $this->faker->name,
            'tel_no' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'address' => $this->faker->address,
            'company_name' => $this->faker->name,
            'designation' => $this->faker->text,
            'webLink' => 'http://example.com',
            'portfolio' => 'http://portfolio.com',
            'twitter' => 'http://twitter.com',
            'facebook' => 'http://facebook.com',
            'linkedin' => 'http://linkedin.com',
            'instagram' => 'http://instagram.com',
        ]);
        $request->files->set('businessCardAvatar', $file);
        $response = $this->repository->update($request);

        $this->assertEquals(200, $response->getStatusCode());
        Storage::disk('public')->assertExists('avatars/' . $file->hashName());
    }

    public function testGetBusinessCardsMethodForAdmin()
    {
        // Mock Auth to return an admin user
        $user = User::factory()->create()->assignRole('admin');
        Auth::shouldReceive('user')->andReturn($user);

        $cards = BusinessCard::factory()->count(5)->create();

        $response = $this->repository->getBusinessCards();

        $this->assertInstanceOf(View::class, $response);
        $this->assertArrayHasKey('cards', $response->getData());
    }

    public function testGetSingleBusinessCardMethod()
    {
        $card = BusinessCard::factory()->create();

        $response = $this->repository->getSingleBusinessCard($card->id);

        $this->assertInstanceOf(View::class, $response);
        $this->assertArrayHasKey('socialLinks', $response->getData());
    }

    public function testUpdateBusinessCardStatus()
    {
        $card = BusinessCard::factory()->create();

        $request = new Request([
            'card_id' => $card->id,
            'status' => 'true'
        ]);

        $response = $this->repository->updateBusinessCardStatus($request);

        $this->assertEquals('Business card status successfully updated.', json_decode($response->getContent()));
        $this->assertEquals(1, $card->fresh()->status);
    }

    public function testViewBusinessCardOnGuest()
    {
        // Mock TokenHelper
        $user = User::factory()->create();
        UserDetail::factory()->create(['user_id' => $user->id]);
        $card = BusinessCard::factory()->create(['status' => true, 'user_id' => $user->id]);
        $tokenData = ['id' => $card->id];
        $token = TokenHelper::createToken($tokenData);

        $response = $this->repository->viewBusinessCardOnGuest($token);

        $this->assertInstanceOf(View::class, $response);
    }
}
