<?php

namespace App\DataTables;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;

class PermissionDataTable extends BaseDataTable
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
            ->addColumn('action', 'permissions.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param Permission $model
     * @return Builder
     */
    public function query(Permission $model): Builder
    {
        return $model->newQuery();
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
                'title' => 'Nombre permiso',
                'visible' => true,
                'orderable' => true,
                'render' => null
            ],
            'guard_name' => [
                'data' => 'guard_name',
                'name' => 'guard_name',
                'title' => 'Nombre Guard',
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
        return 'permissions_datatable_' . time();
    }
}
