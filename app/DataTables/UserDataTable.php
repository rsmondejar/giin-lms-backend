<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;

class UserDataTable extends BaseDataTable
{
    protected string $orderDirection = 'asc';

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query): DataTableAbstract
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addColumn('action', 'users.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param User $model
     * @return Builder
     */
    public function query(User $model): Builder
    {
        return $model->with([
            'business',
            'department',
        ])->newQuery();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            'name' => [
                'data' => 'name',
                'name' => 'name',
                'title' => 'Nombre',
                'visible' => true,
                'orderable' => true,
                'render' => null
            ],
            'email' => [
                'data' => 'email',
                'name' => 'email',
                'title' => 'E-mail',
                'visible' => true,
                'orderable' => true,
                'render' => null
            ],
            'business' => [
                'data' => 'business.business_name',
                'name' => 'business.business_name',
                'title' => 'Empresa',
                'visible' => true,
                'orderable' => true,
                'render' => null
            ],
            'department' => [
                'data' => 'department.department_name',
                'name' => 'department.department_name',
                'title' => 'Departmento',
                'visible' => true,
                'orderable' => true,
                'render' => null
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'departments_datatable_' . time();
    }
}
