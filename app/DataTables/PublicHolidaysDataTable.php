<?php

namespace App\DataTables;

use App\Models\PublicHoliday;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;

class PublicHolidaysDataTable extends BaseDataTable
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
            ->editColumn(
                'date',
                fn (PublicHoliday $holiday) => $holiday->date->format('d/m/Y') .
                    " (" . $holiday->day_name . ")"
            )
            ->addColumn('action', 'public_holidays.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param PublicHoliday $model
     * @return Builder
     */
    public function query(PublicHoliday $model): Builder
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
            'date' => [
                'data' => 'date',
                'name' => 'date',
                'title' => 'Día',
                'visible' => true,
                'orderable' => true,
                'render' => null
            ],
            'name' => [
                'data' => 'name',
                'name' => 'name',
                'title' => 'Nombre del Festivo',
                'visible' => true,
                'orderable' => true,
                'render' => null
            ],
            'year' => [
                'data' => 'year',
                'name' => 'year',
                'title' => 'Año',
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
