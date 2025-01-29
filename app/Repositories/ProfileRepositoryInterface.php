<?php

namespace App\Repositories;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;

interface ProfileRepositoryInterface
{
    public function getProfileData(Request $request): array;
    public function updateProfile(ProfileUpdateRequest $request): void;
    public function deleteProfile(Request $request): void;
}