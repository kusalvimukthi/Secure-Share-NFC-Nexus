<?php

namespace App\Repositories;

use App\Helpers\TokenHelper;
use App\Models\PetTag;
use App\Models\Wallet;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PetTagRepository
{
    public function store($request): JsonResponse
    {
        try {
            $data = $request->all();
            $jsonOutput = $this->getVaccineJson($data);

            $url = null;
            if ($request->hasFile('petAvatar')) {
                $file = $request->file('petAvatar');

                if ($file->isValid()) {
                    $path = $file->store('avatars', 'public');
                    $url = Storage::url($path);
                } else {
                    Log::warning('Invalid file:', ['file' => $file]);
                }

            }

            $request->merge([
                'avatar' => $url,
                'vaccination_details' => $jsonOutput
            ]);
            PetTag::create($request->all());

            return response()->json('Pet Tag Successfully Created');
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json('Pet Tag Creation Failed', 400);
        }

    }
    public function update($request): JsonResponse
    {
        try {
            $data = $request->all();
            $petTag = PetTag::find($request->pet_tag_id);
            $jsonOutput = $this->getVaccineJson($data);
            $url = null;
            if ($request->hasFile('petAvatar')) {
                $file = $request->file('petAvatar');

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

            $request->merge([
                'vaccination_details' => $jsonOutput
            ]);
            $petTag->update($request->all());

            return response()->json('Pet Tag Successfully Updated');
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json('Pet Tag Update Failed', 400);
        }

    }

    public function getVaccineJson($data): string
    {

        $jsonArray = [];

        foreach ($data as $key => $value) {
            if (preg_match('/^(vaccine|vaccination_date|next_vaccination_date)_(\d+)$/', $key, $matches)) {
                $type = $matches[1];
                $index = $matches[2];

                if (!isset($jsonArray[$index])) {
                    $jsonArray[$index] = [];
                }

                $jsonArray[$index][$type] = $value;
            }
        }

        $jsonArray = array_values($jsonArray);
        return json_encode($jsonArray);
    }

    public function getPetTags(): View
    {
        $user = Auth::user();
        $tags = ($user->hasRole('admin')) ? PetTag::get() : PetTag::where('user_id', $user->id)->get();
        return view('pages/pet-tags-list', ['tags' => $tags]);
    }

    public function getSinglePetTag($id): View
    {
        $tag = PetTag::find($id);
        $vaccines = json_decode($tag->vaccination_details);
        $tokenData = [
            'type' => 'pet_tag',
            'id' => $tag->id,
            'view_file' => 'pages/pet-tag'
        ];
        $token = TokenHelper::createToken($tokenData);
        return view('pages/pet-tag', ['tag' => $tag, 'vaccinations' => $vaccines, 'copy_link' => url('/').'/view-pet-tag/'.$token]);
    }

    public function updatePetTagStatus($request): JsonResponse
    {
        $tag = PetTag::find($request->card_id);
        $status = $request->status === 'true';
        $tag->update(['status' => $status]);
        return response()->json('Pet Tag status successfully updated.');
    }

    public function viewPetTagOnGuest($token)
    {
        try {
            $tokenData = TokenHelper::readToken($token);
            $tag = PetTag::find($tokenData['id']);
            if (!$tag->status || $tag->user->userDetail->status != 'true') {
                return view('pages/temporary-disable');
            }
            $vaccines = json_decode($tag->vaccination_details);
            return view('pages/pet-tag', ['tag' => $tag, 'vaccinations' => $vaccines]);
        } catch (\Exception $e) {
            Log::error($e);
            abort(500, 'Something is not right. Please try again');
        }
    }
}
