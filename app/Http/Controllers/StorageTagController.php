<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStorageTagRequest;
use App\Http\Requests\StorageTagStatusUpdateRequest;
use App\Http\Requests\UpdateStorageTagRequest;
use App\Models\StorageTag;
use App\Models\User;
use App\Repositories\StorageTagRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class StorageTagController extends Controller
{
    protected StorageTagRepository $storageTag;

    public function __construct(StorageTagRepository $storageTag)
    {
        $this->storageTag = $storageTag;
    }

    public function getStorageTagCreatePage():View
    {
        if (Auth::user()->hasPermissionTo('create_storage_tag')) {
            $customers = User::role('customer')->get();
            return view('pages/storage-tag-create', ['customers' => $customers]);
        }
        return User::abort(403);
    }

    public function getStorageTagUpdatePage($id):View
    {
        if (Auth::user()->hasPermissionTo('update_storage_tag')) {
            $storageTag = StorageTag::find($id);
            return view('pages/storage-tag-update', ['storageTag' => $storageTag]);
        }
        return User::abort(403);
    }

    public function store(CreateStorageTagRequest $request)
    {
        if (Auth::user()->hasPermissionTo('create_storage_tag')) {
            return $this->storageTag->store($request);
        }
        return User::abort(403);
    }

    public function update(UpdateStorageTagRequest $request)
    {
        if (Auth::user()->hasPermissionTo('update_storage_tag')) {
            return $this->storageTag->update($request);
        }
        return User::abort(403);
    }

    public function getStorageTags(): View
    {
        return $this->storageTag->getStorageTags();
    }

    public function getSingleStorageTag($id): View
    {
        return $this->storageTag->getSingleStorageTag($id);
    }

    public function updateStorageTagStatus(StorageTagStatusUpdateRequest $request): JsonResponse
    {
        return $this->storageTag->updateStorageTagStatus($request);
    }

    public function viewStorageTagOnGuest($token):View
    {
        return $this->storageTag->viewStorageTagOnGuest($token);
    }
}
