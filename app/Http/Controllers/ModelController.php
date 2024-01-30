<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Arr;
use Spatie\QueryBuilder\QueryBuilder;

abstract class ModelController extends Controller implements ModelControllerInterface
{
    /**
     * @param  Closure  $beforeReturn
     * @return JsonResponse|ResourceCollection
     */
    public function respondIndex(Closure $beforeReturn = null)
    {
        $query = QueryBuilder::for($this->modelClass())
            ->allowedFilters($this->allowedFilters())
            ->allowedSorts($this->allowedSorts())
            ->allowedIncludes($this->allowedIncludes());
        if ($beforeReturn) {
            $beforeReturn($query);
        }

        return $this->resourceClass()::collection(
            request('no_pagination') ? $query->get() : $query->paginate(request('limit', 15))->appends(
                request()->query()
            )
        );
    }

    public function allowedSorts(): ?array
    {
        return [];
    }

    public function resourceClass(): ?string
    {
        return 'App\\Http\\Resources\\'.Arr::last(explode('\\', $this->modelClass()));
    }

    /**
     * @param  Model  $model
     * @param  Closure|null  $beforeReturn
     * @return JsonResource
     */
    protected function respondModel(Model $model, Closure $beforeReturn = null)
    {
        $class = $this->resourceClass();
        $query = QueryBuilder::for($model->newQuery());

        if ($beforeReturn) {
            $beforeReturn($query);
        }

        return new $class(
            $query->allowedIncludes($this->allowedIncludes())
                ->where($model->getKeyName(), $model->getKey())
                ->first()
        );
    }
}
