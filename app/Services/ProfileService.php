<?php

namespace App\Services;

use App\Http\Requests\ProfileUpdateRequest;
use App\Repositories\ProfileRepositoryInterface;
use Illuminate\Http\Request;

class ProfileService implements ProfileServiceInterface
{
    protected $profileRepository;

    public function __construct(ProfileRepositoryInterface $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function getProfileData(Request $request): array
    {
        return $this->profileRepository->getProfileData($request);
    }

    public function updateProfile(ProfileUpdateRequest $request): void
    {
        $this->profileRepository->updateProfile($request);
    }

    public function deleteProfile(Request $request): void
    {
        $this->profileRepository->deleteProfile($request);
    }
}