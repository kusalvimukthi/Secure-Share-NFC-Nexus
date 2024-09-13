<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessCardCreateRequest;
use App\Http\Requests\BusinessCardStatusUpdateRequest;
use App\Http\Requests\BusinessCardUpdateRequest;
use App\Models\BusinessCard;
use App\Models\User;
use App\Repositories\BusinessCardRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessCardController extends Controller
{
    protected BusinessCardRepository $businessCard;

    public function __construct(BusinessCardRepository $businessCard)
    {
        $this->businessCard = $businessCard;
    }

    public function getBusinessCardCreatePage(): View
    {
        if (Auth::user()->hasPermissionTo('create_cards')) {
            $customers = User::role('customer')->get();
            return view('pages/business-card-create', ['customers' => $customers]);
        }
        return User::abort(403);
    }

    public function getBusinessCardUpdatePage($id): View
    {
        if (Auth::user()->hasPermissionTo('update_cards')) {
            $card = BusinessCard::find($id);
            $socialLinks = ($card->social_links) ? json_decode($card->social_links) : null;
            return view('pages/business-card-update', ['card' => $card, 'socialLinks' => $socialLinks]);
        }
        return User::abort(403);
    }

    public function store(BusinessCardCreateRequest $request): JsonResponse
    {
        if (Auth::user()->hasPermissionTo('create_cards')) {
            return $this->businessCard->store($request);
        }
        return User::abort(403);
    }

    public function update(BusinessCardUpdateRequest $request): JsonResponse
    {
        if (Auth::user()->hasPermissionTo('update_cards')) {
            return $this->businessCard->update($request);
        }
        return User::abort(403);
    }

    public function getBusinessCards(): View
    {
        return $this->businessCard->getBusinessCards();
    }

    public function getSingleBusinessCard($id): View
    {
        return $this->businessCard->getSingleBusinessCard($id);
    }

    public function updateBusinessCardStatus(BusinessCardStatusUpdateRequest $request): JsonResponse
    {
        return $this->businessCard->updateBusinessCardStatus($request);
    }

    public function viewBusinessCardOnGuest($token)
    {
         return $this->businessCard->viewBusinessCardOnGuest($token);
    }
}
