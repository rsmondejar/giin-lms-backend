<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\ProjectManagerResource;

class GetProjectManagersController
{
    public const LMS_PROJECTS_ROLE = "managers";

    /**
     * @return AnonymousResourceCollection
     */
    public function __invoke(): AnonymousResourceCollection
    {
        $users = User::whereHas("roles", fn ($query) => $query->where("name", self::LMS_PROJECTS_ROLE))
            ->orderBy("name")
            ->get();

        return ProjectManagerResource::collection($users);
    }
}
