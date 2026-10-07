<?php

namespace App\Policies;

use App\Models\ServiceRequest;
use App\Models\User;

class ServiceRequestPolicy
{
    /**
     * Determine whether the user can view any requests.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view a request.
     */
    public function view(User $user, ServiceRequest $serviceRequest): bool
    {
        return $user->is_admin || $user->id === $serviceRequest->user_id;
    }

    /**
     * Determine whether the user can create a request.
     */
    public function create(User $user): bool
    {
        return !$user->is_admin;
    }

    /**
     * Determine whether the user can update the request status.
     */
    public function updateStatus(User $user, ServiceRequest $serviceRequest): bool
    {
        return $user->is_admin;
    }
}