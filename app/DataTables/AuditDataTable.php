<?php

namespace App\DataTables;

use App\Models\Audit;
use App\Traits\PrintPreatyJson;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\EloquentDataTable;

class AuditDataTable extends BaseDataTable
{
    use PrintPreatyJson;

    protected string $orderDirection = 'desc';

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
            ->editColumn('created_at', function (Audit $model) {
                return $model->created_at->format('d/m/Y H:i:s');
            })
            ->editColumn('data', function (Audit $model) {
                return PrintPreatyJson::print(json_encode($model->data));
            })
            ->addColumn('action', 'audit.datatables_actions')
            ->rawColumns([
                'action',
                'data',
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param Audit $model
     * @return Builder
     */
    public function query(Audit $model): Builder
    {
        return $model->newQuery();
    }

    public function html(): \Yajra\DataTables\Html\Builder
    {
        $builder = parent::html();

        $builder->parameters([
            'dom' => 'rtlip',
            'buttons' => false,
        ]);

        return $builder;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            'created_at' => [
                'data' => 'created_at',
                'name' => 'created_at',
                'title' => 'Fecha de creación',
                'visible' => true,
                'orderable' => false,
                'render' => null
            ],
            'event' => [
                'data' => 'event',
                'name' => 'event',
                'title' => 'Evento',
                'visible' => true,
                'orderable' => false,
                'render' => null
            ],
            'model' => [
                'data' => 'model',
                'name' => 'model',
                'title' => 'Modelo',
                'visible' => true,
                'orderable' => false,
                'render' => null
            ],
            'data' => [
                'data' => 'data',
                'name' => 'data',
                'title' => 'Info',
                'visible' => true,
                'orderable' => false,
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
