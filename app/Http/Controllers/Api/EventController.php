<?php

namespace App\Http\Controllers\Api;

use App\Event;
use App\Http\Controllers\ModelController;
use App\Http\Requests\Event\StoreRequest;
use App\Http\Requests\Event\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;

class EventController extends ModelController
{
    public function modelClass(): ?string
    {
        return Event::class;
    }

    public function allowedFilters(): ?array
    {
        return [];
    }

    public function allowedIncludes(): ?array
    {
        return [
            'createdByUser',
            'course'
        ];
    }

    public function index(): ResourceCollection
    {
        return $this->respondIndex();
    }

    public function store(StoreRequest $request): JsonResource
    {
        $event = DB::transaction(
            function () use ($request) {
                $event = Event::query()->create(
                    array_merge(
                        $request->validated(),
                        [
                            'created_by' => auth()->user()->id,
                        ]
                    )
                );

                return $event;
            });
        
        return $this->respondModel($event);
    }

    public function show(Event $event): JsonResource
    {
        return $this->respondModel($event);
    }

    public function update(UpdateRequest $request, Event $event): JsonResource
    {
        $event = DB::transaction(
            function () use ($request, $event) {
                $event->update($request->validated());

                return $event;
            });
        
        return $this->respondModel($event);
    }

    public function destroy(Event $event)
    {
        DB::transaction(
            function () use ($event) {
                $event->delete();
            }
        );
    }
}
