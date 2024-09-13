<?php

namespace App\Repositories;

use App\Helpers\TokenHelper;
use App\Models\StorageTag;
use App\Models\Wallet;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class StorageTagRepository
{
    public function store($request): JsonResponse
    {
        try {
            $url = null;
            if ($request->hasFile('storageAvatar')) {
                Log::info('File received');
                $file = $request->file('storageAvatar');

                if ($file->isValid()) {
                    $path = $file->store('avatars', 'public');
                    $url = Storage::url($path);
                } else {
                    Log::warning('Invalid file:', ['file' => $file]);
                }

            }
            $request->merge(['avatar' => $url]);
            StorageTag::create($request->all());
            return response()->json('Storage Tag Successfully Created');
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json('Storage Tag Creation Failed', 400);
        }

    }
    public function update($request): JsonResponse
    {
        try {
            $storageTag = StorageTag::find($request->storage_tag_id);
            $url = null;
            if ($request->hasFile('storageAvatar')) {
                $file = $request->file('storageAvatar');

                if ($file->isValid()) {
                    $path = $file->store('avatars', 'public');
                    $url = Storage::url($path);
                } else {
                    Log::warning('Invalid file:', ['file' => $file]);
                }
                $request->merge(['avatar' => $url]);
            }
            $storageTag->update($request->all());
            return response()->json('Storage Tag Successfully Updated');
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json('Storage Tag Update Failed', 400);
        }

    }

    public function getStorageTags(): View
    {
        $user = Auth::user();
        $storageTags = ($user->hasRole('admin')) ? StorageTag::get() : StorageTag::where('user_id', $user->id)->get();
        return view('pages/storage-tags-list', ['storageTags' => $storageTags]);
    }

    public function getSingleStorageTag($id): View
    {
        $storageTag = StorageTag::find($id);
        $tokenData = [
            'type' => 'storage_tag',
            'id' => $storageTag->id,
            'view_file' => 'pages/businesscard'
        ];
        $token = TokenHelper::createToken($tokenData);
        return view('pages/storage-tag', ['storageTag' => $storageTag, 'copy_link' => url('/').'/view-storage-tag/'.$token]);
    }

    public function updateStorageTagStatus($request): JsonResponse
    {
        $storageTag = StorageTag::find($request->card_id);
        $status = $request->status === 'true';
        $storageTag->update(['status' => $status]);
        return response()->json('Storage Tag status successfully updated.');
    }

    public function viewStorageTagOnGuest($token)
    {
        try {
            $tokenData = TokenHelper::readToken($token);
            $storageTag = StorageTag::find($tokenData['id']);
            if (!$storageTag->status || $storageTag->user->userDetail->status != 'true') {
                return view('pages/temporary-disable');
            }
            return view('pages/storage-tag', ['storageTag' => $storageTag]);
        } catch (\Exception) {
            Log::error($e);
            abort(500, 'Something is not right. Please try again.');
        }
    }
}
