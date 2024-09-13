<?php

namespace App\Repositories;

use App\Helpers\TokenHelper;
use App\Models\BusinessCard;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpParser\Token;

class BusinessCardRepository
{
    public function store($request): JsonResponse
    {
        $data = $request->all();
        $url = null;
        if ($request->hasFile('businessCardAvatar')) {
            Log::info('File received');
            $file = $request->file('businessCardAvatar');

            if ($file->isValid()) {
                $path = $file->store('avatars', 'public');
                $url = Storage::url($path);
            } else {
                Log::warning('Invalid file:', ['file' => $file]);
            }

            $request->merge([
                'avatar' => $url
            ]);
        }
        $socialLinks = json_encode([
            'web_url' => $request->webLink,
            'portfolio' => $request->portfolio,
            'twitter' => $request->twitter,
            'facebook' => $request->facebook,
            'linkedin' => $request->linkedin,
            'instagram' => $request->instagram,
        ]);
        $request->merge([
            'social_links' => $socialLinks
        ]);
        Log::info(json_encode($data));
        BusinessCard::create($request->all());
        return response()->json('Business card successfully created');
    }
    public function update($request): JsonResponse
    {
        $data = $request->all();
        $url = null;
        if ($request->hasFile('businessCardAvatar')) {
            $file = $request->file('businessCardAvatar');

            if ($file->isValid()) {
                $path = $file->store('avatars', 'public');
                $url = Storage::url($path);
            } else {
                Log::warning('Invalid file:', ['file' => $file]);
            }

            $request->merge([
                'avatar' => $url
            ]);
        }
        $socialLinks = json_encode([
            'web_url' => $request->webLink,
            'portfolio' => $request->portfolio,
            'twitter' => $request->twitter,
            'facebook' => $request->facebook,
            'linkedin' => $request->linkedin,
            'instagram' => $request->instagram,
        ]);
        $request->merge([
            'social_links' => $socialLinks
        ]);
        Log::info(json_encode($data));
        BusinessCard::find($request->card_id)->update($request->all());
        return response()->json('Business card successfully updated');
    }

    public function getBusinessCards(): View
    {
        $user = Auth::user();
        $cards = ($user->hasRole('admin')) ? BusinessCard::get() : BusinessCard::where('user_id', $user->id)->get();
        return view('pages/customer-single', ['cards' => $cards]);
    }

    public function getSingleBusinessCard($id): View
    {
        $card = BusinessCard::find($id);

        $links = json_decode($card->social_links, true);
        $socialLinks = array_filter($links, function($key) use ($links) {
            return in_array($key, ['twitter', 'facebook', 'linkedin', 'instagram']) && !is_null($links[$key]);
        }, ARRAY_FILTER_USE_KEY);

        $tokenData = [
            'type' => 'business_card',
            'id' => $card->id,
            'view_file' => 'pages/businesscard'
        ];
        $token = TokenHelper::createToken($tokenData);
        return view('pages/businesscard', ['card' => $card, 'socialLinks' => $socialLinks, 'links' => $links, 'copy_link' => url('/').'/view-business-card/'.$token]);
    }

    public function updateBusinessCardStatus($request): JsonResponse
    {
        $card = BusinessCard::find($request->card_id);
        $status = $request->status === 'true';
        $card->update(['status' => $status]);
        return response()->json('Business card status successfully updated.');
    }

    public function viewBusinessCardOnGuest($token): View
    {
        try {
            $tokenData = TokenHelper::readToken($token);
            $businessCard = BusinessCard::find($tokenData['id']);
            if (!$businessCard->status || $businessCard->user->userDetail->status != 'true') {
                return view('pages/temporary-disable');
            }
            $links = json_decode($businessCard->social_links, true);
            $socialLinks = array_filter($links, function($key) use ($links) {
                return in_array($key, ['twitter', 'facebook', 'linkedin', 'instagram']) && !is_null($links[$key]);
            }, ARRAY_FILTER_USE_KEY);
            return view('pages/businesscard', ['card' => $businessCard, 'socialLinks' => $socialLinks, 'links' => $links]);
        } catch (\Exception $e) {
            Log::error($e);
            abort(500, 'Something is not right. Please try again.');
        }

    }
}
