<?php

namespace App\DataTables;

use App\Models\Department;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;

class DepartmentDataTable extends BaseDataTable
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
            ->addColumn('action', 'departments.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param Department $model
     * @return Builder
     */
    public function query(Department $model): Builder
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
            'department_name' => [
                'data' => 'department_name',
                'name' => 'department_name',
                'title' => 'Nombre del Departamento',
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
