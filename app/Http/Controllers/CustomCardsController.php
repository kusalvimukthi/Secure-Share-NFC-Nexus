<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomCardCreateRequest;
use App\Http\Requests\CustomCardStatusUpdateRequest;
use App\Http\Requests\CustomCardUpdateRequest;
use App\Models\CustomCard;
use App\Models\User;
use App\Repositories\CustomCardsRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomCardsController extends Controller
{
    protected CustomCardsRepository $customCard;

    public function __construct(CustomCardsRepository $customCard)
    {
        $this->customCard = $customCard;
    }

    public function getCustomCardCreatePage(): View
    {
        if (Auth::user()->hasPermissionTo('create_custom_card')) {
            $customers = User::role('customer')->get();
            return view('pages/customize-card-create', ['customers' => $customers]);
        }
        return User::abort(403);
    }

    public function getCustomCardUpdatePage($id): View
    {
        if (Auth::user()->hasPermissionTo('update_custom_card')) {
            $customCard = CustomCard::find($id);
            return view('pages/customize-card-update', ['customCard' => $customCard]);
        }
        return User::abort(403);
    }

    public function store(CustomCardCreateRequest $request): JsonResponse
    {
        if (Auth::user()->hasPermissionTo('create_custom_card')) {
            return $this->customCard->store($request);
        }
        return User::abort(403);
    }

    public function update(CustomCardUpdateRequest $request): JsonResponse
    {
        if (Auth::user()->hasPermissionTo('update_custom_card')) {
            return $this->customCard->update($request);
        }
        return User::abort(403);
    }

    public function getCustomCards(): View
    {
        return $this->customCard->getCustomCards();
    }

    public function getSingleCustomCard($id): View
    {
        return $this->customCard->getSingleCustomCard($id);
    }

    public function updateCustomCardStatus(CustomCardStatusUpdateRequest $request): JsonResponse
    {
        return $this->customCard->updateCustomCardStatus($request);
    }

    public function viewCustomCardOnGuest($token): Application|View|Factory|RedirectResponse|null
    {
        return $this->customCard->viewCustomCardOnGuest($token);
    }
}
