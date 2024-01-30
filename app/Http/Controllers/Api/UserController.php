<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ModelController;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends ModelController
{
    public function modelClass(): ?string
    {
        return User::class;
    }

    public function allowedFilters(): ?array
    {
        return [];
    }

    public function allowedIncludes(): ?array
    {
        return [];
    }

    public function index(): ResourceCollection
    {
        return $this->respondIndex();
    }

    public function store(StoreRequest $request): JsonResource
    {
        $user = DB::transaction(
            function () use ($request) {
                $user = User::query()->create(
                    array_merge(
                        $request->validated(),
                        [
                            'password' => bcrypt($password = '123456'),
                        ]
                    )
                );

                return $user;
            });
        
        return $this->respondModel($user);
    }

    public function show(User $user): JsonResource
    {
        return $this->respondModel($user);
    }

    public function update(UpdateRequest $request, User $user): JsonResource
    {
        $user = DB::transaction(
            function () use ($request, $user) {
                $user->update($request->validated());

                return $user;
            });
        
        return $this->respondModel($user);
    }

    public function destroy(User $user)
    {
        DB::transaction(
            function () use ($user) {
                $user->delete();
            }
        );
    }
}
