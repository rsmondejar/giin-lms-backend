<?php

namespace App\Repositories;

use App\Traits\UploadFilesTrait;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    use UploadFilesTrait;

    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * Get searchable fields array
     */
    abstract public function getFieldsSearchable(): array;

    /**
     * Configure the Model
     */
    abstract public function model(): string;

    /**
     * Make Model instance
     *
     * @return Model
     * @throws Exception
     *
     */
    public function makeModel(): Model
    {
        $model = app($this->model());

        if (!$model instanceof Model) {
            throw new Exception( // NOSONAR
                "Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model"
            ); // NOSONAR
        }

        return $this->model = $model;
    }

    /**
     * Paginate records for scaffold.
     * @param int $perPage
     * @param array $columns
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage, array $columns = ['*']): LengthAwarePaginator
    {
        $query = $this->allQuery();

        return $query->paginate($perPage, $columns);
    }

    /**
     * Build a query for retrieving all records.
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @return Builder
     */
    public function allQuery(array $search = [], int $skip = null, int $limit = null): Builder
    {
        $query = $this->model->newQuery();

        if (count($search)) {
            foreach ($search as $key => $value) {
                if (in_array($key, $this->getFieldsSearchable())) {
                    $query->where($key, $value);
                }
            }
        }

        if (!is_null($skip)) {
            $query->skip($skip);
        }

        if (!is_null($limit)) {
            $query->limit($limit);
        }

        return $query;
    }

    /**
     * Retrieve all records with given filter criteria
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @param array $columns
     * @return Collection
     */
    public function all(array $search = [], int $skip = null, int $limit = null, array $columns = ['*']): Collection
    {
        $query = $this->allQuery($search, $skip, $limit);

        return $query->get($columns);
    }

    /**
     * Create model record
     * @param array $input
     * @return Model
     */
    public function create(array $input): Model
    {
        $input = $this->saveFiles($input);

        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    }

    /**
     * Find model record for given id
     *
     * @param int $id
     * @param array $columns
     * @return Model|Collection|Builder|array|null
     */
    public function find(int $id, array $columns = ['*']): Model|Collection|Builder|array|null
    {
        $query = $this->model->newQuery();

        return $query->find($id, $columns);
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     * @return Model|Collection|Builder|array
     */
    public function update(array $input, int $id): Model|Collection|Builder|array
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $input = $this->saveFiles($input);

        $model->fill($input);

        $model->save();

        return $model;
    }

    /**
     * @param int $id
     * @return bool|mixed|null
     */
    public function delete(int $id): mixed
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        return $model->delete();
    }
}
