<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePetTagRequest;
use App\Http\Requests\PetTagStatusUpdateRequest;
use App\Http\Requests\UpdatePetTagRequest;
use App\Models\PetTag;
use App\Models\User;
use App\Repositories\PetTagRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PetTagController extends Controller
{
    protected PetTagRepository $petTag;

    public function __construct(PetTagRepository $petTag)
    {
        $this->petTag = $petTag;
    }

    public function getPetTagCreatePage(): View
    {
        if (Auth::user()->hasPermissionTo('create_pet_tag')) {
            $customers = User::role('customer')->get();
            return view('pages/pet-tag-create', ['customers' => $customers]);
        }
        return User::abort(403);
    }

    public function getPetTagUpdatePage($id): View
    {
        if (Auth::user()->hasPermissionTo('update_pet_tag')) {
            $petTag = PetTag::find($id);
            $vaccinationsData = $petTag->vaccination_details;
            return view('pages/pet-tag-update', ['petTag' => $petTag, 'vaccinations' => json_decode($vaccinationsData)]);
        }
        return User::abort(403);
    }

    public function store(CreatePetTagRequest $request)
    {
        if (Auth::user()->hasPermissionTo('create_pet_tag')) {
            return $this->petTag->store($request);
        }
        return User::abort(403);
    }

    public function update(UpdatePetTagRequest $request)
    {
        if (Auth::user()->hasPermissionTo('update_pet_tag')) {
            return $this->petTag->update($request);
        }
        return User::abort(403);
    }

    public function getPetTags(): View
    {
        return $this->petTag->getPetTags();
    }

    public function getSinglePetTag($id): View
    {
        return $this->petTag->getSinglePetTag($id);
    }

    public function updatePetTagStatus(PetTagStatusUpdateRequest $request): JsonResponse
    {
        return $this->petTag->updatePetTagStatus($request);
    }

    public function viewPetTagOnGuest($token)
    {
        return $this->petTag->viewPetTagOnGuest($token);
    }
}
