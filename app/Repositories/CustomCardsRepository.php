<?php

namespace App\Repositories;

use App\Helpers\TokenHelper;
use App\Models\CustomCard;
use App\Models\Wallet;
use Carbon\Carbon;
use Cassandra\Custom;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CustomCardsRepository
{
    public function store($request): JsonResponse
    {
        CustomCard::create($request->except(['name', 'email', 'tel_no']));
        return response()->json('Custom Card Successfully Created');
    }
    public function update($request): JsonResponse
    {
        $customCard = CustomCard::find($request->card_id);
        $customCard->update($request->except(['card_id']));
        return response()->json('Custom Card Successfully Updated');
    }

    public function getCustomCards(): View
    {
        $user = Auth::user();
        $cards = ($user->hasRole('admin')) ? CustomCard::get() : CustomCard::where('user_id', $user->id)->get();
        return view('pages/custom-cards-list', ['cards' => $cards]);
    }

    public function getSingleCustomCard($id): View
    {
        $customCard = CustomCard::find($id);
        $tokenData = [
            'type' => 'custom_card',
            'id' => $customCard->id,
            'view_file' => 'pages/customize-card'
        ];
        $token = TokenHelper::createToken($tokenData);

        return view('pages/customize-card', ['customCard' => $customCard, 'copy_link' => url('/').'/view-custom-card/'.$token]);
    }

    public function updateCustomCardStatus($request): JsonResponse
    {
        $card = CustomCard::find($request->card_id);
        $status = $request->status === 'true';
        $card->update(['status' => $status]);
        return response()->json('Custom card status successfully updated.');
    }

    public function viewCustomCardOnGuest($token)
    {
        try {
            $tokenData = TokenHelper::readToken($token);
            $customCard = CustomCard::find($tokenData['id']);
            if (!$customCard->status || $customCard->user->userDetail->status != 'true') {
                return view('pages/temporary-disable');
            }
            return redirect()->to($customCard->url);
        } catch (\Exception $e){
            Log::error($e);
            abort(500, 'Something is not right. Please try again');
        }
    }
}
