<?php

namespace App\Http\Controllers\Api;

use App\Course;
use App\Http\Controllers\ModelController;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\DB;

class CourseController extends ModelController
{
    public function modelClass(): ?string
    {
        return Course::class;
    }

    public function allowedFilters(): ?array
    {
        return [];
    }

    public function allowedIncludes(): ?array
    {
        return [
            'createdByUser',
            'events'
        ];
    }

    public function index(): ResourceCollection
    {
        return $this->respondIndex();
    }

    public function store(StoreRequest $request): JsonResource
    {
        $course = DB::transaction(
            function () use ($request) {
                $course = Course::query()->create(
                    array_merge(
                        $request->validated(),
                        [
                            'created_by' => auth()->user()->id,
                        ]
                    )
                );

                return $course;
            });
        
        return $this->respondModel($course);
    }

    public function show(Course $course): JsonResource
    {
        return $this->respondModel($course);
    }

    public function update(UpdateRequest $request, Course $course): JsonResource
    {
        $course = DB::transaction(
            function () use ($request, $course) {
                $course->update($request->validated());

                return $course;
            });
        
        return $this->respondModel($course);
    }

    public function destroy(Course $course)
    {
        DB::transaction(
            function () use ($course) {
                $course->delete();
            }
        );
    }
}
